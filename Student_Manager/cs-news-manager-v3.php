<?php
/**
 * Plugin Name: CS News Manager v3
 * Description: ระบบจัดการข่าวประชาสัมพันธ์ (หลังบ้าน + หน้าเว็บ) — ปรับ UI ตาม template ผู้ใช้ โดย ChatGPT.
 * Version: 3.0
 * Author: ChatGPT
 */

if (!defined('ABSPATH')) exit;

/* Register CPT */
add_action('init', function () {
    register_post_type('cs_news', [
        'label'         => 'ข่าวประชาสัมพันธ์',
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'cs-news'],
        'show_ui'       => false, // custom UI
        'supports'      => ['title','editor','author','excerpt','thumbnail','custom-fields','revisions'],
    ]);
});

/* Admin menu */
add_action('admin_menu', function () {
    add_menu_page(
        'จัดการข่าวประชาสัมพันธ์',
        'ข่าวประชาสัมพันธ์',
        'manage_options',
        'cs-news-v3',
        'cs_news_page_v3',
        'dashicons-megaphone',
        25
    );
    add_submenu_page('cs-news-v3','ตั้งค่า','ตั้งค่า','manage_options','cs-news-v3-settings','cs_news_settings_page_v3');
});

/* Enqueue scripts */
add_action('admin_enqueue_scripts', function ($hook) {
    if (strpos($hook, 'cs-news-v3') === false && strpos($hook, 'toplevel_page_cs-news-v3') === false) return;
    wp_enqueue_media();
    wp_enqueue_script('cs-news-admin-js', plugin_dir_url(__FILE__).'assets/admin.js', ['jquery'], '1.0', true);
    wp_enqueue_style('cs-news-admin-css', plugin_dir_url(__FILE__).'assets/admin.css');
});

/* Save handler */
add_action('admin_init', function () {
    if (!current_user_can('manage_options')) return;

    // Save or Update
    if (isset($_POST['cs_news_save'])) {
        check_admin_referer('cs_news_save_action','cs_news_save_nonce');
        $post_data = [
            'post_title'   => sanitize_text_field($_POST['title']),
            'post_content' => wp_kses_post($_POST['content']),
            'post_type'    => 'cs_news',
            'post_status'  => 'publish',
        ];
        if (!empty($_POST['news_id'])) {
            $post_data['ID'] = intval($_POST['news_id']);
            $post_id = wp_update_post($post_data);
        } else {
            $post_id = wp_insert_post($post_data);
        }

        if ($post_id && !is_wp_error($post_id)) {
            // metadata (simple fields)
            update_post_meta($post_id, 'cs_meta_published_date', sanitize_text_field($_POST['meta_published_date'] ?? ''));
            update_post_meta($post_id, 'cs_meta_updated_date', sanitize_text_field($_POST['meta_updated_date'] ?? ''));
            update_post_meta($post_id, 'cs_meta_unit', sanitize_text_field($_POST['meta_unit'] ?? ''));
            update_post_meta($post_id, 'cs_meta_source', esc_url_raw($_POST['meta_source'] ?? ''));
            update_post_meta($post_id, 'cs_meta_intro', wp_kses_post($_POST['meta_intro'] ?? ''));

            // Repeater lists - objectives/results/activities
            $objectives = array_values(array_filter(array_map('sanitize_text_field', $_POST['objectives'] ?? [])));
            $results = array_values(array_filter(array_map('sanitize_text_field', $_POST['results'] ?? [])));
            $activities = array_values(array_filter(array_map('sanitize_text_field', $_POST['activities'] ?? [])));
            update_post_meta($post_id, 'cs_objectives', $objectives);
            update_post_meta($post_id, 'cs_results', $results);
            update_post_meta($post_id, 'cs_activities', $activities);

            // Contact
            update_post_meta($post_id, 'cs_contact_phone', sanitize_text_field($_POST['cs_contact_phone'] ?? ''));
            update_post_meta($post_id, 'cs_contact_email', sanitize_email($_POST['cs_contact_email'] ?? ''));
            update_post_meta($post_id, 'cs_contact_facebook', sanitize_text_field($_POST['cs_contact_facebook'] ?? ''));
            update_post_meta($post_id, 'cs_contact_website', esc_url_raw($_POST['cs_contact_website'] ?? ''));

            // Responsible person
            update_post_meta($post_id, 'cs_responsible_name', sanitize_text_field($_POST['cs_responsible_name'] ?? ''));
            update_post_meta($post_id, 'cs_responsible_position', sanitize_text_field($_POST['cs_responsible_position'] ?? ''));
            update_post_meta($post_id, 'cs_responsible_affiliation', sanitize_text_field($_POST['cs_responsible_affiliation'] ?? ''));
            update_post_meta($post_id, 'cs_responsible_note', sanitize_text_field($_POST['cs_responsible_note'] ?? ''));

            // Gallery (store array of attachment IDs as json)
            $gallery = array_map('intval', $_POST['cs_gallery_ids'] ?? []);
            update_post_meta($post_id, 'cs_gallery_ids', $gallery);

            // Attachments (file URLs)
            $attachments = array_map('esc_url_raw', $_POST['cs_attachments'] ?? []);
            update_post_meta($post_id, 'cs_attachments', $attachments);

            wp_redirect(admin_url('admin.php?page=cs-news-v3&saved=1'));
            exit;
        }
    }

    // Delete
    if (isset($_GET['delete_news'])) {
        $id = intval($_GET['delete_news']);
        check_admin_referer('cs_news_delete_'.$id);
        wp_delete_post($id, true);
        wp_redirect(admin_url('admin.php?page=cs-news-v3&deleted=1'));
        exit;
    }
});

