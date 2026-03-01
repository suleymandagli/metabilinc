<?php
/**
 * Template Name: Admin - Kurs Ekle/Düzenle
 * 
 * @package Metabilinc
 */

// Giriş kontrolü ve yetkilendirme
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url(get_permalink()));
    exit;
}

$user = wp_get_current_user();
if (!in_array('administrator', $user->roles) && !in_array('editor', $user->roles)) {
    wp_redirect(home_url());
    exit;
}

// Düzenleme modu kontrolü
$edit_mode = false;
$course_id = 0;
$course = null;

if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $course_id = intval($_GET['edit']);
    $course = get_post($course_id);
    if ($course && $course->post_type === 'course') {
        $edit_mode = true;
    }
}

// Form gönderimi işleme
$form_message = '';
$form_success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_course'])) {
    // Nonce kontrolü
    if (!isset($_POST['metabilinc_course_nonce']) || !wp_verify_nonce($_POST['metabilinc_course_nonce'], 'metabilinc_save_course')) {
        $form_message = 'Güvenlik doğrulaması başarısız.';
    } else {
        // Temel kurs verileri
        $course_data = array(
            'post_title'   => sanitize_text_field($_POST['course_title']),
            'post_content' => wp_kses_post($_POST['course_content']),
            'post_excerpt' => sanitize_text_field($_POST['course_excerpt']),
            'post_status'  => sanitize_text_field($_POST['course_status']),
            'post_type'    => 'course',
            'post_name'    => sanitize_title($_POST['course_slug']),
        );
        
        if ($edit_mode) {
            $course_data['ID'] = $course_id;
            $new_course_id = wp_update_post($course_data, true);
        } else {
            $new_course_id = wp_insert_post($course_data, true);
        }
        
        if (is_wp_error($new_course_id)) {
            $form_message = $new_course_id->get_error_message();
        } else {
            $course_id = $new_course_id;
            $edit_mode = true;
            $course = get_post($course_id);
            $form_success = true;
            $form_message = $edit_mode ? 'Kurs başarıyla güncellendi.' : 'Kurs başarıyla oluşturuldu.';
            
            // Meta alanları kaydet
            update_post_meta($course_id, '_course_price', sanitize_text_field($_POST['course_price']));
            update_post_meta($course_id, '_course_discounted_price', sanitize_text_field($_POST['course_discounted_price']));
            update_post_meta($course_id, '_course_duration', sanitize_text_field($_POST['course_duration']));
            update_post_meta($course_id, '_course_start_date', sanitize_text_field($_POST['course_start_date']));
            update_post_meta($course_id, '_course_level', sanitize_text_field($_POST['course_level']));
            update_post_meta($course_id, '_course_enrolled', intval($_POST['course_enrolled']));
            update_post_meta($course_id, '_course_instructor', sanitize_text_field($_POST['course_instructor']));
            update_post_meta($course_id, '_course_is_free', isset($_POST['course_is_free']) ? '1' : '0');
            update_post_meta($course_id, '_course_is_featured', isset($_POST['course_is_featured']) ? '1' : '0');
            update_post_meta($course_id, '_course_category', sanitize_text_field($_POST['course_category']));
            
            // JSON alanları
            $syllabus = array();
            if (isset($_POST['syllabus_title']) && is_array($_POST['syllabus_title'])) {
                foreach ($_POST['syllabus_title'] as $index => $title) {
                    if (!empty($title)) {
                        $syllabus[] = array(
                            'title' => sanitize_text_field($title),
                            'description' => sanitize_textarea_field($_POST['syllabus_desc'][$index] ?? ''),
                        );
                    }
                }
            }
            update_post_meta($course_id, '_course_syllabus', json_encode($syllabus, JSON_UNESCAPED_UNICODE));
            
            $outcomes = array_filter(array_map('sanitize_text_field', explode("\n", $_POST['course_outcomes'])));
            update_post_meta($course_id, '_course_outcomes', json_encode($outcomes, JSON_UNESCAPED_UNICODE));
            
            $requirements = array_filter(array_map('sanitize_text_field', explode("\n", $_POST['course_requirements'])));
            update_post_meta($course_id, '_course_requirements', json_encode($requirements, JSON_UNESCAPED_UNICODE));
            
            // Kapak resmi
            if (!empty($_POST['course_thumbnail_id'])) {
                set_post_thumbnail($course_id, intval($_POST['course_thumbnail_id']));
            }
        }
    }
}

