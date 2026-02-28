<?php
/**
 * Template Name: İletişim
 * 
 * @package Metabilinc
 */

get_header();
?>

<!-- Hero Section -->
<section class="contact-hero">
    <div class="container">
        <div class="contact-hero-content">
            <h1>İletişim</h1>
            <p>
                Sorularınız mı var? Bizimle iletişime geçmekten çekinmeyin. 
                En kısa sürede size dönüş yapacağız.
            </p>
        </div>
    </div>
</section>

<!-- Contact Info & Form -->
<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info">
                <h2>Bize Ulaşın</h2>
                
                <div class="contact-info-list">
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3>Telefon</h3>
                            <a href="tel:+905551234567">+90 555 123 45 67</a>
                            <p class="contact-info-meta">Hafta içi 09:00 - 18:00</p>
                        </div>
                    </div>
                    
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h3>E-posta</h3>
                            <a href="mailto:info@metabilinc.com">info@metabilinc.com</a>
                            <p class="contact-info-meta">24 saat içinde yanıtlanır</p>
                        </div>
                    </div>
                    
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div>
                            <h3>Adres</h3>
                            <p>Çankaya, Ankara<br />Türkiye</p>
                        </div>
                    </div>
                    
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h3>Çalışma Saatleri</h3>
                            <p>
                                Pazartesi - Cuma: 09:00 - 18:00<br />
                                Cumartesi: 10:00 - 14:00<br />
                                Pazar: Kapalı
                            </p>
                        </div>
                    </div>
                </div>

                <!-- WhatsApp -->
                <div class="contact-whatsapp">
                    <div class="contact-whatsapp-inner">
                        <div class="contact-whatsapp-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3>WhatsApp</h3>
                            <a href="https://wa.me/905551234567">+90 555 123 45 67</a>
                            <p class="contact-info-meta">Hızlı yanıt için WhatsApp</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-wrapper">
                <div class="contact-form-box">
                    <h2>Mesaj Gönderin</h2>
                    
                    <form class="contact-form" id="contact-form">
                        <div class="contact-form-row">
                            <div class="contact-form-group">
                                <label for="contact-name">Adınız Soyadınız</label>
                                <input type="text" id="contact-name" name="name" placeholder="Adınızı girin" required>
                            </div>
                            <div class="contact-form-group">
                                <label for="contact-phone">Telefon Numaranız</label>
                                <input type="tel" id="contact-phone" name="phone" placeholder="05XX XXX XX XX">
                            </div>
                        </div>
                        
                        <div class="contact-form-group">
                            <label for="contact-email">E-posta Adresiniz</label>
                            <input type="email" id="contact-email" name="email" placeholder="ornek@email.com" required>
                        </div>
                        
                        <div class="contact-form-group">
                            <label for="contact-subject">Konu</label>
                            <select id="contact-subject" name="subject" required>
                                <option value="">Konu seçin</option>
                                <option value="genel">Genel Soru</option>
                                <option value="kurs">Kurs Bilgisi</option>
                                <option value="fatura">Fatura ve Ödeme</option>
                                <option value="teklif">Kurumsal Teklif</option>
                                <option value="diger">Diğer</option>
                            </select>
                        </div>
                        
                        <div class="contact-form-group">
                            <label for="contact-message">Mesajınız</label>
                            <textarea id="contact-message" name="message" rows="5" placeholder="Mesajınızı buraya yazın..." required></textarea>
                        </div>
                        
                        <div class="contact-form-checkbox">
                            <input type="checkbox" id="contact-privacy" name="privacy" required>
                            <label for="contact-privacy">
                                <a href="<?php echo esc_url(home_url('/gizlilik')); ?>" target="_blank">Gizlilik politikasını</a> okudum ve kabul ediyorum.
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                            Mesaj Gönder
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Teaser -->
<section class="contact-faq">
    <div class="container">
        <div class="contact-faq-content">
            <h2>Sıkça Sorulan Sorular</h2>
            <p>Önce SSS sayfamızı ziyaret edebilirsiniz. Belki sorunuzun cevabı orada olabilir.</p>
            <a href="<?php echo esc_url(home_url('/sss')); ?>" class="btn btn-outline">
                SSS Sayfasını Görüntüle
            </a>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="contact-map">
    <div class="container">
        <div class="contact-map-placeholder">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--color-text-muted)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
            </svg>
            <p>Harita yakında eklenecektir</p>
        </div>
    </div>
</section>

<?php get_footer(); ?>
