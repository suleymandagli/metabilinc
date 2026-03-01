<?php
/**
 * Template Name: Admin - Kurs Yönetimi
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

get_header();

// Kursları getir
$args = array(
    'post_type' => 'course',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
);

$courses = get_posts($args);

// İstatistikler
$total_courses = count($courses);
$published_courses = 0;
$draft_courses = 0;
$total_enrolled = 0;

foreach ($courses as $course) {
    if ($course->post_status === 'publish') {
        $published_courses++;
    } elseif ($course->post_status === 'draft') {
        $draft_courses++;
    }
    $total_enrolled += intval(get_post_meta($course->ID, '_course_enrolled', true));
}
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
            <a href="<?php echo esc_url(home_url('/admin-kurslar')); ?>" class="admin-nav-item active">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                </svg>
                Kurslar
            </a>
            <a href="<?php echo esc_url(home_url('/admin-kurs-ekle')); ?>" class="admin-nav-item">
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
            <h1>Kurs Yönetimi</h1>
            <div class="admin-user">
                <span><?php echo esc_html($user->display_name); ?></span>
                <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="btn btn-outline btn-sm">Çıkış</a>
            </div>
        </header>
        
        <!-- İstatistikler -->
        <div class="admin-stats">
            <div class="admin-stat-card">
                <div class="admin-stat-icon" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                </div>
                <div class="admin-stat-info">
                    <span class="admin-stat-value"><?php echo $total_courses; ?></span>
                    <span class="admin-stat-label">Toplam Kurs</span>
                </div>
            </div>
            
            <div class="admin-stat-card">
                <div class="admin-stat-icon" style="background: rgba(34, 197, 94, 0.1); color: #22c55e;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <div class="admin-stat-info">
                    <span class="admin-stat-value"><?php echo $published_courses; ?></span>
                    <span class="admin-stat-label">Yayında</span>
                </div>
            </div>
            
            <div class="admin-stat-card">
                <div class="admin-stat-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <div class="admin-stat-info">
                    <span class="admin-stat-value"><?php echo $draft_courses; ?></span>
                    <span class="admin-stat-label">Taslak</span>
                </div>
            </div>
            
            <div class="admin-stat-card">
                <div class="admin-stat-icon" style="background: rgba(249, 115, 22, 0.1); color: #f97316;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div class="admin-stat-info">
                    <span class="admin-stat-value"><?php echo number_format($total_enrolled, 0, ',', '.'); ?></span>
                    <span class="admin-stat-label">Toplam Öğrenci</span>
                </div>
            </div>
        </div>
        
        <!-- Kurs Listesi -->
        <div class="admin-content">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2>Tüm Kurslar</h2>
                    <a href="<?php echo esc_url(home_url('/admin-kurs-ekle')); ?>" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.5rem;">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Yeni Kurs Ekle
                    </a>
                </div>
                
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Kurs</th>
                                <th>Fiyat</th>
                                <th>Öğrenci</th>
                                <th>Durum</th>
                                <th>Tarih</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($courses)) : ?>
                                <tr>
                                    <td colspan="6" class="admin-table-empty">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                        </svg>
                                        <p>Henüz kurs eklenmemiş.</p>
                                        <a href="<?php echo esc_url(home_url('/admin-kurs-ekle')); ?>" class="btn btn-primary btn-sm">İlk Kursu Ekle</a>
                                    </td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($courses as $course) : 
                                    $price = get_post_meta($course->ID, '_course_price', true);
                                    $discounted_price = get_post_meta($course->ID, '_course_discounted_price', true);
                                    $enrolled = get_post_meta($course->ID, '_course_enrolled', true);
                                    $is_free = get_post_meta($course->ID, '_course_is_free', true);
                                    $thumbnail = get_the_post_thumbnail_url($course->ID, 'thumbnail');
                                    if (!$thumbnail) {
                                        $thumbnail = get_template_directory_uri() . '/assets/images/course-placeholder.jpg';
                                    }
                                ?>
                                    <tr>
                                        <td>
                                            <div class="admin-course-info">
                                                <img src="<?php echo esc_url($thumbnail); ?>" alt="" class="admin-course-thumb">
                                                <div class="admin-course-details">
                                                    <span class="admin-course-title"><?php echo esc_html($course->post_title); ?></span>
                                                    <span class="admin-course-slug">/kurs/<?php echo esc_html($course->post_name); ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if ($is_free === '1') : ?>
                                                <span class="admin-badge admin-badge-free">Ücretsiz</span>
                                            <?php elseif ($discounted_price) : ?>
                                                <span class="admin-price">
                                                    <span class="admin-price-current">₺<?php echo number_format($discounted_price, 0, ',', '.'); ?></span>
                                                    <span class="admin-price-original">₺<?php echo number_format($price, 0, ',', '.'); ?></span>
                                                </span>
                                            <?php else : ?>
                                                <span class="admin-price-current">₺<?php echo number_format($price, 0, ',', '.'); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="admin-enrolled-count"><?php echo number_format(intval($enrolled), 0, ',', '.'); ?></span>
                                        </td>
                                        <td>
                                            <?php if ($course->post_status === 'publish') : ?>
                                                <span class="admin-badge admin-badge-published">Yayında</span>
                                            <?php elseif ($course->post_status === 'draft') : ?>
                                                <span class="admin-badge admin-badge-draft">Taslak</span>
                                            <?php else : ?>
                                                <span class="admin-badge"><?php echo esc_html($course->post_status); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="admin-date"><?php echo date_i18n('d M Y', strtotime($course->post_date)); ?></span>
                                        </td>
                                        <td>
                                            <div class="admin-actions">
                                                <a href="<?php echo esc_url(home_url('/admin-kurs-ekle?edit=' . $course->ID)); ?>" class="admin-action-btn admin-action-edit" title="Düzenle">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                    </svg>
                                                </a>
                                                <a href="<?php echo esc_url(get_permalink($course->ID)); ?>" class="admin-action-btn admin-action-view" title="Görüntüle" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </a>
                                                <button type="button" class="admin-action-btn admin-action-delete" title="Sil" data-course-id="<?php echo $course->ID; ?>" data-course-title="<?php echo esc_attr($course->post_title); ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Silme Onay Modalı -->
<div id="delete-modal" class="admin-modal">
    <div class="admin-modal-content">
        <div class="admin-modal-header">
            <h3>Kursu Sil</h3>
            <button type="button" class="admin-modal-close">&times;</button>
        </div>
        <div class="admin-modal-body">
            <p><strong id="delete-course-title"></strong> kursunu silmek istediğinize emin misiniz?</p>
            <p class="admin-modal-warning">Bu işlem geri alınamaz!</p>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="btn btn-outline admin-modal-cancel">İptal</button>
            <button type="button" class="btn btn-danger" id="confirm-delete">Evet, Sil</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Silme modalı
    const deleteModal = document.getElementById('delete-modal');
    const deleteButtons = document.querySelectorAll('.admin-action-delete');
    const closeModalBtn = document.querySelector('.admin-modal-close');
    const cancelBtn = document.querySelector('.admin-modal-cancel');
    const confirmDeleteBtn = document.getElementById('confirm-delete');
    const courseTitleEl = document.getElementById('delete-course-title');
    
    let courseIdToDelete = null;
    
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            courseIdToDelete = this.dataset.courseId;
            courseTitleEl.textContent = this.dataset.courseTitle;
            deleteModal.classList.add('active');
        });
    });
    
    function closeModal() {
        deleteModal.classList.remove('active');
        courseIdToDelete = null;
    }
    
    closeModalBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);
    
    deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) closeModal();
    });
    
    // Silme işlemi
    confirmDeleteBtn.addEventListener('click', function() {
        if (!courseIdToDelete) return;
        
        const formData = new FormData();
        formData.append('action', 'metabilinc_delete_course');
        formData.append('course_id', courseIdToDelete);
        formData.append('nonce', '<?php echo wp_create_nonce("metabilinc_admin_nonce"); ?>');
        
        fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert(data.data?.message || 'Bir hata oluştu.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Bir hata oluştu.');
        });
    });
});
</script>

<?php get_footer(); ?>