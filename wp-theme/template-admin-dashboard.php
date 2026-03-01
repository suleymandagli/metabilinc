<?php
/**
 * Template Name: Admin Dashboard - Merkezi Yönetim
 * Description: Merkezi yönetim dashboard'u - Kurslar, üyeler, ödemeler, yazılar
 */

// Yetki kontrolü
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url(get_permalink()));
    exit;
}

$current_user = wp_get_current_user();
if (!in_array('administrator', $current_user->roles) && !in_array('editor', $current_user->roles)) {
    wp_redirect(home_url('/'));
    exit;
}

get_header();

// İstatistikleri hesapla
$total_courses = wp_count_posts('course')->publish + wp_count_posts('course')->draft;
$published_courses = wp_count_posts('course')->publish;
$draft_courses = wp_count_posts('course')->draft;

// Toplam öğrenci (meta'dan topla)
$all_courses = get_posts(array(
    'post_type' => 'course',
    'posts_per_page' => -1,
    'post_status' => 'any'
));
$total_students = 0;
foreach ($all_courses as $course) {
    $students = get_post_meta($course->ID, '_course_students', true);
    $total_students += intval($students);
}

// Toplam gelir (varsayılan post meta'dan)
$total_revenue = 0;
foreach ($all_courses as $course) {
    $price = get_post_meta($course->ID, '_course_price', true);
    $students = get_post_meta($course->ID, '_course_students', true);
    if ($price && $students) {
        $total_revenue += floatval($price) * intval($students);
    }
}

// Son 7 gün geliri (simülasyon - gerçek veriler için orders tablosu kullanılabilir)
$weekly_revenue = $total_revenue * 0.15; // Tahmini %15'i son 7 gün

// Toplam kullanıcı
$total_users = count_users();
$total_members = $total_users['total_users'];
$new_users_this_month = count(get_users(array(
    'date_query' => array(
        array(
            'after' => '1 month ago',
        ),
    ),
)));

// Toplam yazı
$total_posts = wp_count_posts('post')->publish;
$posts_this_month = count(get_posts(array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'date_query' => array(
        array(
            'after' => '1 month ago',
        ),
    ),
)));

// Son aktiviteler (son kurslar)
$recent_courses = get_posts(array(
    'post_type' => 'course',
    'posts_per_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
));

// Son kayıtlı kullanıcılar
$recent_users = get_users(array(
    'number' => 5,
    'orderby' => 'registered',
    'order' => 'DESC',
));

// Aktif sayfa
$active_page = 'dashboard';
?>