// Varsayılan değerler
$defaults = array(
    'title' => '',
    'content' => '',
    'excerpt' => '',
    'slug' => '',
    'status' => 'draft',
    'price' => '',
    'discounted_price' => '',
    'duration' => '',
    'level' => 'baslangic',
    'enrolled' => 0,
    'instructor' => '',
    'is_free' => false,
    'is_featured' => false,
    'category' => 'aile',
    'syllabus' => array(),
    'outcomes' => '',
    'requirements' => '',
);

// Düzenleme modunda mevcut değerleri al
if ($edit_mode && $course) {
    $defaults['title'] = $course->post_title;
    $defaults['content'] = $course->post_content;
    $defaults['excerpt'] = $course->post_excerpt;
    $defaults['slug'] = $course->post_name;
    $defaults['status'] = $course->post_status;
    $defaults['price'] = get_post_meta($course_id, '_course_price', true);
    $defaults['discounted_price'] = get_post_meta($course_id, '_course_discounted_price', true);
    $defaults['duration'] = get_post_meta($course_id, '_course_duration', true);
    $defaults['level'] = get_post_meta($course_id, '_course_level', true);
    $defaults['enrolled'] = get_post_meta($course_id, '_course_enrolled', true);
    $defaults['instructor'] = get_post_meta($course_id, '_course_instructor', true);
    $defaults['is_free'] = get_post_meta($course_id, '_course_is_free', true) === '1';
    $defaults['is_featured'] = get_post_meta($course_id, '_course_is_featured', true) === '1';
    $defaults['category'] = get_post_meta($course_id, '_course_category', true) ?: 'aile';
    
    $syllabus_json = get_post_meta($course_id, '_course_syllabus', true);
    if ($syllabus_json) {
        $defaults['syllabus'] = json_decode($syllabus_json, true) ?: array();
    }
    
    $outcomes_json = get_post_meta($course_id, '_course_outcomes', true);
    if ($outcomes_json) {
        $outcomes = json_decode($outcomes_json, true);
        $defaults['outcomes'] = is_array($outcomes) ? implode("\n", $outcomes) : '';
    }
    
    $requirements_json = get_post_meta($course_id, '_course_requirements', true);
    if ($requirements_json) {
        $requirements = json_decode($requirements_json, true);
        $defaults['requirements'] = is_array($requirements) ? implode("\n", $requirements) : '';
    }
}

get_header();
?>

