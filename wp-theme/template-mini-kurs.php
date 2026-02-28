<?php
/**
 * Template Name: Mini Kurs
 * 
 * @package Metabilinc
 */

get_header();
?>

<!-- Mini Kurs Hero -->
<section class="minikurs-hero">
    <div class="container">
        <div class="minikurs-hero-content">
            <div class="minikurs-hero-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                </svg>
                <span>Ücretsiz Mini Kurslar</span>
            </div>
            <h1>Bilinçli Ebeveynliğe <span class="text-accent">İlk Adımınızı</span> Atın</h1>
            <p>Ücretsiz mini kurslarımızla ebeveynlik yolculuğunuzda ilk adımları atın. Hemen başlayın, ailenizi dönüştürün.</p>
        </div>
    </div>
</section>

<!-- Mini Kurs Section -->
<section class="minikurs-section">
    <div class="container">
        <div class="minikurs-grid">
            <!-- Course Selection -->
            <div class="minikurs-list">
                <h2>Mini Kurslar</h2>
                <div class="minikurs-course-list">
                    
                    <?php
                    $mini_courses = array(
                        array(
                            'id' => 1,
                            'slug' => "cocuklarla-etkili-iletisim",
                            'title' => "Çocuklarla Etkili İletişim",
                            'description' => "Çocuğunuzun duygularını anlayın ve onunla daha iyi bir bağ kurun.",
                            'duration' => "2 Saat",
                            'lessons' => 8,
                            'category' => "aile",
                        ),
                        array(
                            'id' => 2,
                            'slug' => "pozitif-disiplin",
                            'title' => "Pozitif Disiplin Rehberi",
                            'description' => "Ceza yerine etkili disiplin yöntemlerini öğrenin.",
                            'duration' => "1.5 Saat",
                            'lessons' => 6,
                            'category' => "aile",
                        ),
                        array(
                            'id' => 3,
                            'slug' => "evlilik-iletisimi",
                            'title' => "Evlilikte Sağlıklı İletişim",
                            'description' => "Eşinizle daha açık ve etkili iletişim kurun.",
                            'duration' => "2 Saat",
                            'lessons' => 7,
                            'category' => "evlilik",
                        ),
                    );
                    
                    $selected_course = $mini_courses[0];
                    ?>
                    
                    <?php foreach ($mini_courses as $course) : ?>
                        <button class="minikurs-course-btn <?php echo ($course['id'] === $selected_course['id']) ? 'active' : ''; ?>" data-course-id="<?php echo $course['id']; ?>">
                            <div class="minikurs-course-btn-content">
                                <h3><?php echo $course['title']; ?></h3>
                                <p><?php echo $course['description']; ?></p>
                            </div>
                            <div class="minikurs-course-btn-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                            </div>
                            <div class="minikurs-course-btn-meta">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <?php echo $course['duration']; ?>
                                </span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                    </svg>
                                    <?php echo $course['lessons']; ?> ders
                                </span>
                            </div>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="minikurs-form-wrapper">
                <div class="minikurs-form-card">
                    <!-- Course Preview -->
                    <div class="minikurs-form-header">
                        <h3><?php echo $selected_course['title']; ?></h3>
                        <p><?php echo $selected_course['description']; ?></p>
                        <div class="minikurs-form-meta">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <?php echo $selected_course['duration']; ?>
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                </svg>
                                <?php echo $selected_course['lessons']; ?> Ders
                            </span>
                        </div>
                    </div>

                    <!-- Form -->
                    <div class="minikurs-form-body">
                        <div class="minikurs-form-title">
                            <h4>Ücretsiz Kaydol</h4>
                            <p>Bu mini kursa hemen erişin</p>
                        </div>

                        <form class="minikurs-form" id="minikurs-form">
                            <div class="form-group">
                                <label>Adınız</label>
                                <input type="text" name="name" placeholder="Adınızı girin" required>
                            </div>

                            <div class="form-group">
                                <label>E-posta Adresiniz</label>
                                <input type="email" name="email" placeholder="email@ornek.com" required>
                            </div>

                            <div class="form-group">
                                <label>Telefon (İsteğe Bağlı)</label>
                                <input type="tel" name="phone" placeholder="+90 5XX XXX XX XX">
                            </div>

                            <button type="submit" class="btn btn-primary w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                                Hemen Başla
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>

                            <p class="form-note">Kayıt olarak gizlilik politikamızı kabul etmiş olursunuz.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Proof -->
        <div class="minikurs-stats">
            <div class="minikurs-stats-grid">
                <div class="minikurs-stat">
                    <div class="minikurs-stat-number">12.500+</div>
                    <div class="minikurs-stat-label">Kayıtlı Öğrenci</div>
                </div>
                <div class="minikurs-stat">
                    <div class="minikurs-stat-number">4.9</div>
                    <div class="minikurs-stat-label">Ortalama Puan</div>
                </div>
                <div class="minikurs-stat">
                    <div class="minikurs-stat-number">%95</div>
                    <div class="minikurs-stat-label">Memnuniyet Oranı</div>
                </div>
            </div>
        </div>

        <!-- What's Included -->
        <div class="minikurs-included">
            <h2>Neler Dahil?</h2>
            <div class="minikurs-included-grid">
                <div class="minikurs-included-item">
                    <div class="minikurs-included-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="23 7 16 12 23 17 23 7"></polygon>
                            <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                        </svg>
                    </div>
                    <h3>Video İçerikler</h3>
                    <p>Uzman eğitmen videoları</p>
                </div>
                
                <div class="minikurs-included-item">
                    <div class="minikurs-included-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                    </div>
                    <h3>Materyaller</h3>
                    <p>İndirilebilir kaynaklar</p>
                </div>
                
                <div class="minikurs-included-item">
                    <div class="minikurs-included-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="7"></circle>
                            <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                        </svg>
                    </div>
                    <h3>Sertifika</h3>
                    <p>Kurs tamamlama belgesi</p>
                </div>
                
                <div class="minikurs-included-item">
                    <div class="minikurs-included-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </div>
                    <h3>Destek</h3>
                    <p>Soru-cevap imkanı</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