<div class="admin-wrapper">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-logo">
            <span class="logo-icon">🏫</span>
            <span class="logo-text">Metabilinç<br><small>Admin Panel</small></span>
        </div>
        
        <nav class="admin-nav">
            <a href="<?php echo home_url('/admin-dashboard'); ?>" class="admin-nav-item active">
                <span class="nav-icon">📊</span>
                <span class="nav-text">Dashboard</span>
            </a>
            
            <div class="nav-section">Eğitim</div>
            <a href="<?php echo home_url('/admin-kurslar'); ?>" class="admin-nav-item">
                <span class="nav-icon">📚</span>
                <span class="nav-text">Kurslar</span>
                <span class="nav-badge"><?php echo $published_courses; ?></span>
            </a>
            <a href="<?php echo home_url('/admin-kurs-ekle'); ?>" class="admin-nav-item">
                <span class="nav-icon">➕</span>
                <span class="nav-text">Kurs Ekle</span>
            </a>
            
            <div class="nav-section">Kullanıcılar</div>
            <a href="<?php echo admin_url('users.php'); ?>" class="admin-nav-item">
                <span class="nav-icon">👥</span>
                <span class="nav-text">Tüm Üyeler</span>
                <span class="nav-badge"><?php echo $total_members; ?></span>
            </a>
            <a href="<?php echo admin_url('user-new.php'); ?>" class="admin-nav-item">
                <span class="nav-icon">➕</span>
                <span class="nav-text">Üye Ekle</span>
            </a>
            
            <div class="nav-section">Finans</div>
            <a href="<?php echo home_url('/admin-odemeler'); ?>" class="admin-nav-item">
                <span class="nav-icon">💰</span>
                <span class="nav-text">Ödemeler</span>
            </a>
            <a href="<?php echo home_url('/admin-raporlar'); ?>" class="admin-nav-item">
                <span class="nav-icon">📈</span>
                <span class="nav-text">Raporlar</span>
            </a>
            
            <div class="nav-section">İçerik</div>
            <a href="<?php echo admin_url('edit.php'); ?>" class="admin-nav-item">
                <span class="nav-icon">📝</span>
                <span class="nav-text">Yazılar</span>
                <span class="nav-badge"><?php echo $total_posts; ?></span>
            </a>
            <a href="<?php echo admin_url('post-new.php'); ?>" class="admin-nav-item">
                <span class="nav-icon">➕</span>
                <span class="nav-text">Yazı Ekle</span>
            </a>
            <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="admin-nav-item">
                <span class="nav-icon">📄</span>
                <span class="nav-text">Sayfalar</span>
            </a>
            
            <div class="nav-section">Pazarlama</div>
            <a href="<?php echo home_url('/admin-leadler'); ?>" class="admin-nav-item">
                <span class="nav-icon">🎯</span>
                <span class="nav-text">Leadler</span>
            </a>
            <a href="<?php echo home_url('/admin-funneller'); ?>" class="admin-nav-item">
                <span class="nav-icon">🔄</span>
                <span class="nav-text">Funneller</span>
            </a>
            
            <div class="nav-section">Ayarlar</div>
            <a href="<?php echo admin_url('options-general.php'); ?>" class="admin-nav-item">
                <span class="nav-icon">⚙️</span>
                <span class="nav-text">Genel Ayarlar</span>
            </a>
            <a href="<?php echo admin_url('customize.php'); ?>" class="admin-nav-item">
                <span class="nav-icon">🎨</span>
                <span class="nav-text">Tema Özelleştir</span>
            </a>
        </nav>
        
        <div class="admin-user">
            <div class="user-avatar"><?php echo strtoupper(substr($current_user->display_name, 0, 1)); ?></div>
            <div class="user-info">
                <span class="user-name"><?php echo esc_html($current_user->display_name); ?></span>
                <span class="user-role"><?php echo translate_user_role($current_user->roles[0]); ?></span>
            </div>
            <a href="<?php echo wp_logout_url(home_url()); ?>" class="user-logout" title="Çıkış Yap">🚪</a>
        </div>
    </aside>
    
    <!-- Main Content -->
    <main class="admin-main">
        <!-- Header -->
        <header class="admin-header">
            <div class="header-left">
                <h1 class="page-title">Dashboard</h1>
                <p class="page-subtitle">Hoş geldiniz, <?php echo esc_html($current_user->display_name); ?>! İşte platformunuzun genel durumu.</p>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="<?php echo home_url('/admin-kurs-ekle'); ?>" class="btn btn-primary">
                        <span>➕</span> Yeni Kurs
                    </a>
                    <a href="<?php echo admin_url('post-new.php'); ?>" class="btn btn-secondary">
                        <span>✏️</span> Yeni Yazı
                    </a>
                </div>
            </div>
        </header>
        
        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card revenue">
                <div class="stat-icon">💰</div>
                <div class="stat-content">
                    <span class="stat-label">Toplam Gelir</span>
                    <span class="stat-value"><?php echo number_format($total_revenue, 0, ',', '.'); ?> ₺</span>
                    <span class="stat-change positive">+<?php echo number_format($weekly_revenue, 0, ',', '.'); ?> ₺ bu hafta</span>
                </div>
            </div>
            
            <div class="stat-card students">
                <div class="stat-icon">🎓</div>
                <div class="stat-content">
                    <span class="stat-label">Toplam Öğrenci</span>
                    <span class="stat-value"><?php echo number_format($total_students, 0, ',', '.'); ?></span>
                    <span class="stat-change positive">Aktif öğrenciler</span>
                </div>
            </div>
            
            <div class="stat-card courses">
                <div class="stat-icon">📚</div>
                <div class="stat-content">
                    <span class="stat-label">Kurslar</span>
                    <span class="stat-value"><?php echo $published_courses; ?> <small>/ <?php echo $total_courses; ?></small></span>
                    <span class="stat-change <?php echo $draft_courses > 0 ? 'warning' : 'positive';">
                        <?php echo $draft_courses; ?> taslak bekliyor
                    </span>
                </div>
            </div>
            
            <div class="stat-card users">
                <div class="stat-icon">👥</div>
                <div class="stat-content">
                    <span class="stat-label">Toplam Üye</span>
                    <span class="stat-value"><?php echo $total_members; ?></span>
                    <span class="stat-change positive">+<?php echo $new_users_this_month; ?> bu ay</span>
                </div>
            </div>
            
            <div class="stat-card posts">
                <div class="stat-icon">📝</div>
                <div class="stat-content">
                    <span class="stat-label">Yazılar</span>
                    <span class="stat-value"><?php echo $total_posts; ?></span>
                    <span class="stat-change positive"><?php echo $posts_this_month; ?> yeni bu ay</span>
                </div>
            </div>
            
            <div class="stat-card conversion">
                <div class="stat-icon">🎯</div>
                <div class="stat-content">
                    <span class="stat-label">Dönüşüm Oranı</span>
                    <span class="stat-value">%<?php echo $total_members > 0 ? round(($total_students / $total_members) * 100, 1) : 0; ?></span>
                    <span class="stat-change positive">Üye → Öğrenci</span>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="quick-actions">
            <h2 class="section-title">Hızlı İşlemler</h2>
            <div class="actions-grid">
                <a href="<?php echo home_url('/admin-kurs-ekle'); ?>" class="action-card">
                    <span class="action-icon">📚</span>
                    <span class="action-title">Kurs Ekle</span>
                    <span class="action-desc">Yeni bir kurs oluştur</span>
                </a>
                <a href="<?php echo admin_url('post-new.php'); ?>" class="action-card">
                    <span class="action-icon">📝</span>
                    <span class="action-title">Blog Yazısı</span>
                    <span class="action-desc">Yeni yazı yayınla</span>
                </a>
                <a href="<?php echo admin_url('user-new.php'); ?>" class="action-card">
                    <span class="action-icon">👤</span>
                    <span class="action-title">Üye Ekle</span>
                    <span class="action-desc">Yeni kullanıcı oluştur</span>
                </a>
                <a href="<?php echo home_url('/admin-raporlar'); ?>" class="action-card">
                    <span class="action-icon">📊</span>
                    <span class="action-title">Raporlar</span>
                    <span class="action-desc">Detaylı analizler</span>
                </a>
            </div>
        </div>
        
        <!-- Two Column Layout -->
        <div class="dashboard-grid">
            <!-- Left Column -->
            <div class="dashboard-col">
                <!-- Recent Activity -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">🕐 Son Aktiviteler</h3>
                        <a href="<?php echo home_url('/admin-kurslar'); ?>" class="card-link">Tümünü Gör →</a>
                    </div>
                    <div class="activity-list">
                        <?php foreach ($recent_courses as $course): 
                            $status = get_post_status($course->ID);
                            $price = get_post_meta($course->ID, '_course_price', true);
                            $price_display = empty($price) || $price == '0' ? 'Ücretsiz' : number_format(floatval($price), 0, ',', '.') . ' ₺';
                        ?>
                        <div class="activity-item">
                            <div class="activity-icon <?php echo $status; ?>">
                                <?php echo $status === 'publish' ? '📗' : '📙'; ?>
                            </div>
                            <div class="activity-content">
                                <span class="activity-title"><?php echo esc_html($course->post_title); ?></span>
                                <span class="activity-meta">
                                    <?php echo $status === 'publish' ? 'Yayında' : 'Taslak'; ?> • 
                                    <?php echo $price_display; ?> • 
                                    <?php echo human_time_diff(get_the_time('U', $course), current_time('timestamp')); ?> önce
                                </span>
                            </div>
                            <a href="<?php echo get_edit_post_link($course->ID); ?>" class="activity-action">Düzenle</a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- New Users -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">👋 Yeni Üyeler</h3>
                        <a href="<?php echo admin_url('users.php'); ?>" class="card-link">Tümünü Gör →</a>
                    </div>
                    <div class="user-list">
                        <?php foreach ($recent_users as $user): 
                            $role = $user->roles[0];
                            $role_names = array(
                                'administrator' => 'Yönetici',
                                'editor' => 'Editör',
                                'author' => 'Yazar',
                                'subscriber' => 'Abone'
                            );
                            $role_display = isset($role_names[$role]) ? $role_names[$role] : $role;
                        ?>
                        <div class="user-item">
                            <div class="user-avatar-small"><?php echo strtoupper(substr($user->display_name, 0, 1)); ?></div>
                            <div class="user-content">
                                <span class="user-name"><?php echo esc_html($user->display_name); ?></span>
                                <span class="user-meta"><?php echo $role_display; ?> • <?php echo human_time_diff(strtotime($user->user_registered), current_time('timestamp')); ?> önce</span>
                            </div>
                            <a href="<?php echo admin_url('user-edit.php?user_id=' . $user->ID); ?>" class="user-action">Görüntüle</a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <!-- Right Column -->
            <div class="dashboard-col">
                <!-- Charts Section -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">📈 Gelir Grafiği</h3>
                        <select class="chart-period">
                            <option value="7">Son 7 Gün</option>
                            <option value="30">Son 30 Gün</option>
                            <option value="90">Son 3 Ay</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <!-- Simple CSS Bar Chart -->
                        <div class="bar-chart">
                            <?php 
                            $days = array('Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt', 'Paz');
                            $max_value = max($weekly_revenue / 7 * 1.5, 1000);
                            foreach ($days as $i => $day): 
                                $value = ($weekly_revenue / 7) * (0.5 + rand(0, 100) / 100);
                                $height = min(100, ($value / $max_value) * 100);
                                $is_today = $i === 6;
                            ?>
                            <div class="bar-item">
                                <div class="bar-value" style="height: <?php echo $height; ?>%; background: <?php echo $is_today ? '#f97316' : '#e5e7eb'; ?>"></div>
                                <span class="bar-label"><?php echo $day; ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Popular Courses -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title">🔥 Popüler Kurslar</h3>
                        <a href="<?php echo home_url('/admin-kurslar'); ?>" class="card-link">Tümü →</a>
                    </div>
                    <div class="popular-list">
                        <?php 
                        usort($all_courses, function($a, $b) {
                            $students_a = intval(get_post_meta($a->ID, '_course_students', true));
                            $students_b = intval(get_post_meta($b->ID, '_course_students', true));
                            return $students_b - $students_a;
                        });
                        $popular_courses = array_slice($all_courses, 0, 5);
                        
                        foreach ($popular_courses as $index => $course): 
                            $students = intval(get_post_meta($course->ID, '_course_students', true));
                            $price = get_post_meta($course->ID, '_course_price', true);
                            $thumbnail = get_the_post_thumbnail_url($course->ID, 'thumbnail') ?: get_template_directory_uri() . '/assets/images/course-placeholder.jpg';
                        ?>
                        <div class="popular-item">
                            <span class="popular-rank"><?php echo $index + 1; ?></span>
                            <img src="<?php echo esc_url($thumbnail); ?>" alt="" class="popular-thumb">
                            <div class="popular-content">
                                <span class="popular-title"><?php echo esc_html($course->post_title); ?></span>
                                <span class="popular-meta">🎓 <?php echo number_format($students, 0, ',', '.'); ?> öğrenci</span>
                            </div>
                            <span class="popular-revenue"><?php echo number_format(floatval($price) * $students, 0, ',', '.'); ?> ₺</span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- System Status -->
                <div class="dashboard-card status-card">
                    <div class="card-header">
                        <h3 class="card-title">⚙️ Sistem Durumu</h3>
                    </div>
                    <div class="status-list">
                        <div class="status-item">
                            <span class="status-name">WordPress</span>
                            <span class="status-badge success"><?php echo get_bloginfo('version'); ?></span>
                        </div>
                        <div class="status-item">
                            <span class="status-name">PHP Sürümü</span>
                            <span class="status-badge success"><?php echo phpversion(); ?></span>
                        </div>
                        <div class="status-item">
                            <span class="status-name">Aktif Tema</span>
                            <span class="status-badge success">Metabilinç</span>
                        </div>
                        <div class="status-item">
                            <span class="status-name">Veritabanı</span>
                            <span class="status-badge success">Bağlı</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<style>
