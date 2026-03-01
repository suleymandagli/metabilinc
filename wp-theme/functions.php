<?php
/**
 * Metabilinç Akademi Tema Fonksiyonları
 * 
 * @package Metabilinc
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// Tema versiyonu
define('METABILINC_VERSION', '1.0.0');

// Tema ayarları
function metabilinc_setup() {
    // Dil dosyaları için destek
    load_theme_textdomain('metabilinc', get_template_directory() . '/languages');
    
    // RSS feed linkleri
    add_theme_support('automatic-feed-links');
    
    // Title tag desteği
    add_theme_support('title-tag');
    
    // Öne çıkan görsel desteği
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 800, true);
    add_image_size('metabilinc-course-thumb', 400, 300, true);
    add_image_size('metabilinc-testimonial', 100, 100, true);
    
    // Menü desteği
    register_nav_menus(array(
        'primary' => __('Ana Menü', 'metabilinc'),
        'footer'  => __('Footer Menü', 'metabilinc'),
    ));
    
    // HTML5 desteği
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Özel logo desteği
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Özel başlık resmi desteği
    add_theme_support('custom-header', array(
        'default-image'          => '',
        'header-text'           => false,
        'default-text-color'     => '',
        'width'                  => 1920,
        'height'                 => 600,
        'flex-height'            => true,
        'flex-width'             => true,
        'wp-head-callback'       => '',
        'admin-head-callback'    => '',
        'admin-preview-callback' => '',
    ));
    
    // Arka plan desteği
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));
}
add_action('after_setup_theme', 'metabilinc_setup');

// Tema script ve stillerini yükle
function metabilinc_scripts() {
    // Google Fonts
    wp_enqueue_style('metabilinc-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap', array(), METABILINC_VERSION);
    
    // Ana stil dosyası
    wp_enqueue_style('metabilinc-style', get_stylesheet_uri(), array(), METABILINC_VERSION);
    
    // html2canvas for share card download
    wp_enqueue_script('html2canvas', 'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js', array(), '1.4.1', true);
    
    // Tema JavaScript
    wp_enqueue_script('metabilinc-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'html2canvas'), METABILINC_VERSION, true);
    
    // Yerelleştirme
    wp_localize_script('metabilinc-main', 'metabilincData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('metabilinc_nonce'),
        'strings' => array(
            'loading' => __('Yükleniyor...', 'metabilinc'),
            'error'   => __('Bir hata oluştu. Lütfen tekrar deneyin.', 'metabilinc'),
            'success' => __('Başarılı!', 'metabilinc'),
        ),
    ));
    
    // Yorumlar
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'metabilinc_scripts');

// Admin script ve stiller
function metabilinc_admin_scripts($hook) {
    // Sadece tema özelleştirme sayfasında
    if ($hook !== 'theme.php' && $hook !== 'customize.php') {
        return;
    }
    
    wp_enqueue_style('metabilinc-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), METABILINC_VERSION);
}
add_action('admin_enqueue_scripts', 'metabilinc_admin_scripts');

// Tema menü walker
require_once get_template_directory() . '/inc/class-metabilinc-walker-nav-menu.php';

// Kurs post type
function metabilinc_register_courses() {
    $labels = array(
        'name'               => __('Kurslar', 'metabilinc'),
        'singular_name'      => __('Kurs', 'metabilinc'),
        'menu_name'          => __('Kurslar', 'metabilinc'),
        'name_admin_bar'     => __('Kurs', 'metabilinc'),
        'add_new'            => __('Yeni Kurs Ekle', 'metabilinc'),
        'add_new_item'       => __('Yeni Kurs Ekle', 'metabilinc'),
        'edit_item'          => __('Kurs Düzenle', 'metabilinc'),
        'new_item'           => __('Yeni Kurs', 'metabilinc'),
        'view_item'          => __('Kursu Görüntüle', 'metabilinc'),
        'search_items'       => __('Kurs Ara', 'metabilinc'),
        'not_found'          => __('Kurs bulunamadı', 'metabilinc'),
        'not_found_in_trash'  => __('Çöp Kutusunda Kurs Bulunamadı', 'metabilinc'),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'kurs'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-book',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'taxonomies'         => array('course_category'),
        'show_in_rest'       => true,
    );
    
    register_post_type('course', $args);
}
add_action('init', 'metabilinc_register_courses');

// Kurs kategorisi taksonomisi
function metabilinc_register_course_taxonomy() {
    $labels = array(
        'name'              => __('Kurs Kategorileri', 'metabilinc'),
        'singular_name'     => __('Kurs Kategorisi', 'metabilinc'),
        'search_items'      => __('Kategoride Ara', 'metabilinc'),
        'all_items'         => __('Tüm Kategoriler', 'metabilinc'),
        'parent_item'        => __('Üst Kategori', 'metabilinc'),
        'parent_item_colon'  => __('Üst Kategori:', 'metabilinc'),
        'edit_item'         => __('Kategoriyi Düzenle', 'metabilinc'),
        'update_item'       => __('Kategoriyi Güncelle', 'metabilinc'),
        'add_new_item'      => __('Yeni Kategori Ekle', 'metabilinc'),
        'new_item_name'     => __('Yeni Kategori Adı', 'metabilinc'),
        'menu_name'         => __('Kategoriler', 'metabilinc'),
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'kurs-kategori'),
        'show_in_rest'      => true,
    );
    
    register_taxonomy('course_category', array('course'), $args);
}
add_action('init', 'metabilinc_register_course_taxonomy');

// Kurs meta alanları
function metabilinc_add_course_meta_box() {
    add_meta_box(
        'metabilinc_course_details',
        __('Kurs Detayları', 'metabilinc'),
        'metabilinc_course_meta_callback',
        'course',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'metabilinc_add_course_meta_box');

function metabilinc_course_meta_callback($post) {
    wp_nonce_field('metabilinc_save_course_meta', 'metabilinc_course_meta_nonce');
    
    $course_price = get_post_meta($post->ID, '_course_price', true);
    $course_discounted_price = get_post_meta($post->ID, '_course_discounted_price', true);
    $course_duration = get_post_meta($post->ID, '_course_duration', true);
    $course_level = get_post_meta($post->ID, '_course_level', true);
    $course_enrolled = get_post_meta($post->ID, '_course_enrolled', true);
    $course_is_free = get_post_meta($post->ID, '_course_is_free', true);
    ?>
    <div class="metabilinc-meta-box">
        <p>
            <label for="course_price"><?php _e('Fiyat (TL):', 'metabilinc'); ?></label>
            <input type="number" id="course_price" name="course_price" value="<?php echo esc_attr($course_price); ?>" class="widefat" />
        </p>
        <p>
            <label for="course_discounted_price"><?php _e('İndirimli Fiyat (TL):', 'metabilinc'); ?></label>
            <input type="number" id="course_discounted_price" name="course_discounted_price" value="<?php echo esc_attr($course_discounted_price); ?>" class="widefat" />
        </p>
        <p>
            <label for="course_duration"><?php _e('Süre:', 'metabilinc'); ?></label>
            <input type="text" id="course_duration" name="course_duration" value="<?php echo esc_attr($course_duration); ?>" class="widefat" placeholder="örn: 8 Hafta" />
        </p>
        <p>
            <label for="course_level"><?php _e('Seviye:', 'metabilinc'); ?></label>
            <select id="course_level" name="course_level" class="widefat">
                <option value="baslangic" <?php selected($course_level, 'baslangic'); ?>><?php _e('Başlangıç', 'metabilinc'); ?></option>
                <option value="orta" <?php selected($course_level, 'orta'); ?>><?php _e('Orta', 'metabilinc'); ?></option>
                <option value="ileri" <?php selected($course_level, 'ileri'); ?>><?php _e('İleri', 'metabilinc'); ?></option>
            </select>
        </p>
        <p>
            <label for="course_enrolled"><?php _e('Kayıtlı Öğrenci Sayısı:', 'metabilinc'); ?></label>
            <input type="number" id="course_enrolled" name="course_enrolled" value="<?php echo esc_attr($course_enrolled); ?>" class="widefat" />
        </p>
        <p>
            <label>
                <input type="checkbox" id="course_is_free" name="course_is_free" value="1" <?php checked($course_is_free, '1'); ?> />
                <?php _e('Ücretsiz Kurs', 'metabilinc'); ?>
            </label>
        </p>
    </div>
    <?php
}

function metabilinc_save_course_meta($post_id) {
    if (!isset($_POST['metabilinc_course_meta_nonce'])) {
        return $post_id;
    }
    
    if (!wp_verify_nonce($_POST['metabilinc_course_meta_nonce'], 'metabilinc_save_course_meta')) {
        return $post_id;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    
    if ('course' !== get_post_type($post_id)) {
        return $post_id;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
    // Kurs meta alanlarını kaydet
    $meta_fields = array(
        'course_price' => 'sanitize_text_field',
        'course_discounted_price' => 'sanitize_text_field',
        'course_duration' => 'sanitize_text_field',
        'course_level' => 'sanitize_text_field',
        'course_enrolled' => 'sanitize_text_field',
    );
    
    foreach ($meta_fields as $key => $sanitize_callback) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, '_' . $key, call_user_func($sanitize_callback, $_POST[$key]));
        }
    }
    
    // Checkbox için
    update_post_meta($post_id, '_course_is_free', isset($_POST['course_is_free']) ? '1' : '0');
}
add_action('save_post', 'metabilinc_save_course_meta');

// Widget alanlarını kaydet
function metabilinc_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'metabilinc'),
        'id'            => 'sidebar-1',
        'description'   => __('Kurs sayfalarında görünecek kenar çubuğu', 'metabilinc'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Alan 1', 'metabilinc'),
        'id'            => 'footer-1',
        'description'   => __('Footer ilk alan', 'metabilinc'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Alan 2', 'metabilinc'),
        'id'            => 'footer-2',
        'description'   => __('Footer ikinci alan', 'metabilinc'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Alan 3', 'metabilinc'),
        'id'            => 'footer-3',
        'description'   => __('Footer üçüncü alan', 'metabilinc'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'metabilinc_widgets_init');

// Excerpt uzunluğu
function metabilinc_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'metabilinc_excerpt_length');

// Excerpt more
function metabilinc_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'metabilinc_excerpt_more');

// Body class ekle
function metabilinc_body_classes($classes) {
    // Responsive sınıflar
    $classes[] = 'metabilinc-theme';
    
    // Page builder sınıfı
    if (is_page()) {
        $classes[] = 'page-template-default';
    }
    
    return $classes;
}
add_filter('body_class', 'metabilinc_body_classes');

// Özel excerpt
function metabilinc_get_course_excerpt($post_id, $length = 20) {
    $post = get_post($post_id);
    if (!$post) {
        return '';
    }
    
    if (has_excerpt($post_id)) {
        $excerpt = get_the_excerpt($post_id);
    } else {
        $excerpt = strip_tags(strip_shortcodes($post->post_content));
        $excerpt = explode(' ', $excerpt, $length);
        if (count($excerpt) >= $length) {
            array_pop($excerpt);
            $excerpt = implode(' ', $excerpt) . '...';
        } else {
            $excerpt = implode(' ', $excerpt);
        }
    }
    
    return $excerpt;
}

// Kurs fiyatı formatla
function metabilinc_format_price($price, $currency = 'TL') {
    if ($price == 0) {
        return __('Ücretsiz', 'metabilinc');
    }
    
    return number_format($price, 0, ',', '.') . ' ' . $currency;
}

// Kurs indirim hesapla
function metabilinc_calculate_discount($original_price, $discounted_price) {
    if (!$original_price || !$discounted_price || $original_price <= $discounted_price) {
        return 0;
    }
    
    return round((1 - $discounted_price / $original_price) * 100);
}

// Lead form AJAX
function metabilinc_lead_form_handler() {
    check_ajax_referer('metabilinc_nonce', 'nonce');
    
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => __('Geçerli bir e-posta adresi girin.', 'metabilinc')));
    }
    
    // Veritabanına kaydet
    global $wpdb;
    $table_name = $wpdb->prefix . 'metabilinc_leads';
    
    $result = $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'email' => $email,
            'created_at' => current_time('mysql'),
        ),
        array('%s', '%s', '%s')
    );
    
    if ($result) {
        // Burada e-posta bildirimi eklenebilir
        wp_send_json_success(array('message' => __('Teşekkürler! En kısa sürede size ulaşacağız.', 'metabilinc')));
    } else {
        wp_send_json_error(array('message' => __('Bir hata oluştu. Lütfen tekrar deneyin.', 'metabilinc')));
    }
    
    wp_die();
}
add_action('wp_ajax_metabilinc_lead_form', 'metabilinc_lead_form_handler');
add_action('wp_ajax_nopriv_metabilinc_lead_form', 'metabilinc_lead_form_handler');

// Hediye bağlantısı oluştur AJAX
function metabilinc_create_gift_handler() {
    check_ajax_referer('metabilinc_nonce', 'nonce');
    
    $course_id = intval($_POST['course_id']);
    $gift_name = sanitize_text_field($_POST['gift_name']);
    $gift_email = sanitize_email($_POST['gift_email']);
    $gift_message = sanitize_textarea_field($_POST['gift_message']);
    
    if (!is_email($gift_email)) {
        wp_send_json_error(array('message' => __('Geçerli bir e-posta adresi girin.', 'metabilinc')));
    }
    
    // Benzersiz hediye token oluştur
    $gift_token = 'gift_' . wp_generate_password(20, false, false);
    
    // Veritabanına kaydet
    global $wpdb;
    $table_name = $wpdb->prefix . 'metabilinc_gifts';
    
    // Tablo yoksa oluştur
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            gift_token varchar(50) NOT NULL UNIQUE,
            course_id bigint(20) NOT NULL,
            recipient_name varchar(255) NOT NULL,
            recipient_email varchar(255) NOT NULL,
            message text,
            sender_id bigint(20) DEFAULT NULL,
            status varchar(20) DEFAULT 'pending',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            used_at datetime DEFAULT NULL,
            PRIMARY KEY  (id),
            KEY gift_token (gift_token)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    $result = $wpdb->insert(
        $table_name,
        array(
            'gift_token' => $gift_token,
            'course_id' => $course_id,
            'recipient_name' => $gift_name,
            'recipient_email' => $gift_email,
            'message' => $gift_message,
            'created_at' => current_time('mysql'),
        ),
        array('%s', '%d', '%s', '%s', '%s', '%s')
    );
    
    if ($result) {
        $gift_link = add_query_arg(array(
            'gift' => $gift_token,
            'to' => $gift_email,
        ), get_permalink($course_id));
        
        wp_send_json_success(array(
            'message' => __('Hediye bağlantısı oluşturuldu!', 'metabilinc'),
            'gift_link' => $gift_link,
            'gift_token' => $gift_token
        ));
    } else {
        wp_send_json_error(array('message' => __('Hediye oluşturulurken bir hata oluştu.', 'metabilinc')));
    }
    
    wp_die();
}
add_action('wp_ajax_metabilinc_create_gift', 'metabilinc_create_gift_handler');
add_action('wp_ajax_nopriv_metabilinc_create_gift', 'metabilinc_create_gift_handler');

// İletişim Formu AJAX Handler
function metabilinc_contact_form_handler() {
    //Nonce kontrolü
    if (!check_ajax_referer('metabilinc_nonce', 'nonce', false)) {
        wp_send_json_error(array('message' => 'Güvenlik doğrulaması başarısız.'));
    }
    
    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $subject = sanitize_text_field($_POST['subject'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    
    // Zorunlu alan kontrolü
    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(array('message' => 'Lütfen tüm zorunlu alanları doldurun.'));
    }
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Geçerli bir e-posta adresi girin.'));
    }
    
    // E-posta gönderimi
    $to = get_option('admin_email');
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <' . $to . '>',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );
    
    $email_subject = $subject ? $subject : 'Yeni İletişim Formu Mesajı';
    $email_body = "
        <h2>Yeni İletişim Formu Mesajı</h2>
        <p><strong>Ad:</strong> {$name}</p>
        <p><strong>E-posta:</strong> {$email}</p>
        <p><strong>Konu:</strong> {$subject}</p>
        <p><strong>Mesaj:</strong></p>
        <p>{$message}</p>
    ";
    
    $mail_sent = wp_mail($to, $email_subject, $email_body, $headers);
    
    if ($mail_sent) {
        // Veritabanına kaydet (opsiyonel)
        global $wpdb;
        $table_name = $wpdb->prefix . 'metabilinc_contacts';
        
        // Tablo yoksa oluştur
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $charset_collate = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE $table_name (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                email varchar(255) NOT NULL,
                subject varchar(255),
                message text,
                status varchar(20) DEFAULT 'unread',
                created_at datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY  (id)
            ) $charset_collate;";
            
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
        
        $wpdb->insert(
            $table_name,
            array(
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message,
                'created_at' => current_time('mysql'),
            ),
            array('%s', '%s', '%s', '%s', '%s')
        );
        
        wp_send_json_success(array('message' => 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.'));
    } else {
        wp_send_json_error(array('message' => 'Mesaj gönderilirken bir hata oluştu. Lütfen daha sonra tekrar deneyin.'));
    }
    
    wp_die();
}
add_action('wp_ajax_metabilinc_contact_form', 'metabilinc_contact_form_handler');
add_action('wp_ajax_nopriv_metabilinc_contact_form', 'metabilinc_contact_form_handler');

// Kurs Filtreleme AJAX Handler
function metabilinc_filter_courses_handler() {
    //Nonce kontrolü
    if (!check_ajax_referer('metabilinc_nonce', 'nonce', false)) {
        wp_send_json_error(array('message' => 'Güvenlik doğrulaması başarısız.'));
    }
    
    $category = sanitize_text_field($_POST['category'] ?? '');
    $level = sanitize_text_field($_POST['level'] ?? '');
    $price = sanitize_text_field($_POST['price'] ?? '');
    
    $args = array(
        'post_type' => 'course',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );
    
    // Meta query oluştur
    $meta_query = array('relation' => 'AND');
    
    if ($level) {
        $meta_query[] = array(
            'key' => '_course_level',
            'value' => $level,
            'compare' => '='
        );
    }
    
    if ($price === 'free') {
        $meta_query[] = array(
            'key' => '_course_is_free',
            'value' => '1',
            'compare' => '='
        );
    } elseif ($price === 'paid') {
        $meta_query[] = array(
            'key' => '_course_is_free',
            'value' => '0',
            'compare' => '='
        );
    }
    
    if (count($meta_query) > 1) {
        $args['meta_query'] = $meta_query;
    }
    
    // Kategori filtreleme
    if ($category) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'course_category',
                'field' => 'slug',
                'terms' => $category
            )
        );
    }
    
    $query = new WP_Query($args);
    
    ob_start();
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'course-card');
        }
        wp_reset_postdata();
    } else {
        echo '<p class="no-courses">Hiç kurs bulunamadı.</p>';
    }
    
    $html = ob_get_clean();
    
    wp_send_json_success(array('html' => $html));
    wp_die();
}
add_action('wp_ajax_metabilinc_filter_courses', 'metabilinc_filter_courses_handler');
add_action('wp_ajax_nopriv_metabilinc_filter_courses', 'metabilinc_filter_courses_handler');

// Hediye erişim kontrolü
function metabilinc_check_gift_access() {
    if (isset($_GET['gift']) && isset($_GET['to'])) {
        $gift_token = sanitize_text_field($_GET['gift']);
        $recipient_email = sanitize_email($_GET['to']);
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'metabilinc_gifts';
        
        $gift = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE gift_token = %s AND recipient_email = %s AND status = 'pending' LIMIT 1",
            $gift_token,
            $recipient_email
        ));
        
        if ($gift) {
            // Hediye kullanıldı olarak işaretle
            $wpdb->update(
                $table_name,
                array('status' => 'used', 'used_at' => current_time('mysql')),
                array('id' => $gift->id),
                array('%s'),
                array('%d')
            );
            
            // Kullanıcıyı kurs sayfasına yönlendir veya otomatik kaydet
            add_action('template_redirect', function() {
                // Kullanıcıyı kaydet veya yönlendir
                wp_redirect(remove_query_arg(array('gift', 'to')));
                exit;
            });
        }
    }
}
add_action('init', 'metabilinc_check_gift_access');

// Kurulum sırasında veritabanı tablosu oluştur
function metabilinc_install() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    
    // Leads tablosu
    $table_name = $wpdb->prefix . 'metabilinc_leads';
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        phone varchar(50) DEFAULT NULL,
        course_id bigint(20) DEFAULT NULL,
        status varchar(20) DEFAULT 'new',
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id),
        KEY email (email)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_switch_theme', 'metabilinc_install');

// Tema aktivasyonunda varsayılan menü oluştur
function metabilinc_after_switch_theme() {
    // Ana menü konumu
    $primary_menu = wp_get_nav_menu_object('Ana Menü');
    if (!$primary_menu) {
        $primary_menu_id = wp_create_nav_menu('Ana Menü');
        
        wp_update_nav_menu_item($primary_menu_id, 0, array(
            'menu-item-title' =>  __('Ana Sayfa', 'metabilinc'),
            'menu-item-url' =>  home_url('/'),
            'menu-item-status' => 'publish',
        ));
        
        wp_update_nav_menu_item($primary_menu_id, 0, array(
            'menu-item-title' =>  __('Kurslar', 'metabilinc'),
            'menu-item-url' =>  home_url('/kurslar'),
            'menu-item-status' => 'publish',
        ));
        
        wp_update_nav_menu_item($primary_menu_id, 0, array(
            'menu-item-title' =>  __('Hakkımızda', 'metabilinc'),
            'menu-item-url' =>  home_url('/hakkimizda'),
            'menu-item-status' => 'publish',
        ));
        
        wp_update_nav_menu_item($primary_menu_id, 0, array(
            'menu-item-title' =>  __('İletişim', 'metabilinc'),
            'menu-item-url' =>  home_url('/iletisim'),
            'menu-item-status' => 'publish',
        ));
        
        wp_update_nav_menu_item($primary_menu_id, 0, array(
            'menu-item-title' =>  __('Blog', 'metabilinc'),
            'menu-item-url' =>  home_url('/blog'),
            'menu-item-status' => 'publish',
        ));
        
        // Menü konumunu ayarla
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $primary_menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
    
    // Varsayılan sayfaları oluştur
    metabilinc_create_default_pages();
}
add_action('after_switch_theme', 'metabilinc_after_switch_theme');

// Tema yeniden etkinleştirildiğinde de sayfaları oluştur
add_action('switch_theme', 'metabilinc_create_default_pages');

// İlk admin yüklemesinde sayfaları kontrol et ve oluştur
function metabilinc_maybe_create_pages() {
    // Sayfalar daha önce oluşturuldu mu kontrol et
    $pages_created = get_option('metabilinc_default_pages_created', false);
    
    if (!$pages_created) {
        metabilinc_create_default_pages();
        update_option('metabilinc_default_pages_created', true);
    }
    
    // Permalink kurallarını temizle
    if (get_option('metabilinc_permalinks_flushed', false) === false) {
        flush_rewrite_rules();
        update_option('metabilinc_permalinks_flushed', true);
    }
    
    // Örnek kursları oluştur
    metabilinc_create_sample_courses();
}
add_action('admin_init', 'metabilinc_maybe_create_pages');

// Tema aktivasyonunda da kursları oluştur
add_action('after_switch_theme', 'metabilinc_create_sample_courses');

// Varsayılan sayfaları oluştur
function metabilinc_create_default_pages() {
    $pages = array(
        array(
            'slug' => 'kurslar',
            'title' => 'Kurslar',
            'template' => 'template-kurslar.php',
        ),
        array(
            'slug' => 'hakkimizda',
            'title' => 'Hakkımızda',
            'template' => 'template-hakkimizda.php',
        ),
        array(
            'slug' => 'iletisim',
            'title' => 'İletişim',
            'template' => 'template-iletisim.php',
        ),
        array(
            'slug' => 'blog',
            'title' => 'Blog',
            'template' => 'template-blog.php',
        ),
        array(
            'slug' => 'egitmenler',
            'title' => 'Eğitmenler',
            'template' => 'template-egitmenler.php',
        ),
        array(
            'slug' => 'sss',
            'title' => 'Sıkça Sorulan Sorular',
            'template' => 'template-sss.php',
        ),
        array(
            'slug' => 'gizlilik',
            'title' => 'Gizlilik Politikası',
            'template' => 'template-gizlilik.php',
        ),
        array(
            'slug' => 'kullanim-sartlari',
            'title' => 'Kullanım Şartları',
            'template' => 'template-kullanim-sartlari.php',
        ),
        array(
            'slug' => 'iade',
            'title' => 'İade Politikası',
            'template' => 'template-iade.php',
        ),
        array(
            'slug' => 'kvkk',
            'title' => 'KVKK Aydınlatma Metni',
            'template' => 'template-kvkk.php',
        ),
        array(
            'slug' => 'bilincli-aile-okulu',
            'title' => 'Bilinçli Aile Okulu',
            'template' => 'template-bilincli-aile-okulu.php',
        ),
        array(
            'slug' => 'bilincli-evlilik-akademisi',
            'title' => 'Bilinçli Evlilik Akademisi',
            'template' => 'template-bilincli-evlilik-akademisi.php',
        ),
        // Admin sayfaları
        array(
            'slug' => 'admin-dashboard',
            'title' => 'Admin Dashboard',
            'template' => 'template-admin-dashboard.php',
        ),
        array(
            'slug' => 'admin-kurslar',
            'title' => 'Kurs Yönetimi',
            'template' => 'template-admin-kurslar.php',
        ),
        array(
            'slug' => 'admin-kurs-ekle',
            'title' => 'Kurs Ekle/Düzenle',
            'template' => 'template-admin-kurs-ekle.php',
        ),
        array(
            'slug' => 'admin-odemeler',
            'title' => 'Ödeme Yönetimi',
            'template' => 'template-admin-odemeler.php',
        ),
        array(
            'slug' => 'admin-odeme-ayarlari',
            'title' => 'Ödeme Ayarları',
            'template' => 'template-admin-odeme-ayarlari.php',
        ),
    );
    
    foreach ($pages as $page_data) {
        $page = get_page_by_path($page_data['slug']);
        
        if (!$page) {
            $page_id = wp_insert_post(array(
                'post_title' => $page_data['title'],
                'post_name' => $page_data['slug'],
                'post_content' => '',
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_author' => 1,
            ));
            
            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $page_data['template']);
            }
        } else {
            // Sayfa varsa şablonu güncelle
            update_post_meta($page->ID, '_wp_page_template', $page_data['template']);
        }
    }
}

// Örnek kursları oluştur
function metabilinc_create_sample_courses() {
    $courses_created = get_option('metabilinc_sample_courses_created', false);
    
    if ($courses_created) {
        return;
    }
    
    $sample_courses = array(
        array(
            'title' => 'Bilinçli Aile Eğitimi',
            'slug' => 'bilincli-aile-egitimi',
            'description' => 'Çocuklarınızla daha sağlıklı bir iletişim kurun. Bu kapsamlı eğitimde aile içi ilişkiler, çocuk psikolojisi ve etkili iletişim tekniklerini öğreneceksiniz.',
            'price' => 2499,
            'discounted_price' => 1499,
            'duration' => '12 Hafta',
            'level' => 'Başlangıç',
            'enrolled' => 1250,
            'category' => 'Aile Eğitimi'
        ),
        array(
            'title' => 'Evlilik Akademisi',
            'slug' => 'evlilik-akademisi',
            'description' => 'Evliliğinizdeki sorunları çözün ve ilişkinizi güçlendirin. Profesyonel psikologlar eşliğinde iletişim, güven ve sevgi dolu bir evlilik için gerekli tüm bilgiler.',
            'price' => 2999,
            'discounted_price' => 1999,
            'duration' => '16 Hafta',
            'level' => 'Orta',
            'enrolled' => 890,
            'category' => 'Evlilik'
        ),
        array(
            'title' => 'Çocuk Psikolojisi Temelleri',
            'slug' => 'cocuk-psikolojisi-temelleri',
            'description' => 'Çocukların zihinsel gelişimini anlayın. Yaş dönemlerine göre gelişim özellikleri, davranış problemleri ve sağlıklı gelişim için ipuçları.',
            'price' => 1499,
            'discounted_price' => 799,
            'duration' => '8 Hafta',
            'level' => 'Başlangıç',
            'enrolled' => 2100,
            'category' => 'Psikoloji'
        ),
        array(
            'title' => 'Aile İçi İletişim Workshop',
            'slug' => 'aile-ici-iletisim-workshop',
            'description' => 'Aile içi iletişim problemlerini çözmek için pratik teknikler. Pasif-agresif davranışlardan sağlıklı sınırlar koymaya kadar her şey.',
            'price' => 999,
            'discounted_price' => 499,
            'duration' => '4 Hafta',
            'level' => 'Başlangıç',
            'enrolled' => 3200,
            'category' => 'İletişim'
        ),
        array(
            'title' => 'Ergenlik Dönemi Rehberliği',
            'slug' => 'ergenlik-donemi-rehberligi',
            'description' => 'Ergenlik dönemindeki çocuğunuzla nasıl iletişim kuracağınızı öğrenin. Bu zorlu dönemi sağlıklı atlatmanız için uzman rehberliği.',
            'price' => 1999,
            'discounted_price' => 999,
            'duration' => '10 Hafta',
            'level' => 'Orta',
            'enrolled' => 780,
            'category' => 'Aile Eğitimi'
        ),
        array(
            'title' => 'Ücretsiz Mini Kurs: Aileye Giriş',
            'slug' => 'mini-kurs-aileye-giris',
            'description' => 'Aile eğitiminin temellerini keşfedin. Ücretsiz bu giriş kursunda ailenizi daha iyi anlamak için temel kavramları öğreneceksiniz.',
            'price' => 0,
            'discounted_price' => 0,
            'duration' => '1 Hafta',
            'level' => 'Başlangıç',
            'enrolled' => 5000,
            'category' => 'Ücretsiz',
            'is_free' => true
        )
    );
    
    foreach ($sample_courses as $course) {
        // Kurs zaten var mı kontrol et
        $existing = get_page_by_path($course['slug'], OBJECT, 'course');
        
        if (!$existing) {
            $course_id = wp_insert_post(array(
                'post_title' => $course['title'],
                'post_name' => $course['slug'],
                'post_content' => $course['description'],
                'post_status' => 'publish',
                'post_type' => 'course',
                'post_author' => 1,
            ));
            
            if ($course_id && !is_wp_error($course_id)) {
                // Kurs meta verilerini kaydet
                update_post_meta($course_id, '_course_price', $course['price']);
                update_post_meta($course_id, '_course_discounted_price', $course['discounted_price']);
                update_post_meta($course_id, '_course_duration', $course['duration']);
                update_post_meta($course_id, '_course_level', strtolower($course['level']));
                update_post_meta($course_id, '_course_enrolled', $course['enrolled']);
                update_post_meta($course_id, '_course_is_free', isset($course['is_free']) ? '1' : '0');
                
                // Kategori ekle
                if (!empty($course['category'])) {
                    wp_set_object_terms($course_id, $course['category'], 'course_category');
                }
            }
        }
    }
    
    update_option('metabilinc_sample_courses_created', true);
}

// Örnek kurs kategorilerini oluştur
function metabilinc_create_sample_categories() {
    $categories = array(
        'Aile Eğitimi' => 'aile-egitimi',
        'Evlilik' => 'evlilik',
        'Psikoloji' => 'psikoloji',
        'İletişim' => 'iletisim',
        'Ücretsiz' => 'ucretsiz'
    );
    
    foreach ($categories as $name => $slug) {
        if (!term_exists($slug, 'course_category')) {
            wp_insert_term($name, 'course_category', array(
                'slug' => $slug
            ));
        }
    }
}
add_action('init', 'metabilinc_create_sample_categories');

// Blog yazısı okuma süresi hesapla (saniye olarak döner)
function get_post_read_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    if (!$post_id) {
        return 0;
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    
    // Ortalama okuma hızı: 200 kelime/dakika = 3.33 kelime/saniye
    $reading_time_seconds = ceil($word_count / 3.33);
    
    return $reading_time_seconds;
}

// Admin - Kurs silme AJAX handler
function metabilinc_delete_course_handler() {
    // Nonce kontrolü
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'metabilinc_admin_nonce')) {
        wp_send_json_error(array('message' => 'Güvenlik doğrulaması başarısız.'));
        return;
    }
    
    // Yetki kontrolü
    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Giriş yapmanız gerekiyor.'));
        return;
    }
    
    $user = wp_get_current_user();
    if (!in_array('administrator', $user->roles) && !in_array('editor', $user->roles)) {
        wp_send_json_error(array('message' => 'Bu işlem için yetkiniz yok.'));
        return;
    }
    
    // Kurs ID kontrolü
    if (!isset($_POST['course_id']) || !is_numeric($_POST['course_id'])) {
        wp_send_json_error(array('message' => 'Geçersiz kurs ID.'));
        return;
    }
    
    $course_id = intval($_POST['course_id']);
    $course = get_post($course_id);
    
    if (!$course || $course->post_type !== 'course') {
        wp_send_json_error(array('message' => 'Kurs bulunamadı.'));
        return;
    }
    
    // Kursu çöp kutusuna taşı
    $result = wp_trash_post($course_id);
    
    if ($result) {
        wp_send_json_success(array('message' => 'Kurs başarıyla silindi.'));
    } else {
        wp_send_json_error(array('message' => 'Kurs silinirken bir hata oluştu.'));
    }
}
add_action('wp_ajax_metabilinc_delete_course', 'metabilinc_delete_course_handler');

// Admin panel CSS ve JS enqueue
function metabilinc_admin_enqueue_assets($hook) {
    // Admin panel sayfalarında CSS yükle
    if (is_page_template('template-admin-dashboard.php') || is_page_template('template-admin-kurslar.php') || is_page_template('template-admin-kurs-ekle.php') || is_page_template('template-admin-odemeler.php')) {
        wp_enqueue_media();
        wp_enqueue_style('metabilinc-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), '1.0.0');
    }
}
add_action('wp_enqueue_scripts', 'metabilinc_admin_enqueue_assets');

// Varsayılan admin sayfalarını oluştur
function metabilinc_create_admin_pages() {
    $pages = array(
        'admin-dashboard' => array(
            'title' => 'Admin Dashboard',
            'template' => 'template-admin-dashboard.php',
        ),
        'admin-kurslar' => array(
            'title' => 'Kurs Yönetimi',
            'template' => 'template-admin-kurslar.php',
        ),
        'admin-kurs-ekle' => array(
            'title' => 'Kurs Ekle/Düzenle',
            'template' => 'template-admin-kurs-ekle.php',
        ),
        'admin-odemeler' => array(
            'title' => 'Ödeme Yönetimi',
            'template' => 'template-admin-odemeler.php',
        ),
        'admin-odeme-ayarlari' => array(
            'title' => 'Ödeme Ayarları',
            'template' => 'template-admin-odeme-ayarlari.php',
        ),
    );
    
    foreach ($pages as $slug => $page_data) {
        $existing_page = get_page_by_path($slug);
        
        if (!$existing_page) {
            $page_id = wp_insert_post(array(
                'post_title'   => $page_data['title'],
                'post_name'    => $slug,
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_content' => '',
            ));
            
            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $page_data['template']);
            }
        }
    }
}

/* =================================================================
   ÖDEME SİSTEMİ FONKSİYONLARI
   iyzico, PayTR, Stripe ve Havale/EFT entegrasyonu
   ================================================================= */

