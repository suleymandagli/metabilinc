<?php
/**
 * Template Name: Admin - Ödeme Ayarları
 * Description: Ödeme sistemi yapılandırma sayfası
 * 
 * SADECE YÖNETİCİLER VE EDİTÖRLER ERİŞEBİLİR
 */

// Kullanıcı yetki kontrolü
if (!current_user_can('administrator') && !current_user_can('editor')) {
    wp_redirect(home_url());
    exit;
}

get_header();

// Mevcut ayarları al
$payment_settings = get_option('metabilinc_payment_settings', array());

// Form gönderildi mi kontrol et
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_payment_settings'])) {
    check_admin_referer('metabilinc_payment_settings_nonce');
    
    // Ayarları kaydet
    $new_settings = array(
        'active_gateway' => sanitize_text_field($_POST['active_gateway']),
        'iyzico' => array(
            'api_key' => sanitize_text_field($_POST['iyzico_api_key']),
            'secret_key' => sanitize_text_field($_POST['iyzico_secret_key']),
            'sandbox' => isset($_POST['iyzico_sandbox']) ? true : false,
        ),
        'paytr' => array(
            'merchant_id' => sanitize_text_field($_POST['paytr_merchant_id']),
            'merchant_key' => sanitize_text_field($_POST['paytr_merchant_key']),
            'merchant_salt' => sanitize_text_field($_POST['paytr_merchant_salt']),
            'sandbox' => isset($_POST['paytr_sandbox']) ? true : false,
        ),
        'stripe' => array(
            'publishable_key' => sanitize_text_field($_POST['stripe_publishable_key']),
            'secret_key' => sanitize_text_field($_POST['stripe_secret_key']),
        ),
        'bank_transfer' => array(
            'enabled' => isset($_POST['bank_transfer_enabled']) ? true : false,
            'account_name' => sanitize_text_field($_POST['bank_account_name']),
            'account_iban' => sanitize_text_field($_POST['bank_account_iban']),
            'account_bank' => sanitize_text_field($_POST['bank_account_bank']),
            'instructions' => wp_kses_post($_POST['bank_instructions']),
        ),
        'currency' => sanitize_text_field($_POST['currency']),
        'currency_symbol' => sanitize_text_field($_POST['currency_symbol']),
    );
    
    update_option('metabilinc_payment_settings', $new_settings);
    $payment_settings = $new_settings;
    $saved = true;
}

// Gateway seçenekleri
$gateways = array(
    'iyzico' => '💳 iyzico',
    'paytr' => '💳 PayTR',
    'stripe' => '💳 Stripe',
    'bank_transfer' => '🏦 Havale/EFT',
);

// Para birimleri
$currencies = array(
    'TRY' => 'Türk Lirası (₺)',
    'USD' => 'Amerikan Doları ($)',
    'EUR' => 'Euro (€)',
    'GBP' => 'İngiliz Sterlini (£)',
);

// Aktif gateway
$active_gateway = isset($payment_settings['active_gateway']) ? $payment_settings['active_gateway'] : 'iyzico';
?>