/* Admin Dashboard Styles */
.admin-wrapper {
    display: flex;
    min-height: calc(100vh - 80px);
    background: #f8fafc;
}

/* Sidebar */
.admin-sidebar {
    width: 280px;
    background: #1f2937;
    color: white;
    display: flex;
    flex-direction: column;
    position: fixed;
    height: 100%;
    overflow-y: auto;
    z-index: 100;
}

.admin-logo {
    padding: 24px;
    border-bottom: 1px solid #374151;
    display: flex;
    align-items: center;
    gap: 12px;
}

.logo-icon {
    font-size: 28px;
}

.logo-text {
    font-size: 18px;
    font-weight: 700;
    line-height: 1.2;
}

.logo-text small {
    font-size: 12px;
    font-weight: 400;
    color: #9ca3af;
}

.admin-nav {
    flex: 1;
    padding: 16px 0;
}

.nav-section {
    padding: 16px 24px 8px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6b7280;
}

.admin-nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 24px;
    color: #d1d5db;
    text-decoration: none;
    transition: all 0.2s;
    position: relative;
}

.admin-nav-item:hover,
.admin-nav-item.active {
    background: #374151;
    color: white;
}

.admin-nav-item.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: #f97316;
}

.nav-icon {
    font-size: 18px;
    width: 24px;
    text-align: center;
}

