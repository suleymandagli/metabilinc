<?php
/**
 * Template Name: Admin Ödemeler - Ödeme Yönetimi
 * Description: Merkezi admin dashboard ödeme yönetim sayfası
 */

// Güvenlik kontrolü - sadece admin ve editor erişebilir
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url(get_permalink()));
    exit;
}

$current_user = wp_get_current_user();
if (!in_array('administrator', $current_user->roles) && !in_array('editor', $current_user->roles)) {
    wp_redirect(home_url());
    exit;
}

// Filtre parametrelerini al
$filter_status = isset($_GET['status']) ? sanitize_text_field($_GET['status']) : 'all';
$filter_gateway = isset($_GET['gateway']) ? sanitize_text_field($_GET['gateway']) : 'all';
$filter_search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
$filter_date_from = isset($_GET['date_from']) ? sanitize_text_field($_GET['date_from']) : '';
$filter_date_to = isset($_GET['date_to']) ? sanitize_text_field($_GET['date_to']) : '';
$current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;

// Ödeme verilerini getir (YENİ: Gerçek fonksiyon kullanılıyor)
$payment_args = array(
    'status' => $filter_status,
    'gateway' => $filter_gateway,
    'search' => $filter_search,
    'date_from' => $filter_date_from,
    'date_to' => $filter_date_to,
    'per_page' => 20,
    'page' => $current_page,
);

$payments_data = metabilinc_get_payments($payment_args);
$payments = $payments_data['payments'];
$total_payments = $payments_data['total'];
$total_pages = $payments_data['pages'];

// İstatistikleri getir (YENİ: Gerçek fonksiyon kullanılıyor)
$stats = metabilinc_get_payment_stats();
$currency_symbol = metabilinc_get_currency_symbol();

// Ödeme ayarlarını kontrol et
$payment_settings = metabilinc_get_payment_settings();
$active_gateway = $payment_settings['active_gateway'];
$api_configured = false;

switch ($active_gateway) {
    case 'iyzico':
        $api_configured = !empty($payment_settings['iyzico']['api_key']) && !empty($payment_settings['iyzico']['secret_key']);
        break;
    case 'paytr':
        $api_configured = !empty($payment_settings['paytr']['merchant_id']) && !empty($payment_settings['paytr']['merchant_key']);
        break;
    case 'stripe':
        $api_configured = !empty($payment_settings['stripe']['secret_key']);
        break;
}
);

// İstatistikler metabilinc_get_payment_stats() fonksiyonundan alındı (yukarıda)
// $stats değişkeni: total_revenue, completed, pending, failed, total
$total_revenue = $stats['total_revenue'];
$completed_payments = $stats['completed'];
$pending_payments = $stats['pending'];
$failed_payments = $stats['failed'];

// Durum çevirileri - artık metabilinc_get_payment_status_label() fonksiyonu kullanılıyor

get_header();
?>

<style>
/* Admin Dashboard Styles - Sidebar */
.admin-dashboard-container {
    display: flex;
    min-height: 100vh;
    background: #f8fafc;
}

.admin-sidebar {
    width: 260px;
    background: #1e293b;
    color: #fff;
    position: fixed;
    height: 100vh;
    overflow-y: auto;
    z-index: 1000;
    transition: all 0.3s ease;
}

.admin-sidebar-header {
    padding: 20px;
    border-bottom: 1px solid #334155;
    text-align: center;
}

.admin-sidebar-logo {
    max-width: 150px;
    height: auto;
}

.admin-sidebar-user {
    padding: 20px;
    border-bottom: 1px solid #334155;
    display: flex;
    align-items: center;
    gap: 12px;
}

.admin-sidebar-avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f97316, #ea580c);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 16px;
    color: #fff;
}

.admin-sidebar-info h4 {
    margin: 0;
    font-size: 14px;
    font-weight: 600;
    color: #f1f5f9;
}