/* Admin page UI */
function cs_news_page_v3() {
    $edit_mode = false;
    $edit_post = null;
    if (isset($_GET['edit_news'])) {
        $edit_mode = true;
        $edit_post = get_post(intval($_GET['edit_news']));
    }
    ?>
    <div class="wrap cs-news-admin-wrap">
        <h1>จัดการข่าวประชาสัมพันธ์</h1>
        <?php if (isset($_GET['saved'])) echo '<div class="updated"><p>บันทึกเรียบร้อย</p></div>'; ?>
        <?php if (isset($_GET['deleted'])) echo '<div class="updated"><p>ลบเรียบร้อย</p></div>'; ?>

        <h2><?php echo $edit_mode ? 'แก้ไขข่าว' : 'เพิ่มข่าวใหม่'; ?></h2>
        <form method="post">
            <?php wp_nonce_field('cs_news_save_action','cs_news_save_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th style="width:200px">หัวข้อข่าว</th>
                    <td>
                        <input type="text" name="title" class="regular-text" required value="<?php echo $edit_mode ? esc_attr($edit_post->post_title) : ''; ?>">
                    </td>
                </tr>
                <tr>
                    <th>เกริ่นนำ</th>
                    <td><textarea name="meta_intro" rows="3" class="large-text"><?php echo $edit_mode ? esc_textarea(get_post_meta($edit_post->ID,'cs_meta_intro',true)) : ''; ?></textarea></td>
                </tr>
                <tr>
                    <th>รายละเอียด</th>
                    <td><?php
                        $content = $edit_mode ? $edit_post->post_content : '';
                        wp_editor($content,'content',['textarea_name'=>'content','textarea_rows'=>8]);
                    ?></td>
                </tr>
                <tr>
                    <th>Metadata</th>
                    <td>
                        <label>วันที่เผยแพร่: <input type="date" name="meta_published_date" value="<?php echo $edit_mode ? esc_attr(get_post_meta($edit_post->ID,'cs_meta_published_date',true)) : ''; ?>"></label><br>
                        <label>วันที่แก้ไขล่าสุด: <input type="date" name="meta_updated_date" value="<?php echo $edit_mode ? esc_attr(get_post_meta($edit_post->ID,'cs_meta_updated_date',true)) : ''; ?>"></label><br>
                        <label>หน่วยงาน: <input type="text" name="meta_unit" class="regular-text" value="<?php echo $edit_mode ? esc_attr(get_post_meta($edit_post->ID,'cs_meta_unit',true)) : ''; ?>"></label><br>
                        <label>แหล่งที่มา/ลิงก์: <input type="url" name="meta_source" class="regular-text" value="<?php echo $edit_mode ? esc_attr(get_post_meta($edit_post->ID,'cs_meta_source',true)) : ''; ?>"></label>
                    </td>
                </tr>
            </table>

            <h3>รายละเอียดกิจกรรม</h3>
            <div id="cs-activities-list">
                <?php
                $activities = $edit_mode ? (array) get_post_meta($edit_post->ID,'cs_activities',true) : [''];
                foreach ($activities as $act) {
                    echo '<div class="cs-list-item"><input type="text" name="activities[]" class="regular-text" value="'.esc_attr($act).'"> <button class="button cs-remove-item">ลบ</button></div>';
                }
                ?>
            </div>
            <p><button type="button" class="button" id="cs-add-activity">+ เพิ่มรายละเอียดกิจกรรม</button></p>

            <h3>วัตถุประสงค์</h3>
            <div id="cs-objectives-list">
                <?php
                $objectives = $edit_mode ? (array) get_post_meta($edit_post->ID,'cs_objectives',true) : [''];
                foreach ($objectives as $obj) {
                    echo '<div class="cs-list-item"><input type="text" name="objectives[]" class="regular-text" value="'.esc_attr($obj).'"> <button class="button cs-remove-item">ลบ</button></div>';
                }
                ?>
            </div>
            <p><button type="button" class="button" id="cs-add-objective">+ เพิ่มวัตถุประสงค์</button></p>

            <h3>ผลที่คาดว่าจะได้รับ</h3>
            <div id="cs-results-list">
                <?php
                $results = $edit_mode ? (array) get_post_meta($edit_post->ID,'cs_results',true) : [''];
                foreach ($results as $r) {
                    echo '<div class="cs-list-item"><input type="text" name="results[]" class="regular-text" value="'.esc_attr($r).'"> <button class="button cs-remove-item">ลบ</button></div>';
                }
                ?>
            </div>
            <p><button type="button" class="button" id="cs-add-result">+ เพิ่มผลที่คาดว่าจะได้รับ</button></p>

            <h3>แกลเลอรีภาพกิจกรรม</h3>
            <p>ใช้ปุ่มด้านล่างเพื่อเลือก/อัปโหลดรูปภาพจาก Media Library (สามารถเลือกหลายรูปได้)</p>
            <div id="cs-gallery-box">
                <?php
                $gallery_ids = $edit_mode ? (array) get_post_meta($edit_post->ID,'cs_gallery_ids',true) : [];
                echo '<div class="cs-gallery-previews">';
                foreach ($gallery_ids as $gid) {
                    $thumb = wp_get_attachment_image_url($gid,'thumbnail');
                    if ($thumb) {
                        echo '<div class="cs-gallery-item" data-id="'.intval($gid).'"><img src="'.esc_url($thumb).'" alt=""><button class="button cs-remove-gallery">ลบ</button></div>';
                    }
                }
                echo '</div>';
                ?>
                <input type="hidden" name="cs_gallery_ids[]" id="cs_gallery_ids_field" value="<?php echo esc_attr(implode(',',$gallery_ids)); ?>">
                <p><button type="button" class="button" id="cs-add-gallery">เพิ่มรูปกิจกรรม</button></p>
            </div>

            <h3>เอกสาร/ไฟล์แนบ</h3>
            <div id="cs-attachments-list">
                <?php
                $attachments = $edit_mode ? (array) get_post_meta($edit_post->ID,'cs_attachments',true) : [''];
                foreach ($attachments as $att) {
                    echo '<div class="cs-attachment-item"><input type="text" name="cs_attachments[]" class="regular-text" value="'.esc_attr($att).'"> <button class="button cs-remove-attach">ลบ</button></div>';
                }
                ?>
            </div>
            <p><button type="button" class="button" id="cs-add-attachment">+ เพิ่มไฟล์แนบ (URL)</button></p>

            <h3>ช่องทางติดต่อ</h3>
            <table class="form-table">
                <tr><th>โทร</th><td><input type="text" name="cs_contact_phone" class="regular-text" value="<?php echo $edit_mode ? esc_attr(get_post_meta($edit_post->ID,'cs_contact_phone',true)) : ''; ?>"></td></tr>
                <tr><th>อีเมล</th><td><input type="email" name="cs_contact_email" class="regular-text" value="<?php echo $edit_mode ? esc_attr(get_post_meta($edit_post->ID,'cs_contact_email',true)) : ''; ?>"></td></tr>
                <tr><th>Facebook</th><td><input type="text" name="cs_contact_facebook" class="regular-text" value="<?php echo $edit_mode ? esc_attr(get_post_meta($edit_post->ID,'cs_contact_facebook',true)) : ''; ?>"></td></tr>
                <tr><th>เว็บไซต์</th><td><input type="url" name="cs_contact_website" class="regular-text" value="<?php echo $edit_mode ? esc_attr(get_post_meta($edit_post->ID,'cs_contact_website',true)) : ''; ?>"></td></tr>
            </table>

            <h3>ผู้รับผิดชอบเนื้อหา</h3>
            <table class="form-table">
                <tr><th>ชื่อ</th><td><input type="text" name="cs_responsible_name" class="regular-text" value="<?php echo $edit_mode ? esc_attr(get_post_meta($edit_post->ID,'cs_responsible_name',true)) : ''; ?>"></td></tr>
                <tr><th>ตำแหน่ง</th><td><input type="text" name="cs_responsible_position" class="regular-text" value="<?php echo $edit_mode ? esc_attr(get_post_meta($edit_post->ID,'cs_responsible_position',true)) : ''; ?>"></td></tr>
                <tr><th>สังกัด</th><td><input type="text" name="cs_responsible_affiliation" class="regular-text" value="<?php echo $edit_mode ? esc_attr(get_post_meta($edit_post->ID,'cs_responsible_affiliation',true)) : ''; ?>"></td></tr>
                <tr><th>หมายเหตุ</th><td><input type="text" name="cs_responsible_note" class="regular-text" value="<?php echo $edit_mode ? esc_attr(get_post_meta($edit_post->ID,'cs_responsible_note',true)) : ''; ?>"></td></tr>
            </table>

            <?php if ($edit_mode): ?>
                <input type="hidden" name="news_id" value="<?php echo intval($edit_post->ID); ?>">
            <?php endif; ?>

            <p>
                <button type="submit" name="cs_news_save" class="button button-primary"><?php echo $edit_mode ? 'อัปเดตข่าว' : 'บันทึกข่าว'; ?></button>
                <?php if ($edit_mode): ?><a href="admin.php?page=cs-news-v3" class="button">ยกเลิก</a><?php endif; ?>
            </p>
        </form>

        <hr>

        <h2>รายการข่าวทั้งหมด</h2>
        <table class="widefat striped">
            <thead>
                <tr><th>หัวข้อ</th><th>วันที่</th><th width="160">การจัดการ</th></tr>
            </thead>
            <tbody>
            <?php
            $news = get_posts(['post_type'=>'cs_news','numberposts'=>-1,'orderby'=>'date','order'=>'DESC']);
            if ($news) {
                foreach ($news as $item) {
                    echo '<tr>';
                    echo '<td>'.esc_html($item->post_title).'</td>';
                    echo '<td>'.esc_html(get_post_meta($item->ID,'cs_meta_published_date',true) ?: $item->post_date).'</td>';
                    echo '<td><a class="button" href="'.admin_url('admin.php?page=cs-news-v3&edit_news='.$item->ID).'">แก้ไข</a> ';
                    $del_nonce = wp_create_nonce('cs_news_delete_'.$item->ID);
                    echo '<a class="button" style="color:red" onclick="return confirm(\'ยืนยันการลบ?\');" href="'.admin_url('admin.php?page=cs-news-v3&delete_news='.$item->ID.'&_wpnonce='.$del_nonce).'">ลบ</a></td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="3">ยังไม่มีข่าว</td></tr>';
            }
            ?>
            </tbody>
        </table>

    </div>
    <?php
}

/* Settings page placeholder */
function cs_news_settings_page_v3() {
    ?>
    <div class="wrap"><h1>ตั้งค่า CS News Manager</h1><p>ยังไม่มีการตั้งค่าเพิ่มเติม</p></div>
    <?php
}

/* Frontend shortcode to display single news with template similar to provided HTML */
add_shortcode('cs_news_template', function ($atts) {
    $atts = shortcode_atts(['id'=>0], $atts, 'cs_news_template');
    $id = intval($atts['id']);
    if (!$id) return '';
    $post = get_post($id);
    if (!$post || $post->post_type !== 'cs_news') return '';

    // gather meta
    $meta = [];
    $meta['published_date'] = get_post_meta($id,'cs_meta_published_date',true);
    $meta['updated_date'] = get_post_meta($id,'cs_meta_updated_date',true);
    $meta['unit'] = get_post_meta($id,'cs_meta_unit',true);
    $meta['source'] = get_post_meta($id,'cs_meta_source',true);
    $meta['intro'] = get_post_meta($id,'cs_meta_intro',true);
    $meta['activities'] = (array) get_post_meta($id,'cs_activities',true);
    $meta['objectives'] = (array) get_post_meta($id,'cs_objectives',true);
    $meta['results'] = (array) get_post_meta($id,'cs_results',true);
    $meta['gallery'] = (array) get_post_meta($id,'cs_gallery_ids',true);
    $meta['attachments'] = (array) get_post_meta($id,'cs_attachments',true);
    $meta['contact_phone'] = get_post_meta($id,'cs_contact_phone',true);
    $meta['contact_email'] = get_post_meta($id,'cs_contact_email',true);
    $meta['contact_facebook'] = get_post_meta($id,'cs_contact_facebook',true);
    $meta['contact_website'] = get_post_meta($id,'cs_contact_website',true);
    $meta['responsible_name'] = get_post_meta($id,'cs_responsible_name',true);
    $meta['responsible_position'] = get_post_meta($id,'cs_responsible_position',true);
    $meta['responsible_affiliation'] = get_post_meta($id,'cs_responsible_affiliation',true);
    $meta['responsible_note'] = get_post_meta($id,'cs_responsible_note',true);

    ob_start();
    ?>
    <div class="cs-news-frontend">
        <div class="cs-news-container">
            <h1><?php echo esc_html($post->post_title); ?></h1>

            <div class="cs-meta-box">
                <p><strong>วันที่เผยแพร่:</strong> <?php echo esc_html($meta['published_date']); ?></p>
                <p><strong>วันที่ปรับปรุงล่าสุด:</strong> <?php echo esc_html($meta['updated_date']); ?></p>
                <p><strong>ผู้เขียน:</strong> <?php echo esc_html(get_the_author_meta('display_name',$post->post_author)); ?></p>
                <p><strong>หน่วยงาน:</strong> <?php echo esc_html($meta['unit']); ?></p>
                <p><strong>แหล่งที่มา / ลิงก์อ้างอิง:</strong> <?php if ($meta['source']) echo '<a href="'.esc_url($meta['source']).'">'.esc_html($meta['source']).'</a>'; ?></p>
            </div>

            <?php if ($meta['intro']): ?>
                <p class="cs-intro"><?php echo wp_kses_post(wpautop($meta['intro'])); ?></p>
            <?php endif; ?>

            <hr/>

            <h2>รายละเอียดกิจกรรม</h2>
            <?php if ($meta['activities']): ?>
                <ul class="cs-activities">
                    <?php foreach ($meta['activities'] as $act) echo '<li>'.esc_html($act).'</li>'; ?>
                </ul>
            <?php endif; ?>

            <h2>วัตถุประสงค์ของกิจกรรม</h2>
            <?php if ($meta['objectives']): ?>
                <ul class="cs-objectives">
                    <?php foreach ($meta['objectives'] as $o) echo '<li>'.esc_html($o).'</li>'; ?>
                </ul>
            <?php endif; ?>

            <h2>ผลที่คาดว่าจะได้รับ / ผลลัพธ์</h2>
            <?php if ($meta['results']): ?>
                <ul class="cs-results">
                    <?php foreach ($meta['results'] as $r) echo '<li>'.esc_html($r).'</li>'; ?>
                </ul>
            <?php endif; ?>

            <h2>ภาพกิจกรรม</h2>
            <p>แทรกแกลเลอรีภาพกิจกรรมด้านล่างนี้ โดยกำหนดข้อความ <em>Alt Text</em> ให้เหมาะสมทุกภาพ</p>
            <div class="cs-gallery-frontend">
                <?php
                if ($meta['gallery']) {
                    foreach ($meta['gallery'] as $gid) {
                        $src = wp_get_attachment_image_url($gid,'medium');
                        if ($src) echo '<div class="cs-gallery-item"><img src="'.esc_url($src).'" alt=""></div>';
                    }
                } else {
                    echo '<p>ยังไม่มีภาพกิจกรรม</p>';
                }
                ?>
            </div>

            <h2>เอกสาร / ไฟล์แนบ</h2>
            <?php if ($meta['attachments']): ?>
                <ul class="cs-attachments">
                    <?php foreach ($meta['attachments'] as $att) echo '<li><a href="'.esc_url($att).'" target="_blank">'.esc_html(basename($att)).'</a></li>'; ?>
                </ul>
            <?php endif; ?>

            <h2>ช่องทางติดต่อ</h2>
            <p>โทร: <?php echo esc_html($meta['contact_phone']); ?><br/>อีเมล: <?php echo esc_html($meta['contact_email']); ?><br/>Facebook: <?php echo esc_html($meta['contact_facebook']); ?><br/>เว็บไซต์สาขา: <?php echo esc_url($meta['contact_website']); ?></p>

            <hr/>

            <p class="cs-responsible">
                <strong>ผู้รับผิดชอบเนื้อหา:</strong> <?php echo esc_html($meta['responsible_name']); ?><br/>
                <strong>ตำแหน่ง:</strong> <?php echo esc_html($meta['responsible_position']); ?><br/>
                <strong>สังกัด:</strong> <?php echo esc_html($meta['responsible_affiliation']); ?><br/>
                <strong>หมายเหตุ:</strong> <?php echo esc_html($meta['responsible_note']); ?>
            </p>

            <div class="cs-content">
                <?php echo apply_filters('the_content', $post->post_content); ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
});

/* Enqueue frontend CSS */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('cs-news-frontend-css', plugin_dir_url(__FILE__).'assets/frontend.css');
});