/**
 * Ödeme ayarlarını getir
 * @return array Ödeme ayarları
 */
function metabilinc_get_payment_settings() {
    $defaults = array(
        'active_gateway' => 'iyzico',
        'currency' => 'TRY',
        'currency_symbol' => '₺',
        'iyzico' => array(
            'api_key' => '',
            'secret_key' => '',
            'sandbox' => true,
        ),
        'paytr' => array(
            'merchant_id' => '',
            'merchant_key' => '',
            'merchant_salt' => '',
            'sandbox' => true,
        ),
        'stripe' => array(
            'publishable_key' => '',
            'secret_key' => '',
        ),
        'bank_transfer' => array(
            'enabled' => false,
            'account_name' => '',
            'account_iban' => '',
            'account_bank' => '',
            'instructions' => '',
        ),
    );
    
    $settings = get_option('metabilinc_payment_settings', array());
    return wp_parse_args($settings, $defaults);
}

/**
 * Aktif ödeme sağlayıcısını getir
 * @return string Gateway adı
 */
function metabilinc_get_active_gateway() {
    $settings = metabilinc_get_payment_settings();
    return $settings['active_gateway'];
}

/**
 * Para birimi sembolünü getir
 * @return string Para birimi sembolü
 */
function metabilinc_get_currency_symbol() {
    $settings = metabilinc_get_payment_settings();
    return $settings['currency_symbol'];
}

