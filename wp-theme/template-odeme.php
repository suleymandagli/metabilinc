<?php
/**
 * Template Name: Ödeme
 * 
 * @package Metabilinc
 */

get_header();

// Get course slug from URL
$course_slug = get_query_var('course');
if (!$course_slug) {
    // Try to get from query var
    if (isset($_GET['course'])) {
        $course_slug = sanitize_text_field($_GET['course']);
    }
}

// Get course data based on slug
$course_data = null;
$course_id = 0;

if ($course_slug) {
    // Try to get course by slug
    $course_post = get_page_by_path($course_slug, OBJECT, 'course');
    if ($course_post) {
        $course_id = $course_post->ID;
        $course_data = array(
            'title' => $course_post->post_title,
            'description' => $course_post->post_content,
            'price' => get_post_meta($course_id, '_course_price', true),
            'discounted_price' => get_post_meta($course_id, '_course_discounted_price', true),
            'duration' => get_post_meta($course_id, '_course_duration', true),
            'is_free' => get_post_meta($course_id, '_course_is_free', true),
        );
    }
}

// Default course data if not found
if (!$course_data) {
    $course_data = array(
        'title' => 'Bilinçli Aile Okulu',
        'description' => '0-18 yaş çocuklarınızla daha sağlıklı iletişim kurun.',
        'price' => 1997,
        'discounted_price' => 997,
        'duration' => '8 Hafta',
        'is_free' => false,
    );
}

// Calculate final price
$final_price = $course_data['discounted_price'] ? $course_data['discounted_price'] : $course_data['price'];
$has_discount = $course_data['discounted_price'] && $course_data['discounted_price'] < $course_data['price'];
$discount_percent = $has_discount ? round((1 - $course_data['discounted_price'] / $course_data['price']) * 100) : 0;
?>

<!-- Payment Hero -->
<section class="odeme-hero">
    <div class="container">
        <div class="odeme-hero-content">
            <h1>Ödeme</h1>
            <p>Kolay ve güvenli ödeme ile kursunuza hemen erişin.</p>
        </div>
    </div>
</section>