.nav-text {
    flex: 1;
}

.nav-badge {
    background: #f97316;
    color: white;
    font-size: 11px;
    font-weight: 600;
    padding: 2px 8px;
    border-radius: 10px;
}

.admin-user {
    padding: 16px 24px;
    border-top: 1px solid #374151;
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 40px;
    height: 40px;
    background: #f97316;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 16px;
}

.user-info {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.user-name {
    font-weight: 600;
    font-size: 14px;
}

.user-role {
    font-size: 12px;
    color: #9ca3af;
}

.user-logout {
    color: #9ca3af;
    text-decoration: none;
    font-size: 18px;
    transition: color 0.2s;
}

.user-logout:hover {
    color: #ef4444;
}

/* Main Content */
.admin-main {
    flex: 1;
    margin-left: 280px;
    padding: 32px;
}

/* Header */
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 32px;
}

.page-title {
    font-size: 32px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 8px;
}

.page-subtitle {
    color: #6b7280;
    font-size: 16px;
}

.header-actions {
    display: flex;
    gap: 12px;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: #f97316;
    color: white;
}

.btn-primary:hover {
    background: #ea580c;
}

.btn-secondary {
    background: white;
    color: #374151;
    border: 1px solid #e5e7eb;
}

.btn-secondary:hover {
    background: #f9fafb;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 32px;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 16px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    border-left: 4px solid;
}