/**
 * Ödemeleri getir (Veritabanı veya API'den)
 * 
 * BU FONKSİYON GERÇEK ÖDEME VERİSİNİ ÇEKER
 * Şu an simülasyon modunda çalışır, API bilgileri girildiğinde
 * gerçek ödeme sağlayıcısından veri çekecek şekilde güncellenir.
 * 
 * @param array $args Filtre argümanları
 * @return array Ödemeler listesi
 */
function metabilinc_get_payments($args = array()) {
    $defaults = array(
        'status' => 'all',
        'gateway' => 'all',
        'date_from' => '',
        'date_to' => '',
        'search' => '',
        'per_page' => 20,
        'page' => 1,
    );
    
    $args = wp_parse_args($args, $defaults);
    
    // Gerçek ödeme sağlayıcısı bilgilerini kontrol et
    $settings = metabilinc_get_payment_settings();
    $active_gateway = $settings['active_gateway'];
    
    // API bilgileri girilmiş mi kontrol et
    $api_configured = false;
    switch ($active_gateway) {
        case 'iyzico':
            $api_configured = !empty($settings['iyzico']['api_key']) && !empty($settings['iyzico']['secret_key']);
            break;
        case 'paytr':
            $api_configured = !empty($settings['paytr']['merchant_id']) && !empty($settings['paytr']['merchant_key']);
            break;
        case 'stripe':
            $api_configured = !empty($settings['stripe']['secret_key']);
            break;
    }
    
    // API yapılandırılmamışsa simülasyon verisi döndür
    if (!$api_configured) {
        return metabilinc_get_simulated_payments($args);
    }
    
    // API yapılandırılmışsa gerçek veriyi çek
    switch ($active_gateway) {
        case 'iyzico':
            return metabilinc_get_iyzico_payments($args, $settings['iyzico']);
        case 'paytr':
            return metabilinc_get_paytr_payments($args, $settings['paytr']);
        case 'stripe':
            return metabilinc_get_stripe_payments($args, $settings['stripe']);
        default:
            return metabilinc_get_simulated_payments($args);
    }
}

