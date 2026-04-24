<?php
/**
 * Plugin Name: Student Manager
 * Description: จัดการข้อมูลนักศึกษา (ชื่อ-นามสกุล, อีเมล, เบอร์โทรศัพท์, รูปภาพ, ไฟล์แนบ) ทั้งหน้าแอดมินและฟอร์มหน้าเว็บ
 * Version: 1.0.0
 * Author: ChatGPT
 * Text Domain: student-manager
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Student_Manager_Plugin {

    public function __construct() {
        add_action( 'init', array( $this, 'register_student_cpt' ) );
        add_action( 'add_meta_boxes', array( $this, 'register_meta_boxes' ) );
        add_action( 'save_post_student', array( $this, 'save_student_meta' ), 10, 2 );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
        add_shortcode( 'student_list', array( $this, 'shortcode_student_list' ) );
        add_shortcode( 'student_form', array( $this, 'shortcode_student_form' ) );
        add_action( 'wp_ajax_student_manager_upload', array( $this, 'ajax_upload' ) );
        add_action( 'wp_ajax_nopriv_student_manager_front_submit', array( $this, 'front_submit' ) );
        add_action( 'rest_api_init', array( $this, 'rest_register' ) );
        add_filter( 'manage_student_posts_columns', array( $this, 'columns_head' ) );
        add_action( 'manage_student_posts_custom_column', array( $this, 'columns_content' ), 10, 2 );
    }

    public function register_student_cpt() {
        $labels = array(
            'name' => __( 'Students', 'student-manager' ),
            'singular_name' => __( 'Student', 'student-manager' ),
            'menu_name' => __( 'Students', 'student-manager' ),
            'add_new' => __( 'Add Student', 'student-manager' ),
        );

        $args = array(
            'labels' => $labels,
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'supports' => array( 'title' ),
            'capability_type' => 'post',
            'has_archive' => false,
            'rewrite' => false,
        );

        register_post_type( 'student', $args );
    }

    public function register_meta_boxes() {
        add_meta_box( 'student_details', __( 'Student Details', 'student-manager' ), array( $this, 'meta_box_callback' ), 'student', 'normal', 'high' );
    }

    public function meta_box_callback( $post ) {
        wp_nonce_field( 'student_meta_nonce', 'student_meta_nonce_field' );

        $first_name = get_post_meta( $post->ID, '_student_first_name', true );
        $last_name = get_post_meta( $post->ID, '_student_last_name', true );
        $email = get_post_meta( $post->ID, '_student_email', true );
        $phone = get_post_meta( $post->ID, '_student_phone', true );
        $photo_id = get_post_meta( $post->ID, '_student_photo', true );
        $attachments = get_post_meta( $post->ID, '_student_attachments', true );

        $photo_url = $photo_id ? wp_get_attachment_url( $photo_id ) : '';

        ?>
        <table class="form-table">
            <tr>
                <th><label for="student_first_name"><?php _e( 'First name', 'student-manager' ); ?></label></th>
                <td><input type="text" name="student_first_name" id="student_first_name" value="<?php echo esc_attr( $first_name ); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="student_last_name"><?php _e( 'Last name', 'student-manager' ); ?></label></th>
                <td><input type="text" name="student_last_name" id="student_last_name" value="<?php echo esc_attr( $last_name ); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="student_email"><?php _e( 'Email', 'student-manager' ); ?></label></th>
                <td><input type="email" name="student_email" id="student_email" value="<?php echo esc_attr( $email ); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="student_phone"><?php _e( 'Phone', 'student-manager' ); ?></label></th>
                <td><input type="text" name="student_phone" id="student_phone" value="<?php echo esc_attr( $phone ); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><?php _e( 'Photo', 'student-manager' ); ?></th>
                <td>
                    <div id="student-photo-wrap">
                        <?php if ( $photo_url ): ?>
                            <img src="<?php echo esc_url( $photo_url ); ?>" style="max-width:120px;height:auto;display:block;margin-bottom:8px;" />
                        <?php endif; ?>
                        <input type="hidden" id="student_photo" name="student_photo" value="<?php echo esc_attr( $photo_id ); ?>" />
                        <button class="button button-secondary" id="student_photo_button" type="button"><?php _e( 'Choose photo', 'student-manager' ); ?></button>
                        <button class="button" id="student_photo_remove" type="button"><?php _e( 'Remove', 'student-manager' ); ?></button>
                    </div>
                </td>
            </tr>
            <tr>
                <th><?php _e( 'Attachments', 'student-manager' ); ?></th>
                <td>
                    <div id="student-attachments-wrap">
                        <?php
                        $attachments = is_array( $attachments ) ? $attachments : array();
                        foreach ( $attachments as $att_id ) {
                            $url = wp_get_attachment_url( $att_id );
                            if ( $url ) {
                                echo '<div class="student-attachment-item" data-id="' . esc_attr( $att_id ) . '"><a href="' . esc_url( $url ) . '" target="_blank">' . basename( $url ) . '</a> <button class="button-link remove-attachment">Remove</button></div>';
                            }
                        }
                        ?>
                        <input type="hidden" id="student_attachments" name="student_attachments" value="<?php echo esc_attr( implode( ',', $attachments ) ); ?>" />
                        <button class="button button-secondary" id="student_attachments_button" type="button"><?php _e( 'Add attachments', 'student-manager' ); ?></button>
                    </div>
                </td>
            </tr>
        </table>
        <style>
            #student-photo-wrap img{border:1px solid #ddd;padding:6px;background:#fff}
            .student-attachment-item{margin-bottom:6px}
        </style>
        <?php
    }

    public function save_student_meta( $post_id, $post ) {
        // nonce
        if ( ! isset( $_POST['student_meta_nonce_field'] ) || ! wp_verify_nonce( $_POST['student_meta_nonce_field'], 'student_meta_nonce' ) ) {
            return;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if ( 'student' !== $post->post_type ) return;

        $fields = array(
            'student_first_name' => '_student_first_name',
            'student_last_name' => '_student_last_name',
            'student_email' => '_student_email',
            'student_phone' => '_student_phone',
        );

        foreach ( $fields as $input => $meta_key ) {
            if ( isset( $_POST[ $input ] ) ) {
                update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ $input ] ) ) );
            }
        }

        // photo
        if ( isset( $_POST['student_photo'] ) ) {
            $photo = intval( $_POST['student_photo'] );
            if ( $photo ) {
                update_post_meta( $post_id, '_student_photo', $photo );
            } else {
                delete_post_meta( $post_id, '_student_photo' );
            }
        }

        // attachments
        if ( isset( $_POST['student_attachments'] ) ) {
            $raw = sanitize_text_field( wp_unslash( $_POST['student_attachments'] ) );
            $ids = array_filter( array_map( 'intval', explode( ',', $raw ) ) );
            update_post_meta( $post_id, '_student_attachments', $ids );
        }
    }

    public function admin_enqueue( $hook ) {
        global $post_type;
        if ( 'student' === $post_type && in_array( $hook, array( 'post-new.php', 'post.php' ), true ) ) {
            wp_enqueue_media();
            wp_enqueue_script( 'student-admin', plugin_dir_url( __FILE__ ) . 'assets/admin.js', array( 'jquery' ), '1.0', true );
            wp_localize_script( 'student-admin', 'StudentManager', array(
                'removeText' => __( 'Remove', 'student-manager' ),
            ) );
            wp_enqueue_style( 'student-admin-style', plugin_dir_url( __FILE__ ) . 'assets/admin.css' );
        }
    }

    // Columns
    public function columns_head( $defaults ){
        $defaults['student_name'] = 'Full name';
        $defaults['student_email'] = 'Email';
        $defaults['student_phone'] = 'Phone';
        $defaults['student_photo'] = 'Photo';
        return $defaults;
    }

    public function columns_content( $column, $post_id ){
        switch ( $column ){
            case 'student_name':
                $first = get_post_meta( $post_id, '_student_first_name', true );
                $last = get_post_meta( $post_id, '_student_last_name', true );
                echo esc_html( trim( $first . ' ' . $last ) );
                break;
            case 'student_email':
                echo esc_html( get_post_meta( $post_id, '_student_email', true ) );
                break;
            case 'student_phone':
                echo esc_html( get_post_meta( $post_id, '_student_phone', true ) );
                break;
            case 'student_photo':
                $pid = get_post_meta( $post_id, '_student_photo', true );
                if ( $pid ){
                    echo wp_get_attachment_image( $pid, array( 50,50 ) );
                }
                break;
        }
    }

    // Shortcode: list
    public function shortcode_student_list( $atts ){
        $atts = shortcode_atts( array(
            'posts_per_page' => 10,
        ), $atts, 'student_list' );

        $q = new WP_Query( array(
            'post_type' => 'student',
            'posts_per_page' => intval( $atts['posts_per_page'] ),
        ) );

        if ( ! $q->have_posts() ) return '<p>No students found.</p>';

        $out = '<div class="student-list">';
        while ( $q->have_posts() ){
            $q->the_post();
            $id = get_the_ID();
            $first = get_post_meta( $id, '_student_first_name', true );
            $last = get_post_meta( $id, '_student_last_name', true );
            $email = get_post_meta( $id, '_student_email', true );
            $phone = get_post_meta( $id, '_student_phone', true );
            $photo = get_post_meta( $id, '_student_photo', true );
            $photo_url = $photo ? wp_get_attachment_image( $photo, 'thumbnail' ) : '';

            $out .= '<div class="student-item">';
            $out .= '<div class="student-photo">' . $photo_url . '</div>';
            $out .= '<div class="student-info">';
            $out .= '<h4>' . esc_html( $first . ' ' . $last ) . '</h4>';
            $out .= '<div>' . esc_html( $email ) . '</div>';
            $out .= '<div>' . esc_html( $phone ) . '</div>';
            $out .= '</div>';
            $out .= '</div>';
        }
        wp_reset_postdata();
        $out .= '</div>';

        $out .= '<style>.student-item{display:flex;gap:12px;padding:10px;border-bottom:1px solid #eee}.student-photo img{max-width:80px;height:auto}</style>';

        return $out;
    }

    // Shortcode: front-end form
    public function shortcode_student_form( $atts ){
        ob_start();
        ?>
        <form id="student-manager-form" method="post" enctype="multipart/form-data">
            <?php wp_nonce_field( 'student_manager_front', 'student_manager_front_nonce' ); ?>
            <p><label>First name<br><input type="text" name="first_name" required></label></p>
            <p><label>Last name<br><input type="text" name="last_name" required></label></p>
            <p><label>Email<br><input type="email" name="email" required></label></p>
            <p><label>Phone<br><input type="text" name="phone"></label></p>
            <p><label>Photo<br><input type="file" name="photo" accept="image/*"></label></p>
            <p><label>Attachments<br><input type="file" name="attachments[]" multiple></label></p>
            <p><button type="submit">Submit</button></p>
            <div id="student-manager-form-message"></div>
        </form>
        <script>
        (function(){
            var form = document.getElementById('student-manager-form');
            form.addEventListener('submit', function(e){
                e.preventDefault();
                var fd = new FormData(form);
                fd.append('action','student_manager_front_submit');

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo admin_url( "admin-ajax.php" ); ?>');
                xhr.onload = function(){
                    var msg = document.getElementById('student-manager-form-message');
                    try{ var r = JSON.parse(xhr.responseText); } catch(e){ msg.innerText = 'Invalid server response'; return; }
                    if ( r.success ){ msg.innerText = r.data.message; form.reset(); } else { msg.innerText = r.data.message || 'Error'; }
                };
                xhr.send(fd);
            });
        })();
        </script>
        <?php
        return ob_get_clean();
    }

    // Handle front submit via AJAX (for non-logged in too)
    public function front_submit() {
        if ( ! isset( $_POST['student_manager_front_nonce'] ) || ! wp_verify_nonce( $_POST['student_manager_front_nonce'], 'student_manager_front' ) ) {
            wp_send_json_error( array( 'message' => 'Invalid nonce' ) );
        }

        $first = isset( $_POST['first_name'] ) ? sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) : '';
        $last = isset( $_POST['last_name'] ) ? sanitize_text_field( wp_unslash( $_POST['last_name'] ) ) : '';
        $email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
        $phone = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';

        if ( empty( $first ) || empty( $last ) || empty( $email ) ) {
            wp_send_json_error( array( 'message' => 'Please fill required fields' ) );
        }

        $post_id = wp_insert_post( array(
            'post_type' => 'student',
            'post_title' => $first . ' ' . $last,
            'post_status' => 'publish',
        ) );

        if ( is_wp_error( $post_id ) ) {
            wp_send_json_error( array( 'message' => 'Could not create student' ) );
        }

        update_post_meta( $post_id, '_student_first_name', $first );
        update_post_meta( $post_id, '_student_last_name', $last );
        update_post_meta( $post_id, '_student_email', $email );
        update_post_meta( $post_id, '_student_phone', $phone );

        // handle photo
        if ( ! empty( $_FILES['photo'] ) && empty( $_FILES['photo']['error'] ) ){
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';

            $uploaded = media_handle_upload( 'photo', $post_id );
            if ( is_wp_error( $uploaded ) ) {
                // ignore but note
            } else {
                update_post_meta( $post_id, '_student_photo', $uploaded );
            }
        }

        // handle attachments
        $att_ids = array();
        if ( ! empty( $_FILES['attachments'] ) ){
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';

            $files = $_FILES['attachments'];
            foreach ( $files['name'] as $k => $name ){
                if ( $files['error'][ $k ] !== UPLOAD_ERR_OK ) continue;
                $file = array(
                    'name'     => $files['name'][ $k ],
                    'type'     => $files['type'][ $k ],
                    'tmp_name' => $files['tmp_name'][ $k ],
                    'error'    => $files['error'][ $k ],
                    'size'     => $files['size'][ $k ],
                );
                $_FILES = array( 'attachment' => $file );
                $attach_id = media_handle_upload( 'attachment', $post_id );
                if ( ! is_wp_error( $attach_id ) ) $att_ids[] = $attach_id;
            }
            if ( ! empty( $att_ids ) ) update_post_meta( $post_id, '_student_attachments', $att_ids );
        }

        wp_send_json_success( array( 'message' => 'Student submitted successfully' ) );
    }

    // simple ajax uploader (if needed by admin.js)
    public function ajax_upload() {
        check_ajax_referer( 'student_manager_upload', 'nonce' );
        if ( ! current_user_can( 'upload_files' ) ) wp_send_json_error( array( 'message' => 'No permission' ) );

        if ( empty( $_FILES['file'] ) ) wp_send_json_error( array( 'message' => 'No file' ) );

        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        $attach_id = media_handle_upload( 'file', 0 );
        if ( is_wp_error( $attach_id ) ) wp_send_json_error( array( 'message' => $attach_id->get_error_message() ) );

        wp_send_json_success( array( 'id' => $attach_id, 'url' => wp_get_attachment_url( $attach_id ) ) );
    }

    public function rest_register() {
        register_rest_field( 'student', 'meta', array(
            'get_callback' => function( $object ){
                $id = $object['id'];
                return array(
                    'first_name' => get_post_meta( $id, '_student_first_name', true ),
                    'last_name' => get_post_meta( $id, '_student_last_name', true ),
                    'email' => get_post_meta( $id, '_student_email', true ),
                    'phone' => get_post_meta( $id, '_student_phone', true ),
                    'photo' => wp_get_attachment_url( get_post_meta( $id, '_student_photo', true ) ),
                    'attachments' => array_map( function( $a ){ return wp_get_attachment_url( $a ); }, (array) get_post_meta( $id, '_student_attachments', true ) ),
                );
            },
        ) );
    }

}

new Student_Manager_Plugin();

// --- assets/admin.js ---
// Create file at assets/admin.js with this content:
/*
jQuery(document).ready(function($){
    var frame;
    $('#student_photo_button').on('click', function(e){
        e.preventDefault();
        if (frame) frame.open();
        frame = wp.media({
            title: 'Select or Upload Photo',
            button: { text: 'Use this photo' },
            multiple: false
        });
        frame.on('select', function(){
            var attachment = frame.state().get('selection').first().toJSON();
            $('#student_photo').val(attachment.id);
            $('#student-photo-wrap img').remove();
            $('#student-photo-wrap').prepend('<img src="'+attachment.url+'" style="max-width:120px;display:block;margin-bottom:8px;" />');
        });
        frame.open();
    });

    $('#student_photo_remove').on('click', function(e){
        e.preventDefault();
        $('#student_photo').val('');
        $('#student-photo-wrap img').remove();
    });

    $('#student_attachments_button').on('click', function(e){
        e.preventDefault();
        var frame2 = wp.media({
            title: 'Select attachments',
            button: { text: 'Add to student' },
            multiple: true
        });
        frame2.on('select', function(){
            var selection = frame2.state().get('selection');
            selection.map(function(att){
                att = att.toJSON();
                var cur = $('#student_attachments').val();
                var ids = cur ? cur.split(',') : [];
                ids.push(att.id);
                $('#student_attachments').val(ids.join(','));
                $('#student-attachments-wrap').append('<div class="student-attachment-item" data-id="'+att.id+'"><a href="'+att.url+'" target="_blank">'+att.filename+'</a> <button class="button-link remove-attachment">Remove</button></div>');
            });
        });
        frame2.open();
    });

    $(document).on('click', '.remove-attachment', function(e){
        e.preventDefault();
        var item = $(this).closest('.student-attachment-item');
        var id = item.data('id').toString();
        var cur = $('#student_attachments').val();
        var ids = cur ? cur.split(',') : [];
        ids = ids.filter(function(v){ return v !== id; });
        $('#student_attachments').val(ids.join(','));
        item.remove();
    });

});
*/

// --- assets/admin.css ---
// Create file at assets/admin.css with any minor admin styles if needed.

?>