<div class="admin-dashboard">
    <div class="admin-sidebar">
        <div class="admin-logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
            <span>Metabilinc Admin</span>
        </div>
        
        <nav class="admin-nav">
            <a href="<?php echo esc_url(home_url('/admin-kurslar')); ?>" class="admin-nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                </svg>
                Kurslar
            </a>
            <a href="<?php echo esc_url(home_url('/admin-kurs-ekle')); ?>" class="admin-nav-item active">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
                Yeni Kurs Ekle
            </a>
            <a href="<?php echo admin_url('edit.php?post_type=course'); ?>" class="admin-nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                WP Admin Panel
            </a>
            <a href="<?php echo esc_url(home_url()); ?>" class="admin-nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                Siteye Dön
            </a>
        </nav>
    </div>
    
    <div class="admin-main">
        <header class="admin-header">
            <div class="admin-header-left">
                <a href="<?php echo esc_url(home_url('/admin-kurslar')); ?>" class="admin-back-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Kurslara Dön
                </a>
                <h1><?php echo $edit_mode ? 'Kurs Düzenle' : 'Yeni Kurs Ekle'; ?></h1>
            </div>
            <?php if ($edit_mode) : ?>
                <a href="<?php echo esc_url(get_permalink($course_id)); ?>" class="btn btn-outline" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.5rem;">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    Kursu Görüntüle
                </a>
            <?php endif; ?>
        </header>
        
        <?php if ($form_message) : ?>
            <div class="admin-alert <?php echo $form_success ? 'admin-alert-success' : 'admin-alert-error'; ?>">
                <?php echo esc_html($form_message); ?>
            </div>
        <?php endif; ?>
        
        <form method="post" class="admin-form" id="course-form">
            <?php wp_nonce_field('metabilinc_save_course', 'metabilinc_course_nonce'); ?>
            
            <div class="admin-form-grid">
                <!-- Sol Kolon - Temel Bilgiler -->
                <div class="admin-form-main">
                    <div class="admin-card">
                        <div class="admin-card-header">
                            <h2>Kurs Bilgileri</h2>
                        </div>
                        
                        <div class="admin-form-group">
                            <label for="course_title">Kurs Başlığı *</label>
                            <input type="text" id="course_title" name="course_title" value="<?php echo esc_attr($defaults['title']); ?>" required class="admin-form-input">
                        </div>
                        
                        <div class="admin-form-row">
                            <div class="admin-form-group">
                                <label for="course_slug">URL Slug</label>
                                <input type="text" id="course_slug" name="course_slug" value="<?php echo esc_attr($defaults['slug']); ?>" class="admin-form-input" placeholder="ornek-kurs-adi">
                                <span class="admin-form-help">Boş bırakırsanız başlıktan otomatik oluşturulur.</span>
                            </div>
                            
                            <div class="admin-form-group">
                                <label for="course_status">Durum</label>
                                <select id="course_status" name="course_status" class="admin-form-select">
                                    <option value="draft" <?php selected($defaults['status'], 'draft'); ?>>Taslak</option>
                                    <option value="publish" <?php selected($defaults['status'], 'publish'); ?>>Yayında</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="admin-form-group">
                            <label for="course_excerpt">Kısa Açıklama</label>
                            <textarea id="course_excerpt" name="course_excerpt" rows="3" class="admin-form-textarea" placeholder="Kursun kısa özeti..."><?php echo esc_textarea($defaults['excerpt']); ?></textarea>
                            <span class="admin-form-help">Kurs listelerinde gösterilecek kısa açıklama.</span>
                        </div>
                        
                        <div class="admin-form-group">
                            <label for="course_content">Kurs İçeriği</label>
                            <?php 
                            wp_editor($defaults['content'], 'course_content', array(
                                'textarea_name' => 'course_content',
                                'textarea_rows' => 15,
                                'teeny' => true,
                                'quicktags' => true,
                                'media_buttons' => true,
                            ));
                            ?>
                        </div>
                    </div>
                    
                    <!-- Müfredat -->
                    <div class="admin-card">
                        <div class="admin-card-header">
                            <h2>Müfredat</h2>
                            <button type="button" class="btn btn-outline btn-sm" id="add-syllabus-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.25rem;">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                Bölüm Ekle
                            </button>
                        </div>
                        
                        <div id="syllabus-container">
                            <?php if (!empty($defaults['syllabus'])) : ?>
                                <?php foreach ($defaults['syllabus'] as $index => $item) : ?>
                                    <div class="admin-syllabus-item">
                                        <div class="admin-syllabus-header">
                                            <span class="admin-syllabus-number"><?php echo $index + 1; ?></span>
                                            <button type="button" class="admin-syllabus-remove" title="Sil">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="admin-form-group">
                                            <input type="text" name="syllabus_title[]" value="<?php echo esc_attr($item['title']); ?>" placeholder="Bölüm başlığı" class="admin-form-input">
                                        </div>
                                        <div class="admin-form-group">
                                            <textarea name="syllabus_desc[]" rows="2" placeholder="Bölüm açıklaması (isteğe bağlı)" class="admin-form-textarea"><?php echo esc_textarea($item['description']); ?></textarea>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Sağ Kolon - Ayarlar -->
                <div class="admin-form-sidebar">
                    <!-- Kaydet -->
                    <div class="admin-card">
                        <div class="admin-card-header">
                            <h2>Yayınla</h2>
                        </div>
                        <div class="admin-form-actions">
                            <button type="submit" name="save_course" class="btn btn-primary btn-block">
                                <?php echo $edit_mode ? 'Değişiklikleri Kaydet' : 'Kursu Oluştur'; ?>
                            </button>
                            <?php if ($edit_mode) : ?>
                                <a href="<?php echo esc_url(home_url('/admin-kurs-ekle')); ?>" class="btn btn-outline btn-block">Yeni Kurs Ekle</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Kapak Resmi -->
                    <div class="admin-card">
                        <div class="admin-card-header">
                            <h2>Kapak Resmi</h2>
                        </div>
                        <div class="admin-form-group">
                            <div class="admin-media-upload">
                                <?php 
                                $thumbnail_id = $edit_mode ? get_post_thumbnail_id($course_id) : 0;
                                $thumbnail_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'medium') : '';
                                ?>
                                <div class="admin-media-preview" id="thumbnail-preview" style="<?php echo $thumbnail_url ? 'background-image: url(' . esc_url($thumbnail_url) . ')' : ''; ?>">
                                    <?php if (!$thumbnail_url) : ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                        </svg>
                                        <span>Resim seçin</span>
                                    <?php endif; ?>
                                </div>
                                <input type="hidden" id="course_thumbnail_id" name="course_thumbnail_id" value="<?php echo $thumbnail_id; ?>">
                                <button type="button" class="btn btn-outline btn-sm" id="upload-thumbnail-btn">Resim Seç</button>
                                <button type="button" class="btn btn-text btn-sm" id="remove-thumbnail-btn" style="<?php echo $thumbnail_url ? '' : 'display: none;'; ?>">Kaldır</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Fiyatlandırma -->
                    <div class="admin-card">
                        <div class="admin-card-header">
                            <h2>Fiyatlandırma</h2>
                        </div>
                        
                        <div class="admin-form-group">
                            <label class="admin-checkbox">
                                <input type="checkbox" name="course_is_free" id="course_is_free" <?php checked($defaults['is_free']); ?>>
                                <span>Ücretsiz Kurs</span>
                            </label>
                        </div>
                        
                        <div id="price-fields" style="<?php echo $defaults['is_free'] ? 'display: none;' : ''; ?>">
                            <div class="admin-form-group">
                                <label for="course_price">Normal Fiyat (₺)</label>
                                <input type="number" id="course_price" name="course_price" value="<?php echo esc_attr($defaults['price']); ?>" class="admin-form-input" min="0" step="0.01">
                            </div>
                            
                            <div class="admin-form-group">
                                <label for="course_discounted_price">İndirimli Fiyat (₺)</label>
                                <input type="number" id="course_discounted_price" name="course_discounted_price" value="<?php echo esc_attr($defaults['discounted_price']); ?>" class="admin-form-input" min="0" step="0.01">
                                <span class="admin-form-help">İndirim yoksa boş bırakın.</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Kurs Detayları -->
                    <div class="admin-card">
                        <div class="admin-card-header">
                            <h2>Kurs Detayları</h2>
                        </div>
                        
                        <div class="admin-form-group">
                            <label for="course_instructor">Eğitmen</label>
                            <input type="text" id="course_instructor" name="course_instructor" value="<?php echo esc_attr($defaults['instructor']); ?>" class="admin-form-input" placeholder="Eğitmen adı">
                        </div>
                        
                        <div class="admin-form-group">
                            <label for="course_duration">Süre</label>
                            <input type="text" id="course_duration" name="course_duration" value="<?php echo esc_attr($defaults['duration']); ?>" class="admin-form-input" placeholder="örn: 8 Hafta, 20 Saat">
                        </div>
                        
                        <div class="admin-form-group">
                            <label for="course_start_date">Başlangıç Tarihi</label>
                            <input type="text" id="course_start_date" name="course_start_date" value="<?php echo esc_attr(get_post_meta($course_id, '_course_start_date', true)); ?>" class="admin-form-input" placeholder="örn: 15 Ocak 2025">
                            <span class="admin-form-help">Kursun başlangıç tarihi (isteğe bağlı)</span>
                        </div>
                        
                        <div class="admin-form-group">
                            <label for="course_level">Seviye</label>
                            <select id="course_level" name="course_level" class="admin-form-select">
                                <option value="baslangic" <?php selected($defaults['level'], 'baslangic'); ?>>Başlangıç</option>
                                <option value="orta" <?php selected($defaults['level'], 'orta'); ?>>Orta</option>
                                <option value="ileri" <?php selected($defaults['level'], 'ileri'); ?>>İleri</option>
                            </select>
                        </div>
                        
                        <div class="admin-form-group">
                            <label for="course_category">Kategori</label>
                            <select id="course_category" name="course_category" class="admin-form-select">
                                <option value="aile" <?php selected($defaults['category'], 'aile'); ?>>Aile Eğitimi</option>
                                <option value="evlilik" <?php selected($defaults['category'], 'evlilik'); ?>>Evlilik</option>
                                <option value="cocuk" <?php selected($defaults['category'], 'cocuk'); ?>>Çocuk Gelişimi</option>
                                <option value="iletisim" <?php selected($defaults['category'], 'iletisim'); ?>>İletişim</option>
                                <option value="diger" <?php selected($defaults['category'], 'diger'); ?>>Diğer</option>
                            </select>
                        </div>
                        
                        <div class="admin-form-group">
                            <label for="course_enrolled">Kayıtlı Öğrenci Sayısı</label>
                            <input type="number" id="course_enrolled" name="course_enrolled" value="<?php echo esc_attr($defaults['enrolled']); ?>" class="admin-form-input" min="0">
                        </div>
                        
                        <div class="admin-form-group">
                            <label class="admin-checkbox">
                                <input type="checkbox" name="course_is_featured" <?php checked($defaults['is_featured']); ?>>
                                <span>Öne Çıkan Kurs</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Öğrenim Çıktıları -->
                    <div class="admin-card">
                        <div class="admin-card-header">
                            <h2>Öğrenim Çıktıları</h2>
                        </div>
                        <div class="admin-form-group">
                            <textarea id="course_outcomes" name="course_outcomes" rows="5" class="admin-form-textarea" placeholder="Her satıra bir öğrenim çıktısı yazın..."><?php echo esc_textarea($defaults['outcomes']); ?></textarea>
                            <span class="admin-form-help">Her satıra bir madde yazın.</span>
                        </div>
                    </div>
                    
                    <!-- Gereksinimler -->
                    <div class="admin-card">
                        <div class="admin-card-header">
                            <h2>Gereksinimler</h2>
                        </div>
                        <div class="admin-form-group">
                            <textarea id="course_requirements" name="course_requirements" rows="5" class="admin-form-textarea" placeholder="Her satıra bir gereksinim yazın..."><?php echo esc_textarea($defaults['requirements']); ?></textarea>
                            <span class="admin-form-help">Her satıra bir madde yazın.</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Müfredat Item Şablonu -->
