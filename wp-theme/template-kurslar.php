<?php
/**
 * Template Name: Kurslar
 * 
 * @package Metabilinc
 */

get_header();
?>

<!-- Hero Section -->
<section class="courses-hero">
    <div class="container">
        <div class="courses-hero-content">
            <span class="courses-hero-badge">Eğitim Programlarımız</span>
            <h1>Kurslarımız</h1>
            <p>Uzman eğitmenler tarafından hazırlanan kapsamlı programlarla ailenizi güçlendirin.</p>
        </div>
    </div>
</section>

<!-- Filters -->
<section class="courses-filters">
    <div class="container">
        <div class="courses-filters-wrapper">
            <div class="courses-search">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" placeholder="Kurs ara..." class="courses-search-input" id="course-search">
            </div>
            
            <div class="courses-filter-group">
                <select class="courses-filter-select" id="category-filter">
                    <option value="">Tüm Kategoriler</option>
                    <option value="aile">Aile Eğitimleri</option>
                    <option value="evlilik">Evlilik Kursları</option>
                    <option value="mini-kurs">Mini Kurslar</option>
                </select>
                
                <select class="courses-filter-select" id="level-filter">
                    <option value="">Tüm Seviyeler</option>
                    <option value="baslangic">Başlangıç</option>
                    <option value="orta">Orta</option>
                    <option value="ileri">İleri</option>
                </select>
                
                <select class="courses-filter-select" id="price-filter">
                    <option value="">Fiyat</option>
                    <option value="ucretsiz">Ücretsiz</option>
                    <option value="ucretli">Ücretli</option>
                </select>
            </div>
        </div>
    </div>
</section>