.admin-sidebar-info span {
    font-size: 12px;
    color: #94a3b8;
}

.admin-sidebar-nav {
    padding: 15px 0;
}

.admin-nav-section {
    margin-bottom: 8px;
}

.admin-nav-title {
    padding: 12px 20px;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #64748b;
    font-weight: 600;
}

.admin-nav-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    color: #cbd5e1;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.2s ease;
    border-left: 3px solid transparent;
}

.admin-nav-link:hover {
    background: #334155;
    color: #fff;
    border-left-color: #f97316;
}

.admin-nav-link.active {
    background: #334155;
    color: #f97316;
    border-left-color: #f97316;
}

.admin-nav-link svg {
    width: 18px;
    height: 18px;
    opacity: 0.8;
}

.admin-sidebar-footer {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 15px 20px;
    border-top: 1px solid #334155;
}

.admin-logout-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #ef4444;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.2s ease;
}

.admin-logout-btn:hover {
    color: #dc2626;
}

/* Main Content */
.admin-main {
    flex: 1;
    margin-left: 260px;
    padding: 30px;
    min-height: 100vh;
}

.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e2e8f0;
}

.admin-header h1 {
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.admin-header-actions {
    display: flex;
    gap: 12px;
}

.admin-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
}

.admin-btn-primary {
    background: #f97316;
    color: #fff;
}

.admin-btn-primary:hover {
    background: #ea580c;
}

.admin-btn-secondary {
    background: #e2e8f0;
    color: #475569;
}

.admin-btn-secondary:hover {
    background: #cbd5e1;
}

/* Stats Cards */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
    font-size: 24px;
}