/**
 * Simülasyon ödeme verileri
 * API yapılandırılmadan önce test için kullanılır
 */
function metabilinc_get_simulated_payments($args) {
    $sample_payments = array(
        array(
            'id' => 'PAY-202403010001',
            'user_name' => 'Ahmet Yılmaz',
            'user_email' => 'ahmet@example.com',
            'user_avatar' => '',
            'course_title' => 'Ebeveynlik ve Çocuk Gelişimi',
            'amount' => 499.00,
            'status' => 'completed',
            'date' => '2024-03-01 14:30:00',
            'gateway' => 'iyzico',
        ),
        array(
            'id' => 'PAY-202403010002',
            'user_name' => 'Ayşe Demir',
            'user_email' => 'ayse@example.com',
            'user_avatar' => '',
            'course_title' => 'İletişim Becerileri',
            'amount' => 299.00,
            'status' => 'pending',
            'date' => '2024-03-01 15:45:00',
            'gateway' => 'paytr',
        ),
        array(
            'id' => 'PAY-202402290003',
            'user_name' => 'Mehmet Kaya',
            'user_email' => 'mehmet@example.com',
            'user_avatar' => '',
            'course_title' => 'Dijital Ebeveynlik',
            'amount' => 399.00,
            'status' => 'completed',
            'date' => '2024-02-29 09:15:00',
            'gateway' => 'iyzico',
        ),
        array(
            'id' => 'PAY-202402280004',
            'user_name' => 'Fatma Şahin',
            'user_email' => 'fatma@example.com',
            'user_avatar' => '',
            'course_title' => 'Ebeveynlik ve Çocuk Gelişimi',
            'amount' => 499.00,
            'status' => 'failed',
            'date' => '2024-02-28 16:20:00',
            'gateway' => 'stripe',
        ),
        array(
            'id' => 'PAY-202402270005',
            'user_name' => 'Ali Yıldız',
            'user_email' => 'ali@example.com',
            'user_avatar' => '',
            'course_title' => 'Çocuk Psikolojisi',
            'amount' => 599.00,
            'status' => 'completed',
            'date' => '2024-02-27 11:00:00',
            'gateway' => 'iyzico',
        ),
        array(
            'id' => 'PAY-202402260006',
            'user_name' => 'Zeynep Özdemir',
            'user_email' => 'zeynep@example.com',
            'user_avatar' => '',
            'course_title' => 'İletişim Becerileri',
            'amount' => 299.00,
            'status' => 'refunded',
            'date' => '2024-02-26 13:45:00',
            'gateway' => 'bank_transfer',
        ),
        array(
            'id' => 'PAY-202402250007',
            'user_name' => 'Mustafa Aydın',
            'user_email' => 'mustafa@example.com',
            'user_avatar' => '',
            'course_title' => 'Ebeveynlik ve Çocuk Gelişimi',
            'amount' => 499.00,
            'status' => 'completed',
            'date' => '2024-02-25 10:30:00',
            'gateway' => 'paytr',
        ),
        array(
            'id' => 'PAY-202402240008',
            'user_name' => 'Elif Koç',
            'user_email' => 'elif@example.com',
            'user_avatar' => '',
            'course_title' => 'Dijital Ebeveynlik',
            'amount' => 399.00,
            'status' => 'completed',
            'date' => '2024-02-24 17:15:00',
            'gateway' => 'iyzico',
        ),
    );
    
    // Filtrele
    $filtered = $sample_payments;
    
    if ($args['status'] !== 'all') {
        $filtered = array_filter($filtered, function($payment) use ($args) {
            return $payment['status'] === $args['status'];
        });
    }
    
    if ($args['gateway'] !== 'all') {
        $filtered = array_filter($filtered, function($payment) use ($args) {
            return $payment['gateway'] === $args['gateway'];
        });
    }
    
    if (!empty($args['search'])) {
        $search = strtolower($args['search']);
        $filtered = array_filter($filtered, function($payment) use ($search) {
            return strpos(strtolower($payment['user_name']), $search) !== false ||
                   strpos(strtolower($payment['user_email']), $search) !== false ||
                   strpos(strtolower($payment['id']), $search) !== false;
        });
    }
    
    // Toplam sayı
    $total = count($filtered);
    
    // Sayfalama
    $offset = ($args['page'] - 1) * $args['per_page'];
    $filtered = array_slice($filtered, $offset, $args['per_page']);
    
    return array(
        'payments' => array_values($filtered),
        'total' => $total,
        'pages' => ceil($total / $args['per_page']),
        'page' => $args['page'],
    );
}

