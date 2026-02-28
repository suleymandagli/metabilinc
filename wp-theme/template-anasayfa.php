<?php
/**
 * Template Name: Ana Sayfa
 * 
 * @package Metabilinc
 */

get_header();
?>

<!-- Hero Section -->
<section class="home-hero">
    <div class="container">
        <div class="home-hero-content">
            <span class="home-hero-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                Türkiye'nin #1 Aile Eğitim Platformu
            </span>
            <h1>Bilinçli Ebeveynlik Yolculuğunuza <span class="text-accent">Bugün Başlayın</span></h1>
            <p>Çocuğunuzla daha sağlıklı bir iletişim kurun, aile içi ilişkilerinizi güçlendirin ve mutlu bir aile ortamı oluşturun.</p>
            <div class="home-hero-buttons">
                <a href="<?php echo esc_url(home_url('/kurslar')); ?>" class="btn btn-primary btn-lg">
                    Kursları Keşfet
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="<?php echo esc_url(home_url('/mini-kurs')); ?>" class="btn btn-outline btn-lg">
                    Ücretsiz Mini Kurs
                </a>
            </div>
            <div class="home-hero-stats">
                <div class="home-hero-stat">
                    <span class="home-hero-stat-number">50.000+</span>
                    <span class="home-hero-stat-label">Mutlu Aile</span>
                </div>
                <div class="home-hero-stat">
                    <span class="home-hero-stat-number">100+</span>
                    <span class="home-hero-stat-label">Video Ders</span>
                </div>
                <div class="home-hero-stat">
                    <span class="home-hero-stat-number">4.9</span>
                    <span class="home-hero-stat-label">Ortalama Puan</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Courses -->