<!-- Payment Section -->
<section class="odeme-section">
    <div class="container">
        <div class="odeme-grid">
            <!-- Order Summary -->
            <div class="odeme-summary">
                <h2>Sipariş Özeti</h2>
                
                <div class="odeme-course-card">
                    <div class="odeme-course-icon">📚</div>
                    <div class="odeme-course-info">
                        <h3><?php echo $course_data['title']; ?></h3>
                        <p><?php echo $course_data['description']; ?></p>
                        <div class="odeme-course-meta">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <?php echo $course_data['duration']; ?>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="odeme-price-details">
                    <?php if ($has_discount) : ?>
                        <div class="odeme-price-row">
                            <span>Normal Fiyat</span>
                            <span class="odeme-price-original"><?php echo number_format($course_data['price'], 0, ',', '.'); ?> TL</span>
                        </div>
                        <div class="odeme-price-row">
                            <span>İndirim</span>
                            <span class="odeme-price-discount">-%<?php echo $discount_percent; ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <div class="odeme-price-total">
                        <span>Toplam</span>
                        <span class="odeme-price-final"><?php echo number_format($final_price, 0, ',', '.'); ?> TL</span>
                    </div>
                </div>
                
                <div class="odeme-features">
                    <div class="odeme-feature">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-success)" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Sınırsız Erişim</span>
                    </div>
                    <div class="odeme-feature">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-success)" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Sertifika</span>
                    </div>
                    <div class="odeme-feature">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-success)" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>7/24 Destek</span>
                    </div>
                    <div class="odeme-feature">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-success)" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>30 Gün İade Garanti</span>
                    </div>
                </div>
            </div>
            
            <!-- Payment Form -->
            <div class="odeme-form-wrapper">
                <div class="odeme-form-card">
                    <h2>Ödeme Bilgileri</h2>
                    
                    <form class="odeme-form" id="odeme-form">
                        <!-- Personal Info -->
                        <div class="odeme-form-section">
                            <h3>Kişisel Bilgiler</h3>
                            
                            <div class="odeme-form-row">
                                <div class="odeme-form-group">
                                    <label>Adınız</label>
                                    <input type="text" name="name" placeholder="Adınız" required>
                                </div>
                                <div class="odeme-form-group">
                                    <label>Soyadınız</label>
                                    <input type="text" name="surname" placeholder="Soyadınız" required>
                                </div>
                            </div>
                            
                            <div class="odeme-form-group">
                                <label>E-posta Adresiniz</label>
                                <input type="email" name="email" placeholder="email@ornek.com" required>
                            </div>
                            
                            <div class="odeme-form-group">
                                <label>Telefon Numaranız</label>
                                <input type="tel" name="phone" placeholder="05XX XXX XX XX" required>
                            </div>
                        </div>
                        
                        <!-- Payment Method -->
                        <div class="odeme-form-section">
                            <h3>Ödeme Yöntemi</h3>
                            
                            <div class="odeme-payment-methods">
                                <label class="odeme-payment-method active">
                                    <input type="radio" name="payment_method" value="credit_card" checked>
                                    <span class="odeme-payment-icon">💳</span>
                                    <span>Kredi Kartı</span>
                                </label>
                                <label class="odeme-payment-method">
                                    <input type="radio" name="payment_method" value="bank_transfer">
                                    <span class="odeme-payment-icon">🏦</span>
                                    <span>Havale/EFT</span>
                                </label>
                            </div>
                            
                            <div class="odeme-card-inputs">
                                <div class="odeme-form-group">
                                    <label>Kart Üzerindeki İsim</label>
                                    <input type="text" name="card_name" placeholder="Ad Soyad">
                                </div>
                                
                                <div class="odeme-form-group">
                                    <label>Kart Numarası</label>
                                    <input type="text" name="card_number" placeholder="0000 0000 0000 0000" maxlength="19">
                                </div>
                                
                                <div class="odeme-form-row">
                                    <div class="odeme-form-group">
                                        <label>Son Kullanma Tarihi</label>
                                        <input type="text" name="card_expiry" placeholder="AA/YY" maxlength="5">
                                    </div>
                                    <div class="odeme-form-group">
                                        <label>CVV</label>
                                        <input type="text" name="card_cvv" placeholder="000" maxlength="3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Installment -->
                        <div class="odeme-form-section">
                            <div class="odeme-form-group">
                                <label>Taksit Seçeneği</label>
                                <select name="installment">
                                    <option value="1">Peşin</option>
                                    <option value="2">2 Taksit (%5 artırımlı)</option>
                                    <option value="3">3 Taksit (%8 artırımlı)</option>
                                    <option value="6">6 Taksit (%12 artırımlı)</option>
                                    <option value="9">9 Taksit (%15 artırımlı)</option>
                                    <option value="12">12 Taksit (%18 artırımlı)</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Terms -->
                        <div class="odeme-terms">
                            <label class="odeme-checkbox">
                                <input type="checkbox" name="terms" required>
                                <span><a href="<?php echo esc_url(home_url('/kullanim-sartlari')); ?>" target="_blank">Kullanım şartları</a> ve <a href="<?php echo esc_url(home_url('/gizlilik')); ?>" target="_blank">gizlilik politikası</a>'nı kabul ediyorum.</span>
                            </label>
                            
                            <label class="odeme-checkbox">
                                <input type="checkbox" name="newsletter">
                                <span>Kampanyalardan haberdar olmak istiyorum.</span>
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-accent btn-lg w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                <line x1="1" y1="10" x2="23" y2="10"></line>
                            </svg>
                            Ödemeyi Tamamla
                        </button>
                        
                        <p class="odeme-secure">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            256-bit SSL güvenlik sertifikası ile korunmaktadır.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