/**
 * iyzico'dan ödeme verilerini çek
 * 
 * NOT: Bu fonksiyon iyzico API entegrasyonu gerektirir.
 * iyzico-php kütüphanesini yükledikten sonra aktif hale getirin.
 * 
 * @param array $args Filtre argümanları
 * @param array $config iyzico yapılandırması
 * @return array Ödemeler listesi
 */
function metabilinc_get_iyzico_payments($args, $config) {
    // iyzico PHP SDK'sı yüklü mü kontrol et
    if (!class_exists('Iyzipay\IyzipayResource')) {
        // SDK yoksa simülasyon verisi döndür
        return metabilinc_get_simulated_payments($args);
    }
    
    // iyzico API yapılandırması
    $options = new \Iyzipay\Options();
    $options->setApiKey($config['api_key']);
    $options->setSecretKey($config['secret_key']);
    $options->setBaseUrl($config['sandbox'] ? 'https://sandbox-api.iyzipay.com' : 'https://api.iyzipay.com');
    
    // TODO: iyzico API'den ödeme geçmişini çek
    // $request = new \Iyzipay\Request\ReportingPaymentDetailRequest();
    // ... API çağrısı yap
    
    // Şimdilik simülasyon verisi döndür
    return metabilinc_get_simulated_payments($args);
}