<section class="home-courses">
    <div class="container">
        <div class="home-section-header">
            <span class="home-section-badge">Öne Çıkan Kurslar</span>
            <h2>Size Uygun Kursu Bulun</h2>
            <p>Uzman eğitmenlerimiz tarafından hazırlanan kapsamlı programlarımızla ailenizi güçlendirin.</p>
        </div>
        
        <div class="home-courses-grid">
            <!-- Course 1 -->
            <article class="course-card">
                <div class="course-card-badge">En Çok Satan</div>
                <div class="course-card-image">
                    <div class="course-card-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                </div>
                <div class="course-card-content">
                    <span class="course-card-category">Aile Eğitimi</span>
                    <h3 class="course-card-title">Bilinçli Aile Okulu</h3>
                    <p class="course-card-description">0-18 yaş çocuklarınızla daha sağlıklı iletişim kurun. Etkili disiplin ve pozitif ebeveynlik tekniklerini öğrenin.</p>
                    <div class="course-card-meta">
                        <span class="course-card-duration">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            8 Hafta
                        </span>
                        <span class="course-card-level">Başlangıç</span>
                    </div>
                    <div class="course-card-footer">
                        <div class="course-card-price">
                            <span class="course-card-price-original">₺1.997</span>
                            <span class="course-card-price-current">₺997</span>
                        </div>
                        <a href="<?php echo esc_url(home_url('/kurs/bilincli-aile-okulu')); ?>" class="btn btn-primary">İncele</a>
                    </div>
                </div>
            </article>

            <!-- Course 2 -->
            <article class="course-card">
                <div class="course-card-image">
                    <div class="course-card-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </div>
                </div>
                <div class="course-card-content">
                    <span class="course-card-category">Evlilik</span>
                    <h3 class="course-card-title">Bilinci Evlilik Akademisi</h3>
                    <p class="course-card-description">Evliliğinizdeki iletişimi güçlendirin, çatışmaları yapıcı çözün ve daha mutlu bir evlilik için gereken becerileri kazanın.</p>
                    <div class="course-card-meta">
                        <span class="course-card-duration">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            6 Hafta
                        </span>
                        <span class="course-card-level">Başlangıç</span>
                    </div>
                    <div class="course-card-footer">
                        <div class="course-card-price">
                            <span class="course-card-price-original">₺1.497</span>
                            <span class="course-card-price-current">₺747</span>
                        </div>
                        <a href="<?php echo esc_url(home_url('/kurs/bilincli-evlilik-akademisi')); ?>" class="btn btn-primary">İncele</a>
                    </div>
                </div>
            </article>

            <!-- Course 3 -->
            <article class="course-card course-card-free">
                <div class="course-card-badge course-card-badge-free">Ücretsiz</div>
                <div class="course-card-image">
                    <div class="course-card-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                    </div>
                </div>
                <div class="course-card-content">
                    <span class="course-card-category">Mini Kurs</span>
                    <h3 class="course-card-title">Çocuklarla Etkili İletişim</h3>
                    <p class="course-card-description">Çocuğunuzun duygularını anlayın ve onunla daha iyi bir bağ kurun. Kanıtlanmış iletişim tekniklerini öğrenin.</p>
                    <div class="course-card-meta">
                        <span class="course-card-duration">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            2 Saat
                        </span>
                        <span class="course-card-level">Başlangıç</span>
                    </div>
                    <div class="course-card-footer">
                        <div class="course-card-price">
                            <span class="course-card-price-current">Ücretsiz</span>
                        </div>
                        <a href="<?php echo esc_url(home_url('/kurs/cocuklarla-etkili-iletisim')); ?>" class="btn btn-accent">Hemen Başla</a>
                    </div>
                </div>
            </article>
        </div>

        <div class="home-courses-cta">
            <a href="<?php echo esc_url(home_url('/kurslar')); ?>" class="btn btn-outline">
                Tüm Kursları Görüntüle
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="home-features">
    <div class="container">
        <div class="home-section-header">
            <span class="home-section-badge">Neden Metabilinc?</span>
            <h2>Sizin İçin Neler Sunuyoruz?</h2>
            <p>Ailenizi güçlendirmek için ihtiyacınız olan her şey tek bir platformda.</p>
        </div>

        <div class="home-features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                        <polyline points="2 17 12 22 22 17"></polyline>
                        <polyline points="2 12 12 17 22 12"></polyline>
                    </svg>
                </div>
                <h3>Uzman Eğitmenler</h3>
                <p>15+ yıl deneyimli psikolog ve pedagoglardan eğitim alın.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <h3>Esnek Zamanlama</h3>
                <p>Kendi hızınızda öğrenin, istediğiniz zaman tekrar edin.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <h3>30 Gün İade Garantisi</h3>
                <p>Memnun kalmazsanız koşulsuz para iadesi garantisi.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3>Sertifika</h3>
                <p>Kursu tamamladığınızda resmi sertifika alın.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                    </svg>
                </div>
                <h3>7/24 Destek</h3>
                <p>Her zaman yanınızdayız, sorularınızı yanıtlamak için bekliyoruz.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg>
                </div>
                <h3>Her Cihazdan Erişim</h3>
                <p>Telefon, tablet veya bilgisayar - istediğiniz yerden öğrenin.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="home-testimonials">
    <div class="container">
        <div class="home-section-header">
            <span class="home-section-badge">Başarı Hikayeleri</span>
            <h2>Öğrencilerimiz Ne Diyor?</h2>
            <p>Binlerce ailenin hayatına dokunduk, sıra sizde.</p>
        </div>

        <div class="home-testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </div>
                <p class="testimonial-text">"Kurs hayatımızı değiştirdi. Artık çocuğumla tartışmak yerine konuşuyoruz. Teşekkürler Metabilinc!"</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">Z.K.</div>
                    <div>
                        <strong>Zeynep K.</strong>
                        <span>Bilinçli Aile Okulu</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </div>
                <p class="testimonial-text">"Ergen oğlumla ilişkim düzeldi. Bu kursu almadan önce çözüm bulamıyorduk. Çok teşekkür ederim."</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">M.A.</div>
                    <div>
                        <strong>Mehmet A.</strong>
                        <span>Bilinçli Aile Okulu</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </div>
                <p class="testimonial-text">"Her anne-baba bu kursu almalı. İlk çocuğumla çok zorlandım, ikincisinde çok daha bilinçliyim."</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">A.Y.</div>
                    <div>
                        <strong>Ayşe Y.</strong>
                        <span>Çocuklarla Etkili İletişim</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="home-cta">
    <div class="container">
        <div class="home-cta-content">
            <h2>Ailenizi Dönüştürmeye Hazır Mısınız?</h2>
            <p>Hemen bir kursa başlayın ve aileniz için daha iyi bir gelecek inşa edin.</p>
            <div class="home-cta-buttons">
                <a href="<?php echo esc_url(home_url('/kurslar')); ?>" class="btn btn-primary btn-lg">
                    Kursları Keşfet
                </a>
                <a href="<?php echo esc_url(home_url('/iletisim')); ?>" class="btn btn-outline btn-lg btn-light">
                    Bizimle İletişime Geçin
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
