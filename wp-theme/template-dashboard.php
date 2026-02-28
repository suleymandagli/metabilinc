<?php
/**
 * Template Name: Dashboard
 * 
 * @package Metabilinc
 */

get_header();
?>

<!-- Dashboard Hero -->
<section class="dashboard-hero">
    <div class="container">
        <div class="dashboard-hero-content">
            <h1>Hoş Geldiniz, <span class="text-accent">Öğrenci!</span></h1>
            <p>Eğitim yolculuğunuzda size yardımcı olmak için buradayız.</p>
        </div>
    </div>
</section>

<!-- Dashboard Section -->
<section class="dashboard-section">
    <div class="container">
        <!-- Dashboard Stats -->
        <div class="dashboard-stats">
            <div class="dashboard-stat">
                <div class="dashboard-stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                </div>
                <div class="dashboard-stat-info">
                    <span class="dashboard-stat-number">3</span>
                    <span class="dashboard-stat-label">Kayıtlı Kurs</span>
                </div>
            </div>
            
            <div class="dashboard-stat">
                <div class="dashboard-stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="8" r="7"></circle>
                        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                    </svg>
                </div>
                <div class="dashboard-stat-info">
                    <span class="dashboard-stat-number">2</span>
                    <span class="dashboard-stat-label">Sertifika</span>
                </div>
            </div>
            
            <div class="dashboard-stat">
                <div class="dashboard-stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <div class="dashboard-stat-info">
                    <span class="dashboard-stat-number">24</span>
                    <span class="dashboard-stat-label">Saat Eğitim</span>
                </div>
            </div>
            
            <div class="dashboard-stat">
                <div class="dashboard-stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <div class="dashboard-stat-info">
                    <span class="dashboard-stat-number">%85</span>
                    <span class="dashboard-stat-label">Tamamlandı</span>
                </div>
            </div>
        </div>

        <!-- My Courses -->
        <div class="dashboard-courses">
            <div class="dashboard-header">
                <h2>Kurslarım</h2>
                <a href="<?php echo esc_url(home_url('/kurslar')); ?>" class="btn btn-outline">
                    Yeni Kurs Keşfet
                </a>
            </div>
            
            <div class="dashboard-courses-grid">
                <!-- Course 1 -->
                <div class="dashboard-course-card">
                    <div class="dashboard-course-progress" style="--progress: 85%;"></div>
                    <div class="dashboard-course-content">
                        <div class="dashboard-course-header">
                            <span class="dashboard-course-badge">Aktif</span>
                            <span class="dashboard-course-progress-text">%85 Tamamlandı</span>
                        </div>
                        <h3>Bilinçli Aile Okulu</h3>
                        <p>0-18 yaş çocuklarınızla daha sağlıklı iletişim kurun.</p>
                        
                        <div class="dashboard-course-meta">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                6/8 Hafta
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                                42 Ders
                            </span>
                        </div>
                        
                        <a href="#" class="btn btn-primary w-full">Kursa Devam Et</a>
                    </div>
                </div>
                
                <!-- Course 2 -->
                <div class="dashboard-course-card">
                    <div class="dashboard-course-progress" style="--progress: 100%;"></div>
                    <div class="dashboard-course-content">
                        <div class="dashboard-course-header">
                            <span class="dashboard-course-badge dashboard-course-badge-complete">Tamamlandı</span>
                            <span class="dashboard-course-progress-text">%100</span>
                        </div>
                        <h3>Çocuklarla Etkili İletişim</h3>
                        <p>Çocuğunuzun duygularını anlayın ve onunla daha iyi bir bağ kurun.</p>
                        
                        <div class="dashboard-course-meta">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                2 Saat
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                                8 Ders
                            </span>
                        </div>
                        
                        <a href="#" class="btn btn-outline w-full">Sertifikayı Görüntüle</a>
                    </div>
                </div>
                
                <!-- Course 3 -->
                <div class="dashboard-course-card">
                    <div class="dashboard-course-progress" style="--progress: 30%;"></div>
                    <div class="dashboard-course-content">
                        <div class="dashboard-course-header">
                            <span class="dashboard-course-badge">Aktif</span>
                            <span class="dashboard-course-progress-text">%30 Tamamlandı</span>
                        </div>
                        <h3>Bilinci Evlilik Akademisi</h3>
                        <p>Evliliğinizdeki iletişimi güçlendirin ve daha mutlu bir evlilik.</p>
                        
                        <div class="dashboard-course-meta">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                2/6 Hafta
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                                14 Ders
                            </span>
                        </div>
                        
                        <a href="#" class="btn btn-primary w-full">Kursa Devam Et</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="dashboard-actions">
            <h2>Hızlı İşlemler</h2>
            <div class="dashboard-actions-grid">
                <a href="<?php echo esc_url(home_url('/profil')); ?>" class="dashboard-action-card">
                    <div class="dashboard-action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <h3>Profilimi Düzenle</h3>
                    <p>Kişisel bilgilerinizi güncelleyin</p>
                </a>
                
                <a href="<?php echo esc_url(home_url('/sertifikalar')); ?>" class="dashboard-action-card">
                    <div class="dashboard-action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="8" r="7"></circle>
                            <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                        </svg>
                    </div>
                    <h3>Sertifikalarım</h3>
                    <p>Kazandığınız sertifikaları görüntüleyin</p>
                </a>
                
                <a href="<?php echo esc_url(home_url('/destek')); ?>" class="dashboard-action-card">
                    <div class="dashboard-action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </div>
                    <h3>Destek</h3>
                    <p>Sorularınız için bizimle iletişime geçin</p>
                </a>
                
                <a href="<?php echo esc_url(home_url('/odeme')); ?>" class="dashboard-action-card">
                    <div class="dashboard-action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                        </svg>
                    </div>
                    <h3>Ödeme Geçmişi</h3>
                    <p>Satın alma geçmişinizi görüntüleyin</p>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