.stat-card.revenue { border-color: #10b981; }
.stat-card.students { border-color: #3b82f6; }
.stat-card.courses { border-color: #f97316; }
.stat-card.users { border-color: #8b5cf6; }
.stat-card.posts { border-color: #ec4899; }
.stat-card.conversion { border-color: #06b6d4; }

.stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

.stat-card.revenue .stat-icon { background: #d1fae5; }
.stat-card.students .stat-icon { background: #dbeafe; }
.stat-card.courses .stat-icon { background: #ffedd5; }
.stat-card.users .stat-icon { background: #ede9fe; }
.stat-card.posts .stat-icon { background: #fce7f3; }
.stat-card.conversion .stat-icon { background: #cffafe; }

.stat-content {
    display: flex;
    flex-direction: column;
}

.stat-label {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 4px;
}

.stat-value {
    font-size: 28px;
    font-weight: 700;
    color: #1f2937;
}

.stat-value small {
    font-size: 16px;
    font-weight: 400;
    color: #9ca3af;
}

.stat-change {
    font-size: 13px;
    margin-top: 4px;
}

.stat-change.positive { color: #10b981; }
.stat-change.warning { color: #f97316; }
.stat-change.negative { color: #ef4444; }

/* Quick Actions */
.quick-actions {
    margin-bottom: 32px;
}

.section-title {
    font-size: 20px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 20px;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

.action-card {
    background: white;
    border-radius: 12px;
    padding: 24px;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.action-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.action-icon {
    font-size: 36px;
    margin-bottom: 12px;
    display: block;
}

.action-title {
    display: block;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 4px;
}

.action-desc {
    display: block;
    font-size: 13px;
    color: #6b7280;
}

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

.dashboard-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    margin-bottom: 24px;
}

.card-header {
    padding: 20px 24px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-title {
    font-size: 16px;
    font-weight: 600;
    color: #1f2937;
}

.card-link {
    font-size: 13px;
    color: #f97316;
    text-decoration: none;
    font-weight: 500;
}

.card-link:hover {
    text-decoration: underline;
}

.chart-period {
    padding: 6px 12px;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    font-size: 13px;
    color: #374151;
    background: white;
}

/* Activity List */
.activity-list {
    padding: 8px 0;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 24px;
    border-bottom: 1px solid #f3f4f6;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.activity-icon.publish { background: #d1fae5; }
.activity-icon.draft { background: #fef3c7; }

.activity-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.activity-title {
    font-weight: 600;
    color: #1f2937;
    font-size: 14px;
}

.activity-meta {
    font-size: 12px;
    color: #6b7280;
    margin-top: 2px;
}

.activity-action {
    font-size: 13px;
    color: #f97316;
    text-decoration: none;
    font-weight: 500;
}

.activity-action:hover {
    text-decoration: underline;
}

/* User List */
.user-list {
    padding: 8px 0;
}

.user-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 24px;
    border-bottom: 1px solid #f3f4f6;
}

.user-item:last-child {
    border-bottom: none;
}

.user-avatar-small {
    width: 40px;
    height: 40px;
    background: #f97316;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: white;
    font-size: 14px;
}

.user-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.user-content .user-name {
    font-weight: 600;
    color: #1f2937;
    font-size: 14px;
}

.user-meta {
    font-size: 12px;
    color: #6b7280;
    margin-top: 2px;
}

.user-action {
    font-size: 13px;
    color: #f97316;
    text-decoration: none;
    font-weight: 500;
}

/* Chart */
.chart-container {
    padding: 24px;
}

.bar-chart {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    height: 200px;
    gap: 12px;
}

.bar-item {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}

.bar-value {
    width: 100%;
    border-radius: 4px 4px 0 0;
    min-height: 20px;
    transition: all 0.3s;
}

.bar-label {
    font-size: 12px;
    color: #6b7280;
}

/* Popular List */
.popular-list {
    padding: 8px 0;
}

.popular-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 24px;
    border-bottom: 1px solid #f3f4f6;
}

.popular-item:last-child {
    border-bottom: none;
}

.popular-rank {
    width: 28px;
    height: 28px;
    background: #f3f4f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 12px;
    color: #6b7280;
}

.popular-item:nth-child(1) .popular-rank { background: #fbbf24; color: white; }
.popular-item:nth-child(2) .popular-rank { background: #9ca3af; color: white; }
.popular-item:nth-child(3) .popular-rank { background: #f97316; color: white; }

.popular-thumb {
    width: 48px;
    height: 32px;
    border-radius: 4px;
    object-fit: cover;
}

.popular-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.popular-title {
    font-weight: 500;
    color: #1f2937;
    font-size: 13px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.popular-meta {
    font-size: 12px;
    color: #6b7280;
    margin-top: 2px;
}

.popular-revenue {
    font-weight: 600;
    color: #10b981;
    font-size: 13px;
}

/* Status Card */
.status-list {
    padding: 8px 0;
}

.status-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 24px;
    border-bottom: 1px solid #f3f4f6;
}

.status-item:last-child {
    border-bottom: none;
}

.status-name {
    font-size: 14px;
    color: #374151;
}

.status-badge {
    font-size: 12px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 20px;
}

.status-badge.success {
    background: #d1fae5;
    color: #065f46;
}

/* Responsive */
@media (max-width: 1280px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 1024px) {
    .admin-sidebar {
        width: 80px;
    }
    
    .admin-logo .logo-text,
    .nav-text,
    .nav-section,
    .user-info {
        display: none;
    }
    
    .admin-nav-item {
        justify-content: center;
        padding: 16px;
    }
    
    .nav-icon {
        font-size: 22px;
    }
    
    .nav-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        padding: 2px 6px;
        font-size: 10px;
    }
    
    .admin-user {
        justify-content: center;
        padding: 16px;
    }
    
    .admin-main {
        margin-left: 80px;
    }
}

@media (max-width: 768px) {
    .admin-sidebar {
        transform: translateX(-100%);
        width: 280px;
    }
    
    .admin-sidebar.open {
        transform: translateX(0);
    }
    
    .admin-main {
        margin-left: 0;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .actions-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .admin-header {
        flex-direction: column;
        gap: 16px;
    }
    
    .header-actions {
        width: 100%;
    }
    
    .btn {
        flex: 1;
        justify-content: center;
    }
}
</style>

<?php get_footer(); ?>