<!-- Courses Grid -->
<section class="courses-section">
    <div class="container">
        <div class="courses-results">
            <p><strong>6</strong> kurs bulundu</p>
        </div>
        
        <div class="courses-grid" id="courses-grid">
            <!-- Course 1 -->
            <article class="course-card" data-category="aile" data-level="baslangic" data-price="ucretli">
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
                    <p class="course-card-description">0-18 yaş çocuklarınızla daha sağlıklı iletişim kurun. Etkili disiplin, duygusal bağ ve pozitif ebeveynlik tekniklerini öğrenin.</p>
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
                    <div class="course-card-stats">
                        <span class="course-card-stat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                            </svg>
                            5.234
                        </span>
                        <span class="course-card-stat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            4.9
                        </span>
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
            <article class="course-card" data-category="evlilik" data-level="baslangic" data-price="ucretli">
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
                    <div class="course-card-stats">
                        <span class="course-card-stat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                            </svg>
                            3.156
                        </span>
                        <span class="course-card-stat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            4.8
                        </span>
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

            <!-- Course 3 - Free -->
            <article class="course-card course-card-free" data-category="mini-kurs" data-level="baslangic" data-price="ucretsiz">
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
                    <div class="course-card-stats">
                        <span class="course-card-stat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                            </svg>
                            12.500
                        </span>
                        <span class="course-card-stat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            4.9
                        </span>
                    </div>
                    <div class="course-card-footer">
                        <div class="course-card-price">
                            <span class="course-card-price-current">Ücretsiz</span>
                        </div>
                        <a href="<?php echo esc_url(home_url('/kurs/cocuklarla-etkili-iletisim')); ?>" class="btn btn-accent">Hemen Başla</a>
                    </div>
                </div>
            </article>

            <!-- Course 4 -->
            <article class="course-card" data-category="aile" data-level="orta" data-price="ucretli">
                <div class="course-card-image">
                    <div class="course-card-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                    </div>
                </div>
                <div class="course-card-content">
                    <span class="course-card-category">Aile Eğitimi</span>
                    <h3 class="course-card-title">Ergenlik Döneminde İletişim</h3>
                    <p class="course-card-description">Ergen çocuğunuzla sağlıklı iletişim kurun. Bu zorlu dönemi birlikte atlatın.</p>
                    <div class="course-card-meta">
                        <span class="course-card-duration">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            4 Hafta
                        </span>
                        <span class="course-card-level">Orta</span>
                    </div>
                    <div class="course-card-stats">
                        <span class="course-card-stat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                            </svg>
                            2.156
                        </span>
                        <span class="course-card-stat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            4.7
                        </span>
                    </div>
                    <div class="course-card-footer">
                        <div class="course-card-price">
                            <span class="course-card-price-original">₺497</span>
                            <span class="course-card-price-current">₺247</span>
                        </div>
                        <a href="<?php echo esc_url(home_url('/kurs/ergenlik-donemi-iletisim')); ?>" class="btn btn-primary">İncele</a>
                    </div>
                </div>
            </article>

            <!-- Course 5 -->
            <article class="course-card" data-category="evlilik" data-level="baslangic" data-price="ucretli">
                <div class="course-card-image">
                    <div class="course-card-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                </div>
                <div class="course-card-content">
                    <span class="course-card-category">Evlilik</span>
                    <h3 class="course-card-title">Evliliğe Hazırlık Kursu</h3>
                    <p class="course-card-description">Evlilik öncesi çiftler için kapsamlı hazırlık programı. Sağlıklı bir evliliğin temellerini atın.</p>
                    <div class="course-card-meta">
                        <span class="course-card-duration">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            5 Hafta
                        </span>
                        <span class="course-card-level">Başlangıç</span>
                    </div>
                    <div class="course-card-stats">
                        <span class="course-card-stat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                            </svg>
                            1.567
                        </span>
                        <span class="course-card-stat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            4.8
                        </span>
                    </div>
                    <div class="course-card-footer">
                        <div class="course-card-price">
                            <span class="course-card-price-original">₺997</span>
                            <span class="course-card-price-current">₺497</span>
                        </div>
                        <a href="<?php echo esc_url(home_url('/kurs/evlilik-hazirlik')); ?>" class="btn btn-primary">İncele</a>
                    </div>
                </div>
            </article>

            <!-- Course 6 -->
            <article class="course-card" data-category="aile" data-level="baslangic" data-price="ucretli">
                <div class="course-card-image">
                    <div class="course-card-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                </div>
                <div class="course-card-content">
                    <span class="course-card-category">Aile Eğitimi</span>
                    <h3 class="course-card-title">Çocuklarda Özgüven Gelişimi</h3>
                    <p class="course-card-description">Çocuğunuzun özgüvenini geliştirin. Başarılı ve mutlu bir birey olmasına yardımcı olun.</p>
                    <div class="course-card-meta">
                        <span class="course-card-duration">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            3 Hafta
                        </span>
                        <span class="course-card-level">Başlangıç</span>
                    </div>
                    <div class="course-card-stats">
                        <span class="course-card-stat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                            </svg>
                            3.421
                        </span>
                        <span class="course-card-stat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            4.9
                        </span>
                    </div>
                    <div class="course-card-footer">
                        <div class="course-card-price">
                            <span class="course-card-price-original">₺747</span>
                            <span class="course-card-price-current">₺397</span>
                        </div>
                        <a href="<?php echo esc_url(home_url('/kurs/cocuklarda-ozguven')); ?>" class="btn btn-primary">İncele</a>
                    </div>
                </div>
            </article>
        </div>

        <!-- No Results -->
        <div class="courses-no-results" style="display: none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <h3>Kurs Bulunamadı</h3>
            <p>Arama kriterlerinize uygun kurs bulunmuyor. Farklı kriterler denemeyi deneyin.</p>
            <button class="btn btn-primary" onclick="resetFilters()">Filtreleri Sıfırla</button>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="courses-cta">
    <div class="container">
        <div class="courses-cta-content">
            <h2>Hangi Kursu Seçeceğinizi Bilmiyor musunuz?</h2>
            <p>Ücretsiz mini kurslarımızla başlayarak hangi alanda ilerlemek istediğinizi keşfedin.</p>
            <div class="courses-cta-buttons">
                <a href="<?php echo esc_url(home_url('/mini-kurs')); ?>" class="btn btn-primary">
                    Ücretsiz Mini Kursları İncele
                </a>
                <a href="<?php echo esc_url(home_url('/sss')); ?>" class="btn btn-outline">
                    SSS
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