.stat-icon.green { background: #dcfce7; color: #16a34a; }
.stat-icon.orange { background: #ffedd5; color: #ea580c; }
.stat-icon.red { background: #fee2e2; color: #dc2626; }
.stat-icon.blue { background: #dbeafe; color: #2563eb; }

.stat-value {
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 4px 0;
}

.stat-label {
    font-size: 13px;
    color: #64748b;
    margin: 0;
}

/* Filters Section */
.filters-section {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
}

.filters-row {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    align-items: end;
}

.filter-group {
    flex: 1;
    min-width: 150px;
}

.filter-group label {
    display: block;
    font-size: 13px;
    font-weight: 500;
    color: #475569;
    margin-bottom: 6px;
}

.filter-group input,
.filter-group select {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    color: #374151;
    background: #fff;
    transition: all 0.2s ease;
}

.filter-group input:focus,
.filter-group select:focus {
    outline: none;
    border-color: #f97316;
    box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
}

/* Table Styles */
.payments-table-container {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
    overflow: hidden;
}

.payments-table-header {
    padding: 20px 24px;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.payments-table-header h3 {
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

.table-search {
    position: relative;
}

.table-search input {
    padding: 10px 14px 10px 40px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    width: 280px;
}

.table-search svg {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    width: 16px;
    height: 16px;
    color: #9ca3af;
}

.payments-table {
    width: 100%;
    border-collapse: collapse;
}

.payments-table th,
.payments-table td {
    padding: 16px 20px;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
}

.payments-table th {
    background: #f8fafc;
    font-size: 12px;
    font-weight: 600;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.payments-table tbody tr:hover {
    background: #f8fafc;
}

.payments-table tbody tr:last-child td {
    border-bottom: none;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f97316, #ea580c);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
    color: #fff;
}

.user-details h4 {
    font-size: 14px;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 2px 0;
}

.user-details span {
    font-size: 12px;
    color: #64748b;
}

.course-name {
    font-size: 14px;
    color: #374151;
    font-weight: 500;
}

.amount {
    font-size: 15px;
    font-weight: 600;
    color: #1e293b;
}

.amount.free {
    color: #16a34a;
}

/* Status Badges */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}

.status-badge::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
}

.status-completed {
    background: #dcfce7;
    color: #166534;
}

.status-completed::before {
    background: #16a34a;
}

.status-pending {
    background: #ffedd5;
    color: #9a3412;
}

.status-pending::before {
    background: #f97316;
}

.status-failed {
    background: #fee2e2;
    color: #991b1b;
}

.status-failed::before {
    background: #dc2626;
}

.status-refunded {
    background: #dbeafe;
    color: #1e40af;
}

.status-refunded::before {
    background: #3b82f6;
}

.payment-date {
    font-size: 13px;
    color: #64748b;
}

.payment-method {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #475569;
}

/* Action Buttons */
.action-btns {
    display: flex;
    gap: 8px;
}

.action-btn {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
    background: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.action-btn:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
}

.action-btn svg {
    width: 16px;
    height: 16px;
    color: #64748b;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-top: 1px solid #e2e8f0;
}

.pagination-info {
    font-size: 14px;
    color: #64748b;
}

.pagination-info strong {
    color: #1e293b;
}

.pagination-btns {
    display: flex;
    gap: 8px;
}

.pagination-btn {
    padding: 8px 14px;
    border: 1px solid #e2e8f0;
    background: #fff;
    border-radius: 6px;
    font-size: 14px;
    color: #475569;
    cursor: pointer;
    transition: all 0.2s ease;
}

.pagination-btn:hover:not(:disabled) {
    background: #f1f5f9;
    border-color: #cbd5e1;
}

.pagination-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.pagination-btn.active {
    background: #f97316;
    border-color: #f97316;
    color: #fff;
}

/* Mobile Responsive */
@media (max-width: 1024px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .admin-sidebar {
        transform: translateX(-100%);
    }
    
    .admin-main {
        margin-left: 0;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .payments-table {
        display: block;
        overflow-x: auto;
    }
    
    .filters-row {
        flex-direction: column;
    }
    
    .filter-group {
        width: 100%;
    }
    
    .table-search input {
        width: 100%;
    }
}
</style>

<div class="admin-dashboard-container">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-sidebar-header">
            <?php if (has_custom_logo()): ?>
                <?php the_custom_logo(); ?>
            <?php else: ?>
                <h2 style="color: #fff; margin: 0; font-size: 20px;">Metabilinç</h2>
            <?php endif; ?>
        </div>
        
        <div class="admin-sidebar-user">
            <div class="admin-sidebar-avatar">
                <?php echo strtoupper(substr($current_user->display_name, 0, 2)); ?>
            </div>
            <div class="admin-sidebar-info">
                <h4><?php echo esc_html($current_user->display_name); ?></h4>
                <span><?php echo translate_user_role($current_user->roles[0]); ?></span>
            </div>
        </div>
        
        <nav class="admin-sidebar-nav">
            <div class="admin-nav-section">
                <div class="admin-nav-title">Ana Menü</div>
                <a href="<?php echo home_url('/admin-dashboard'); ?>" class="admin-nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
            </div>
            
            <div class="admin-nav-section">
                <div class="admin-nav-title">Eğitim</div>
                <a href="<?php echo home_url('/admin-kurslar'); ?>" class="admin-nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Tüm Kurslar
                </a>
                <a href="<?php echo home_url('/admin-kurs-ekle'); ?>" class="admin-nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Kurs Ekle
                </a>
            </div>
            
            <div class="admin-nav-section">
                <div class="admin-nav-title">Finans</div>
                <a href="<?php echo home_url('/admin-odemeler'); ?>" class="admin-nav-link active">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Ödemeler
                </a>
                <a href="<?php echo home_url('/admin-odeme-ayarlari'); ?>" class="admin-nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Ödeme Ayarları
                </a>
                <a href="#" class="admin-nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Raporlar
                </a>
            </div>
            
            <div class="admin-nav-section">
                <div class="admin-nav-title">Kullanıcılar</div>
                <a href="#" class="admin-nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Tüm Üyeler
                </a>
            </div>
        </nav>
        
        <div class="admin-sidebar-footer">
            <a href="<?php echo wp_logout_url(home_url()); ?>" class="admin-logout-btn">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Çıkış Yap
            </a>
        </div>
    </aside>
    
    <!-- Main Content -->
    <main class="admin-main">
        <div class="admin-header">
            <div>
                <h1>💳 Ödeme Yönetimi</h1>
                <p style="color: #64748b; margin: 5px 0 0 0;">Tüm ödemeleri görüntüleyin ve yönetin</p>
            </div>
            <div class="admin-header-actions">
                <button class="admin-btn admin-btn-secondary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Dışa Aktar
                </button>
            </div>
        </div>
        
        <!-- Gateway Status Notice -->
        <?php if (!$api_configured): ?>
        <div style="background: #fef3c7; border: 1px solid #f59e0b; border-radius: 8px; padding: 16px 20px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
            <span style="font-size: 24px;">⚠️</span>
            <div style="flex: 1;">
                <strong style="color: #92400e; display: block; margin-bottom: 4px;">Ödeme Sistemi Yapılandırılmamış</strong>
                <span style="color: #92400e; font-size: 14px;">Şu an simülasyon verileri gösteriliyor. Gerçek ödemeleri görüntülemek için lütfen ödeme ayarlarını yapılandırın.</span>
            </div>
            <a href="<?php echo home_url('/admin-odeme-ayarlari'); ?>" style="background: #f59e0b; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: 500; font-size: 14px; white-space: nowrap;">⚙️ Ayarları Yapılandır</a>
        </div>
        <?php else: ?>
        <div style="background: #dcfce7; border: 1px solid #22c55e; border-radius: 8px; padding: 16px 20px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
            <span style="font-size: 24px;">✅</span>
            <div>
                <strong style="color: #166534; display: block; margin-bottom: 4px;">Ödeme Sistemi Aktif</strong>
                <span style="color: #166534; font-size: 14px;">Aktif ödeme sağlayıcısı: <strong><?php echo metabilinc_get_payment_gateway_label($active_gateway); ?></strong></span>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon green">💰</div>
                <div class="stat-value"><?php echo number_format($total_revenue, 2, ',', '.'); ?> <?php echo esc_html($currency_symbol); ?></div>
                <div class="stat-label">Toplam Gelir</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon blue">✅</div>
                <div class="stat-value"><?php echo $completed_payments; ?></div>
                <div class="stat-label">Tamamlanan Ödeme</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orange">⏳</div>
                <div class="stat-value"><?php echo $pending_payments; ?></div>
                <div class="stat-label">Bekleyen Ödeme</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon red">❌</div>
                <div class="stat-value"><?php echo $failed_payments; ?></div>
                <div class="stat-label">Başarısız Ödeme</div>
            </div>
        </div>
        
        <!-- Filters -->
        <form method="GET" action="" class="filters-section">
            <div class="filters-row">
                <div class="filter-group">
                    <label>Durum</label>
                    <select name="status">
                        <option value="all" <?php selected($filter_status, 'all'); ?>>Tümü</option>
                        <option value="completed" <?php selected($filter_status, 'completed'); ?>>Tamamlandı</option>
                        <option value="pending" <?php selected($filter_status, 'pending'); ?>>Bekliyor</option>
                        <option value="failed" <?php selected($filter_status, 'failed'); ?>>Başarısız</option>
                        <option value="refunded" <?php selected($filter_status, 'refunded'); ?>>İade</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Ödeme Yöntemi</label>
                    <select name="gateway">
                        <option value="all" <?php selected($filter_gateway, 'all'); ?>>Tümü</option>
                        <option value="iyzico" <?php selected($filter_gateway, 'iyzico'); ?>>iyzico</option>
                        <option value="paytr" <?php selected($filter_gateway, 'paytr'); ?>>PayTR</option>
                        <option value="stripe" <?php selected($filter_gateway, 'stripe'); ?>>Stripe</option>
                        <option value="bank_transfer" <?php selected($filter_gateway, 'bank_transfer'); ?>>Havale/EFT</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Tarih Başlangıç</label>
                    <input type="date" name="date_from" value="<?php echo esc_attr($filter_date_from); ?>">
                </div>
                <div class="filter-group">
                    <label>Tarih Bitiş</label>
                    <input type="date" name="date_to" value="<?php echo esc_attr($filter_date_to); ?>">
                </div>
                <div class="filter-group" style="flex: 0 0 auto;">
                    <button type="submit" class="admin-btn admin-btn-primary">Filtrele</button>
                </div>
            </div>
        </form>
        
        <!-- Payments Table -->
        <div class="payments-table-container">
            <div class="payments-table-header">
                <h3>Son Ödemeler</h3>
                <div class="table-search">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Ara...">
                </div>
            </div>
            
            <table class="payments-table">
                <thead>
                    <tr>
                        <th>Ödeme ID</th>
                        <th>Kullanıcı</th>
                        <th>Kurs</th>
                        <th>Tutar</th>
                        <th>Durum</th>
                        <th>Tarih</th>
                        <th>Yöntem</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td>
                            <span style="font-family: monospace; font-size: 13px; color: #64748b;"><?php echo esc_html($payment['id']); ?></span>
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    <?php echo strtoupper(substr($payment['user_name'], 0, 2)); ?>
                                </div>
                                <div class="user-details">
                                    <h4><?php echo esc_html($payment['user_name']); ?></h4>
                                    <span><?php echo esc_html($payment['user_email']); ?></span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="course-name"><?php echo esc_html($payment['course']); ?></span>
                        </td>
                        <td>
                            <?php if ($payment['amount'] == 0): ?>
                                <span class="amount free">Ücretsiz</span>
                            <?php else: ?>
                                <span class="amount"><?php echo number_format($payment['amount'], 2, ',', '.'); ?> <?php echo esc_html($currency_symbol); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php 
                            $status_info = metabilinc_get_payment_status_label($payment['status']);
                            ?>
                            <span class="status-badge <?php echo esc_attr($status_info['class']); ?>">
                                <?php echo esc_html($status_info['label']); ?>
                            </span>
                        </td>
                        <td>
                            <span class="payment-date"><?php echo date('d.m.Y H:i', strtotime($payment['date'])); ?></span>
                        </td>
                        <td>
                            <span class="payment-method">
                                <?php echo metabilinc_get_payment_gateway_label($payment['gateway']); ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn" title="Detay">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                <?php if ($payment['status'] === 'pending'): ?>
                                <button class="action-btn" title="Onayla">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #16a34a;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <!-- Pagination -->
            <div class="pagination">
                <div class="pagination-info">
                    <?php 
                    $start = ($current_page - 1) * 20 + 1;
                    $end = min($current_page * 20, $total_payments);
                    ?>
                    <strong><?php echo $start; ?></strong> - <strong><?php echo $end; ?></strong> arası <strong><?php echo $total_payments; ?></strong> sonuç gösteriliyor
                </div>
                <div class="pagination-btns">
                    <?php if ($current_page > 1): ?>
                        <a href="<?php echo add_query_arg('paged', $current_page - 1); ?>" class="pagination-btn">Önceki</a>
                    <?php else: ?>
                        <button class="pagination-btn" disabled>Önceki</button>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <?php if ($i == $current_page): ?>
                            <button class="pagination-btn active"><?php echo $i; ?></button>
                        <?php else: ?>
                            <a href="<?php echo add_query_arg('paged', $i); ?>" class="pagination-btn"><?php echo $i; ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>
                    
                    <?php if ($current_page < $total_pages): ?>
                        <a href="<?php echo add_query_arg('paged', $current_page + 1); ?>" class="pagination-btn">Sonraki</a>
                    <?php else: ?>
                        <button class="pagination-btn" disabled>Sonraki</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>

<?php get_footer(); ?>