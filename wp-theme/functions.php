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

// Tema aktivasyonunda varsayılan menü oluş
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
}
add_action('after_switch_theme', 'metabilinc_after_switch_theme');