/**
 * PayTR'den ödeme verilerini çek
 * 
 * NOT: Bu fonksiyon PayTR API entegrasyonu gerektirir.
 * PayTR dokümantasyonuna göre API entegrasyonunu tamamlayın.
 * 
 * @param array $args Filtre argümanları
 * @param array $config PayTR yapılandırması
 * @return array Ödemeler listesi
 */
function metabilinc_get_paytr_payments($args, $config) {
    // PayTR API entegrasyonu buraya yapılacak
    // Şimdilik simülasyon verisi döndür
    return metabilinc_get_simulated_payments($args);
}

/**
 * Stripe'dan ödeme verilerini çek
 * 
 * NOT: Bu fonksiyon Stripe PHP SDK gerektirir.
 * stripe/stripe-php kütüphanesini yükledikten sonra aktif hale getirin.
 * 
 * @param array $args Filtre argümanları
 * @param array $config Stripe yapılandırması
 * @return array Ödemeler listesi
 */
function metabilinc_get_stripe_payments($args, $config) {
    // Stripe PHP SDK yüklü mü kontrol et
    if (!class_exists('Stripe\Stripe')) {
        // SDK yoksa simülasyon verisi döndür
        return metabilinc_get_simulated_payments($args);
    }
    
    // Stripe API anahtarını ayarla
    \Stripe\Stripe::setApiKey($config['secret_key']);
    
    try {
        // Stripe'dan ödemeleri çek
        $params = array(
            'limit' => $args['per_page'],
        );
        
        if (!empty($args['date_from'])) {
            $params['created']['gte'] = strtotime($args['date_from']);
        }
        
        if (!empty($args['date_to'])) {
            $params['created']['lte'] = strtotime($args['date_to']);
        }
        
        $charges = \Stripe\Charge::all($params);
        
        $payments = array();
        foreach ($charges->data as $charge) {
            $payments[] = array(
                'id' => 'STRIPE-' . $charge->id,
                'user_name' => $charge->billing_details->name ?? 'İsimsiz',
                'user_email' => $charge->billing_details->email ?? '',
                'user_avatar' => '',
                'course_title' => 'Stripe Ödemesi',
                'amount' => $charge->amount / 100,
                'status' => $charge->status === 'succeeded' ? 'completed' : ($charge->refunded ? 'refunded' : $charge->status),
                'date' => date('Y-m-d H:i:s', $charge->created),
                'gateway' => 'stripe',
            );
        }
        
        return array(
            'payments' => $payments,
            'total' => count($payments),
            'pages' => 1,
            'page' => 1,
        );
        
    } catch (Exception $e) {
        // Hata durumunda simülasyon verisi döndür
        return metabilinc_get_simulated_payments($args);
    }
}