<style>
    /* Admin Dashboard Styles */
    .admin-dashboard {
        display: flex;
        min-height: 100vh;
        background: #f8fafc;
    }
    
    .admin-sidebar {
        width: 280px;
        background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
        color: white;
        position: fixed;
        height: 100vh;
        overflow-y: auto;
        z-index: 100;
    }
    
    .admin-sidebar-header {
        padding: 24px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    
    .admin-sidebar-header h2 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        color: white;
    }
    
    .admin-sidebar-header p {
        font-size: 12px;
        color: #94a3b8;
        margin: 4px 0 0 0;
    }
    
    .admin-nav {
        padding: 16px 0;
    }
    
    .admin-nav-section {
        margin-bottom: 8px;
    }
    
    .admin-nav-title {
        padding: 8px 24px;
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .admin-nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 24px;
        color: #cbd5e1;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.2s;
        border-left: 3px solid transparent;
    }
    
    .admin-nav-item:hover {
        background: rgba(255,255,255,0.05);
        color: white;
    }
    
    .admin-nav-item.active {
        background: rgba(255,255,255,0.1);
        color: white;
        border-left-color: #f97316;
    }
    
    .admin-nav-item i {
        width: 20px;
        text-align: center;
    }
    
    .admin-main {
        flex: 1;
        margin-left: 280px;
        min-height: 100vh;
    }
    
    .admin-header {
        background: white;
        border-bottom: 1px solid #e2e8f0;
        padding: 16px 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 50;
    }
    
    .admin-header-left h1 {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }
    
    .admin-header-left p {
        color: #64748b;
        margin: 4px 0 0 0;
        font-size: 14px;
    }
    
    .admin-header-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    
    .admin-user {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .admin-user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f97316, #ea580c);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
    }
    
    .admin-content {
        padding: 32px;
        max-width: 1200px;
    }
    
    /* Success Message */
    .success-message {
        background: #dcfce7;
        border: 1px solid #86efac;
        color: #166534;
        padding: 16px 20px;
        border-radius: 8px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .success-message::before {
        content: '✓';
        width: 24px;
        height: 24px;
        background: #22c55e;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
    
    /* Settings Cards */
    .settings-grid {
        display: grid;
        gap: 24px;
    }
    
    .settings-card {
        background: white;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }
    
    .settings-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #e2e8f0;
        background: #f8fafc;
    }
    
    .settings-card-header h3 {
        font-size: 16px;
        font-weight: 600;
        color: #1e293b;
        margin: 0 0 4px 0;
    }
    
    .settings-card-header p {
        font-size: 13px;
        color: #64748b;
        margin: 0;
    }
    
    .settings-card-body {
        padding: 24px;
    }
    
    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group:last-child {
        margin-bottom: 0;
    }
    
    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .form-group label .required {
        color: #ef4444;
    }
    
    .form-group input[type="text"],
    .form-group input[type="password"],
    .form-group input[type="email"],
    .form-group input[type="number"],
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.2s;
        background: white;
    }
    
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: #f97316;
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
    }
    
    .form-group .help-text {
        font-size: 12px;
        color: #6b7280;
        margin-top: 6px;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    /* Checkbox Style */
    .checkbox-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: #f9fafb;
        border-radius: 8px;
        cursor: pointer;
    }
    
    .checkbox-wrapper input[type="checkbox"] {
        width: 20px;
        height: 20px;
        accent-color: #f97316;
    }
    
    .checkbox-wrapper label {
        margin: 0;
        cursor: pointer;
    }
    
    /* Gateway Selection */
    .gateway-options {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    
    .gateway-option {
        position: relative;
    }
    
    .gateway-option input[type="radio"] {
        position: absolute;
        opacity: 0;
    }
    
    .gateway-option label {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .gateway-option input[type="radio"]:checked + label {
        border-color: #f97316;
        background: #fff7ed;
    }
    
    .gateway-option .gateway-icon {
        width: 48px;
        height: 48px;
        background: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .gateway-option .gateway-info h4 {
        font-size: 15px;
        font-weight: 600;
        color: #1e293b;
        margin: 0 0 4px 0;
    }
    
    .gateway-option .gateway-info p {
        font-size: 12px;
        color: #64748b;
        margin: 0;
    }
    
    /* Section Tabs */
    .gateway-sections {
        margin-top: 24px;
    }
    
    .gateway-section {
        display: none;
    }
    
    .gateway-section.active {
        display: block;
    }
    
    .gateway-section-title {
        font-size: 18px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f97316;
        display: inline-block;
    }
    
    /* Save Button */
    .form-actions {
        position: sticky;
        bottom: 0;
        background: white;
        padding: 20px 24px;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin: 0 -24px -24px -24px;
    }
    
    .btn {
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #f97316, #ea580c);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(249, 115, 22, 0.4);
    }
    
    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
    }
    
    .btn-secondary:hover {
        background: #e5e7eb;
    }
    
    /* Test Connection Button */
    .test-connection-btn {
        padding: 8px 16px;
        background: #dbeafe;
        color: #1d4ed8;
        border: 1px solid #93c5fd;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .test-connection-btn:hover {
        background: #bfdbfe;
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .admin-sidebar {
            transform: translateX(-100%);
        }
        
        .admin-main {
            margin-left: 0;
        }
        
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .gateway-options {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="admin-dashboard">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-sidebar-header">
            <h2>🏫 Metabilinç Akademi</h2>
            <p>Yönetim Paneli</p>
        </div>
        
        <nav class="admin-nav">
            <div class="admin-nav-section">
                <div class="admin-nav-title">Ana Menü</div>
                <a href="<?php echo home_url('/admin-dashboard'); ?>" class="admin-nav-item">
                    <span>📊</span>
                    Dashboard
                </a>
            </div>
            
            <div class="admin-nav-section">
                <div class="admin-nav-title">İçerik</div>
                <a href="<?php echo home_url('/admin-kurslar'); ?>" class="admin-nav-item">
                    <span>📚</span>
                    Kurslar
                </a>
                <a href="<?php echo home_url('/admin-kurs-ekle'); ?>" class="admin-nav-item">
                    <span>➕</span>
                    Yeni Kurs Ekle
                </a>
            </div>
            
            <div class="admin-nav-section">
                <div class="admin-nav-title">Finans</div>
                <a href="<?php echo home_url('/admin-odemeler'); ?>" class="admin-nav-item">
                    <span>💳</span>
                    Ödemeler
                </a>
                <a href="<?php echo home_url('/admin-odeme-ayarlari'); ?>" class="admin-nav-item active">
                    <span>⚙️</span>
                    Ödeme Ayarları
                </a>
            </div>
            
            <div class="admin-nav-section">
                <div class="admin-nav-title">Sistem</div>
                <a href="<?php echo home_url(); ?>" class="admin-nav-item">
                    <span>🏠</span>
                    Siteye Dön
                </a>
                <a href="<?php echo wp_logout_url(home_url()); ?>" class="admin-nav-item">
                    <span>🚪</span>
                    Çıkış Yap
                </a>
            </div>
        </nav>
    </aside>
    
    <!-- Main Content -->
    <main class="admin-main">
        <header class="admin-header">
            <div class="admin-header-left">
                <h1>⚙️ Ödeme Ayarları</h1>
                <p>Ödeme sistemi yapılandırması ve API entegrasyonu</p>
            </div>
            
            <div class="admin-header-right">
                <div class="admin-user">
                    <div class="admin-user-avatar">
                        <?php echo substr(wp_get_current_user()->display_name, 0, 1); ?>
                    </div>
                    <div>
                        <strong><?php echo wp_get_current_user()->display_name; ?></strong>
                        <p style="margin:0;font-size:12px;color:#64748b;">Yönetici</p>
                    </div>
                </div>
            </div>
        </header>
        
        <div class="admin-content">
            <?php if (isset($saved) && $saved) : ?>
                <div class="success-message">
                    Ayarlar başarıyla kaydedildi!
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <?php wp_nonce_field('metabilinc_payment_settings_nonce'); ?>
                
                <div class="settings-grid">
                    <!-- Gateway Selection -->
                    <div class="settings-card">
                        <div class="settings-card-header">
                            <h3>🎯 Aktif Ödeme Yöntemi</h3>
                            <p>Hangi ödeme sağlayıcısını kullanmak istiyorsunuz?</p>
                        </div>
                        <div class="settings-card-body">
                            <div class="gateway-options">
                                <?php foreach ($gateways as $key => $label) : ?>
                                    <div class="gateway-option">
                                        <input type="radio" name="active_gateway" id="gateway_<?php echo $key; ?>" value="<?php echo $key; ?>" <?php checked($active_gateway, $key); ?>>
                                        <label for="gateway_<?php echo $key; ?>">
                                            <div class="gateway-icon"><?php echo substr($label, 0, 2); ?></div>
                                            <div class="gateway-info">
                                                <h4><?php echo substr($label, 3); ?></h4>
                                                <p><?php 
                                                    switch($key) {
                                                        case 'iyzico': echo 'Türkiye\'nin önde gelen ödeme sistemleri'; break;
                                                        case 'paytr': echo 'Türk Lirası ödemeler için optimize'; break;
                                                        case 'stripe': echo 'Global ödeme altyapısı'; break;
                                                        case 'bank_transfer': echo 'Manuel havale/EFT onayı'; break;
                                                    }
                                                ?></p>
                                            </div>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <!-- Currency Settings -->
                            <div class="form-row" style="margin-top: 24px;">
                                <div class="form-group">
                                    <label for="currency">Para Birimi</label>
                                    <select name="currency" id="currency">
                                        <?php foreach ($currencies as $code => $name) : ?>
                                            <option value="<?php echo $code; ?>" <?php selected(isset($payment_settings['currency']) ? $payment_settings['currency'] : 'TRY', $code); ?>><?php echo $name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="currency_symbol">Para Birimi Sembolü</label>
                                    <input type="text" name="currency_symbol" id="currency_symbol" value="<?php echo isset($payment_settings['currency_symbol']) ? esc_attr($payment_settings['currency_symbol']) : '₺'; ?>">
                                    <p class="help-text">Örnek: ₺, $, €, £</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- iyzico Settings -->
                    <div class="settings-card gateway-section" id="section_iyzico">
                        <div class="settings-card-header">
                            <h3>💳 iyzico API Ayarları</h3>
                            <p>iyzico panelinden aldığınız API bilgilerini girin</p>
                        </div>
                        <div class="settings-card-body">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="iyzico_api_key">API Key <span class="required">*</span></label>
                                    <input type="text" name="iyzico_api_key" id="iyzico_api_key" value="<?php echo isset($payment_settings['iyzico']['api_key']) ? esc_attr($payment_settings['iyzico']['api_key']) : ''; ?>">
                                    <p class="help-text">iyzico paneli → Ayarlar → API Anahtarları</p>
                                </div>
                                <div class="form-group">
                                    <label for="iyzico_secret_key">Secret Key <span class="required">*</span></label>
                                    <input type="password" name="iyzico_secret_key" id="iyzico_secret_key" value="<?php echo isset($payment_settings['iyzico']['secret_key']) ? esc_attr($payment_settings['iyzico']['secret_key']) : ''; ?>">
                                    <p class="help-text">Güvenlik anahtarınız</p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="checkbox-wrapper">
                                    <input type="checkbox" name="iyzico_sandbox" id="iyzico_sandbox" <?php checked(isset($payment_settings['iyzico']['sandbox']) ? $payment_settings['iyzico']['sandbox'] : false); ?>>
                                    <label for="iyzico_sandbox">Sandbox/Test Modu Aktif</label>
                                </div>
                                <p class="help-text">Gerçek ödeme almadan önce test ortamında deneyin</p>
                            </div>
                            
                            <div style="margin-top: 16px;">
                                <button type="button" class="test-connection-btn" onclick="testConnection('iyzico')">🔗 Bağlantıyı Test Et</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- PayTR Settings -->
                    <div class="settings-card gateway-section" id="section_paytr">
                        <div class="settings-card-header">
                            <h3>💳 PayTR API Ayarları</h3>
                            <p>PayTR mağaza panelinden aldığınız bilgileri girin</p>
                        </div>
                        <div class="settings-card-body">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="paytr_merchant_id">Mağaza No (Merchant ID) <span class="required">*</span></label>
                                    <input type="text" name="paytr_merchant_id" id="paytr_merchant_id" value="<?php echo isset($payment_settings['paytr']['merchant_id']) ? esc_attr($payment_settings['paytr']['merchant_id']) : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="paytr_merchant_key">Merchant Key <span class="required">*</span></label>
                                    <input type="password" name="paytr_merchant_key" id="paytr_merchant_key" value="<?php echo isset($payment_settings['paytr']['merchant_key']) ? esc_attr($payment_settings['paytr']['merchant_key']) : ''; ?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="paytr_merchant_salt">Merchant Salt <span class="required">*</span></label>
                                <input type="password" name="paytr_merchant_salt" id="paytr_merchant_salt" value="<?php echo isset($payment_settings['paytr']['merchant_salt']) ? esc_attr($payment_settings['paytr']['merchant_salt']) : ''; ?>">
                                <p class="help-text">Güvenlik salt değeri</p>
                            </div>
                            
                            <div class="form-group">
                                <div class="checkbox-wrapper">
                                    <input type="checkbox" name="paytr_sandbox" id="paytr_sandbox" <?php checked(isset($payment_settings['paytr']['sandbox']) ? $payment_settings['paytr']['sandbox'] : false); ?>>
                                    <label for="paytr_sandbox">Test Modu Aktif</label>
                                </div>
                            </div>
                            
                            <div style="margin-top: 16px;">
                                <button type="button" class="test-connection-btn" onclick="testConnection('paytr')">🔗 Bağlantıyı Test Et</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stripe Settings -->
                    <div class="settings-card gateway-section" id="section_stripe">
                        <div class="settings-card-header">
                            <h3>💳 Stripe API Ayarları</h3>
                            <p>Stripe Dashboard'dan aldığınız API anahtarlarını girin</p>
                        </div>
                        <div class="settings-card-body">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="stripe_publishable_key">Publishable Key <span class="required">*</span></label>
                                    <input type="text" name="stripe_publishable_key" id="stripe_publishable_key" value="<?php echo isset($payment_settings['stripe']['publishable_key']) ? esc_attr($payment_settings['stripe']['publishable_key']) : ''; ?>">
                                    <p class="help-text">pk_live_... veya pk_test_...</p>
                                </div>
                                <div class="form-group">
                                    <label for="stripe_secret_key">Secret Key <span class="required">*</span></label>
                                    <input type="password" name="stripe_secret_key" id="stripe_secret_key" value="<?php echo isset($payment_settings['stripe']['secret_key']) ? esc_attr($payment_settings['stripe']['secret_key']) : ''; ?>">
                                    <p class="help-text">sk_live_... veya sk_test_...</p>
                                </div>
                            </div>
                            
                            <div style="margin-top: 16px;">
                                <button type="button" class="test-connection-btn" onclick="testConnection('stripe')">🔗 Bağlantıyı Test Et</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bank Transfer Settings -->
                    <div class="settings-card gateway-section" id="section_bank_transfer">
                        <div class="settings-card-header">
                            <h3>🏦 Havale/EFT Bilgileri</h3>
                            <p>Manuel ödeme onayı için banka hesap bilgileri</p>
                        </div>
                        <div class="settings-card-body">
                            <div class="form-group">
                                <div class="checkbox-wrapper">
                                    <input type="checkbox" name="bank_transfer_enabled" id="bank_transfer_enabled" <?php checked(isset($payment_settings['bank_transfer']['enabled']) ? $payment_settings['bank_transfer']['enabled'] : false); ?>>
                                    <label for="bank_transfer_enabled">Havale/EFT Ödemesini Aktif Et</label>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="bank_account_name">Hesap Adı/Sahibi</label>
                                    <input type="text" name="bank_account_name" id="bank_account_name" value="<?php echo isset($payment_settings['bank_transfer']['account_name']) ? esc_attr($payment_settings['bank_transfer']['account_name']) : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="bank_account_bank">Banka Adı</label>
                                    <input type="text" name="bank_account_bank" id="bank_account_bank" value="<?php echo isset($payment_settings['bank_transfer']['account_bank']) ? esc_attr($payment_settings['bank_transfer']['account_bank']) : ''; ?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="bank_account_iban">IBAN</label>
                                <input type="text" name="bank_account_iban" id="bank_account_iban" value="<?php echo isset($payment_settings['bank_transfer']['account_iban']) ? esc_attr($payment_settings['bank_transfer']['account_iban']) : ''; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="bank_instructions">Ödeme Talimatları</label>
                                <textarea name="bank_instructions" id="bank_instructions" rows="4"><?php echo isset($payment_settings['bank_transfer']['instructions']) ? esc_textarea($payment_settings['bank_transfer']['instructions']) : ''; ?></textarea>
                                <p class="help-text">Kullanıcılara gösterilecek ödeme talimatları</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Save Button -->
                <div class="form-actions">
                    <a href="<?php echo home_url('/admin-odemeler'); ?>" class="btn btn-secondary">İptal</a>
                    <button type="submit" name="save_payment_settings" class="btn btn-primary">
                        💾 Ayarları Kaydet
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
    // Gateway section visibility
    document.querySelectorAll('input[name="active_gateway"]').forEach(radio => {
        radio.addEventListener('change', function() {
            updateGatewaySections();
        });
    });
    
    function updateGatewaySections() {
        const selectedGateway = document.querySelector('input[name="active_gateway"]:checked').value;
        
        document.querySelectorAll('.gateway-section').forEach(section => {
            section.classList.remove('active');
        });
        
        const activeSection = document.getElementById('section_' + selectedGateway);
        if (activeSection) {
            activeSection.classList.add('active');
        }
    }
    
    // Initialize
    updateGatewaySections();
    
    // Test connection function
    function testConnection(gateway) {
        alert('🔧 ' + gateway.toUpperCase() + ' bağlantı testi yapılıyor...\n\nBu özellik API entegrasyonu tamamlandığında aktif olacaktır.');
    }
</script>

<?php get_footer(); ?>