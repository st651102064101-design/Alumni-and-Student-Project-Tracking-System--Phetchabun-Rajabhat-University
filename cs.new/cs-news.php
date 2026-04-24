/* -----------------------------------------
   SHORTCODE: แสดงข่าวบนหน้าเว็บ
-------------------------------------------- */
add_shortcode('cs_news', function () {

    $news_items = get_posts([
        'post_type'      => 'cs_news',
        'posts_per_page' => 6,
        'orderby'        => 'date',
        'order'          => 'DESC'
    ]);

    if (!$news_items) {
        return "<p>ยังไม่มีข่าวประชาสัมพันธ์</p>";
    }

    $html = "<div class='cs-news-wrapper' style='display:flex;flex-wrap:wrap;gap:20px;'>";

    foreach ($news_items as $item) {

        $author  = get_post_meta($item->ID, 'cs_news_author', true);
        $img_id  = get_post_meta($item->ID, 'feature_image', true);
        $file_id = get_post_meta($item->ID, 'attached_file', true);

        $img_url  = $img_id  ? wp_get_attachment_url($img_id) : '';
        $file_url = $file_id ? wp_get_attachment_url($file_id) : '';

        $html .= "<div style='width:30%;border:1px solid #ddd;border-radius:8px;padding:10px;'>";

        if ($img_url) {
            $html .= "<img src='{$img_url}' style='width:100%;height:180px;object-fit:cover;border-radius:6px;'>";
        }

        $html .= "<h3 style='margin-top:10px;'>".esc_html($item->post_title)."</h3>";
        $html .= "<p><strong>ผู้โพสต์:</strong> ".esc_html($author)."</p>";
        $html .= "<p>".wp_trim_words($item->post_content, 25)."</p>";

        if ($file_url) {
            $html .= "<p><a href='{$file_url}' target='_blank' style='color:blue;'>ดาวน์โหลดไฟล์แนบ</a></p>";
        }

        $html .= "</div>";
    }