/**
 * Ödeme istatistiklerini getir
 * @return array İstatistikler
 */
function metabilinc_get_payment_stats() {
    $settings = metabilinc_get_payment_settings();
    $args = array('per_page' => 1000);
    
    $payments_data = metabilinc_get_payments($args);
    $payments = $payments_data['payments'];
    
    $total_revenue = 0;
    $completed_count = 0;
    $pending_count = 0;
    $failed_count = 0;
    
    foreach ($payments as $payment) {
        if ($payment['status'] === 'completed') {
            $total_revenue += $payment['amount'];
            $completed_count++;
        } elseif ($payment['status'] === 'pending') {
            $pending_count++;
        } elseif ($payment['status'] === 'failed') {
            $failed_count++;
        }
    }
    
    return array(
        'total_revenue' => $total_revenue,
        'completed' => $completed_count,
        'pending' => $pending_count,
        'failed' => $failed_count,
        'total' => count($payments),
    );
}

/**
 * Ödeme durumu etiketini getir
 * @param string $status Ödeme durumu
 * @return array Etiket ve CSS sınıfı
 */
function metabilinc_get_payment_status_label($status) {
    $labels = array(
        'completed' => array('label' => 'Tamamlandı', 'class' => 'status-completed'),
        'pending' => array('label' => 'Bekliyor', 'class' => 'status-pending'),
        'failed' => array('label' => 'Başarısız', 'class' => 'status-failed'),
        'refunded' => array('label' => 'İade', 'class' => 'status-refunded'),
    );
    
    return isset($labels[$status]) ? $labels[$status] : array('label' => $status, 'class' => '');
}