<template id="syllabus-template">
    <div class="admin-syllabus-item">
        <div class="admin-syllabus-header">
            <span class="admin-syllabus-number">1</span>
            <button type="button" class="admin-syllabus-remove" title="Sil">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                </svg>
            </button>
        </div>
        <div class="admin-form-group">
            <input type="text" name="syllabus_title[]" placeholder="Bölüm başlığı" class="admin-form-input">
        </div>
        <div class="admin-form-group">
            <textarea name="syllabus_desc[]" rows="2" placeholder="Bölüm açıklaması (isteğe bağlı)" class="admin-form-textarea"></textarea>
        </div>
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ücretsiz kurs checkbox
    const isFreeCheckbox = document.getElementById('course_is_free');
    const priceFields = document.getElementById('price-fields');
    
    isFreeCheckbox.addEventListener('change', function() {
        priceFields.style.display = this.checked ? 'none' : 'block';
    });
    
    // Müfredat yönetimi
    const syllabusContainer = document.getElementById('syllabus-container');
    const addSyllabusBtn = document.getElementById('add-syllabus-item');
    const syllabusTemplate = document.getElementById('syllabus-template');
    
    function updateSyllabusNumbers() {
        const items = syllabusContainer.querySelectorAll('.admin-syllabus-item');
        items.forEach((item, index) => {
            item.querySelector('.admin-syllabus-number').textContent = index + 1;
        });
    }
    
    addSyllabusBtn.addEventListener('click', function() {
        const clone = syllabusTemplate.content.cloneNode(true);
        const removeBtn = clone.querySelector('.admin-syllabus-remove');
        
        removeBtn.addEventListener('click', function() {
            this.closest('.admin-syllabus-item').remove();
            updateSyllabusNumbers();
        });
        
        syllabusContainer.appendChild(clone);
        updateSyllabusNumbers();
    });
    
    // Mevcut sil butonlarına event ekle
    syllabusContainer.querySelectorAll('.admin-syllabus-remove').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.admin-syllabus-item').remove();
            updateSyllabusNumbers();
        });
    });
    
    // Medya yükleyici
    const uploadBtn = document.getElementById('upload-thumbnail-btn');
    const removeBtn = document.getElementById('remove-thumbnail-btn');
    const preview = document.getElementById('thumbnail-preview');
    const input = document.getElementById('course_thumbnail_id');
    
    uploadBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        const mediaUploader = wp.media({
            title: 'Kapak Resmi Seç',
            button: { text: 'Seç' },
            multiple: false
        });
        
        mediaUploader.on('select', function() {
            const attachment = mediaUploader.state().get('selection').first().toJSON();
            input.value = attachment.id;
            preview.style.backgroundImage = 'url(' + attachment.url + ')';
            preview.innerHTML = '';
            removeBtn.style.display = 'inline-block';
        });
        
        mediaUploader.open();
    });
    
    removeBtn.addEventListener('click', function() {
        input.value = '';
        preview.style.backgroundImage = '';
        preview.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg><span>Resim seçin</span>';
        this.style.display = 'none';
    });
    
    // Slug otomatik oluştur
    const titleInput = document.getElementById('course_title');
    const slugInput = document.getElementById('course_slug');
    
    titleInput.addEventListener('blur', function() {
        if (!slugInput.value && this.value) {
            // Basit slug oluşturma
            const slug = this.value.toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .substring(0, 50);
            slugInput.value = slug;
        }
    });
});
</script>

<?php get_footer(); ?>