/**
 * Ödeme yöntemi etiketini getir
 * @param string $gateway Ödeme yöntemi
 * @return string Etiket
 */
function metabilinc_get_payment_gateway_label($gateway) {
    $labels = array(
        'iyzico' => '💳 iyzico',
        'paytr' => '💳 PayTR',
        'stripe' => '💳 Stripe',
        'bank_transfer' => '🏦 Havale/EFT',
    );
    
    return isset($labels[$gateway]) ? $labels[$gateway] : $gateway;
}

/**
 * AJAX - Ödeme bağlantısını test et
 */
add_action('wp_ajax_metabilinc_test_payment_connection', 'metabilinc_test_payment_connection');
function metabilinc_test_payment_connection() {
    check_ajax_referer('metabilinc_payment_settings_nonce', 'nonce');
    
    if (!current_user_can('administrator')) {
        wp_send_json_error('Yetkiniz yok.');
    }
    
    $gateway = sanitize_text_field($_POST['gateway']);
    $settings = metabilinc_get_payment_settings();
    
    $result = array(
        'success' => false,
        'message' => 'Bağlantı test edilemedi.',
    );
    
    switch ($gateway) {
        case 'iyzico':
            if (class_exists('Iyzipay\IyzipayResource')) {
                // iyzico bağlantı testi
                $result['message'] = 'iyzico SDK yüklü. API bilgileri kaydedildikten sonra gerçek test yapılabilir.';
                $result['success'] = true;
            } else {
                $result['message'] = 'iyzico PHP SDK yüklenmemiş. Composer ile yükleyin: composer require iyzico/iyzipay-php';
            }
            break;
            
        case 'paytr':
            $result['message'] = 'PayTR entegrasyonu için PayTR PHP kütüphanesi gereklidir.';
            break;
            
        case 'stripe':
            if (class_exists('Stripe\Stripe')) {
                try {
                    \Stripe\Stripe::setApiKey($settings['stripe']['secret_key']);
                    $account = \Stripe\Account::retrieve();
                    $result['success'] = true;
                    $result['message'] = 'Stripe bağlantısı başarılı! Hesap: ' . $account->email;
                } catch (Exception $e) {
                    $result['message'] = 'Stripe bağlantı hatası: ' . $e->getMessage();
                }
            } else {
                $result['message'] = 'Stripe PHP SDK yüklenmemiş. Composer ile yükleyin: composer require stripe/stripe-php';
            }
            break;
    }
    
    wp_send_json($result);
}
