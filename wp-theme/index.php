<?php
/**
 * Ana Şablon Dosyası
 * 
 * @package Metabilinc
 */

get_header();
?>

<?php if (is_front_page()) : ?>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background"></div>
        <div class="hero-blob-1"></div>
        <div class="hero-blob-2"></div>
        
        <div class="container">
            <div class="hero-content">
                <!-- Sol İçerik -->
                <div class="hero-text">
                    <div class="hero-badge">
                        <span class="hero-badge-dot"></span>
                        <span class="hero-badge-text">📚 Yeni dönem kayıtları başladı</span>
                    </div>
                    
                    <h1 class="hero-title">
                        Bilinçli Anne Baba 
                        <span class="hero-title-gradient">Olma Yolculuğunuz</span> Burada Başlıyor
                    </h1>
                    
                    <p class="hero-description">
                        Çocuğunuzla daha sağlıklı iletişim kurun, aile içi 
                        ilişkilerinizi güçlendirin ve hayatınızı dönüştürün.
                    </p>
                    
                    <div class="hero-buttons">
                        <a href="<?php echo esc_url(home_url('/kurslar')); ?>" class="btn btn-primary btn-lg">
                            Kursları Keşfet
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                        <a href="<?php echo esc_url(home_url('/mini-kurs')); ?>" class="btn btn-secondary btn-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="5 3 19 12 5 21 5 3"></polygon>
                            </svg>
                            Ücretsiz Demo
                        </a>
                    </div>
                    
                    <!-- İstatistikler -->
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <div class="hero-stat-number">5000+</div>
                            <div class="hero-stat-label">Aile</div>
                        </div>
                        <div class="hero-stat">
                            <div class="hero-stat-number">50+</div>
                            <div class="hero-stat-label">Eğitim</div>
                        </div>
                        <div class="hero-stat">
                            <div class="hero-stat-number">4.9</div>
                            <div class="hero-stat-label">Puan</div>
                        </div>
                    </div>
                </div>
                
                <!-- Sağ Görsel -->
                <div class="hero-visual">
                    <div class="hero-card">
                        <div class="hero-card-header">
                            <div class="hero-card-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="hero-card-title">Bilinçli Aile Okulu</div>
                                <div class="hero-card-subtitle">8 Hafta • 5234 Kayıtlı</div>
                            </div>
                        </div>
                        <div class="hero-card-image">👨‍👩‍👧</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Courses Section -->
    <section class="courses-section">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="section-badge-icon">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <span class="section-badge-text">Öne Çıkan Kurslar</span>
                </div>
                <h2 class="section-title">Hayatınızı <span class="hero-title-gradient">Dönüştürecek</span> Eğitimler</h2>
                <p class="section-subtitle">Uzman eğitmenler tarafından hazırlanan, binlerce aile tarafından beğenilen kurslarımızı keşfedin.</p>
            </div>
            
            <div class="courses-grid">
                <?php
                // Öne çıkan kursları getir
                $courses_query = new WP_Query(array(
                    'post_type'      => 'course',
                    'posts_per_page' => 6,
                    'post_status'   => 'publish',
                    'orderby'       => 'date',
                    'order'         => 'DESC',
                ));
                
                if ($courses_query->have_posts()) :
                    while ($courses_query->have_posts()) : $courses_query->the_post();
                        get_template_part('template-parts/content', 'course-card');
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Varsayılan kurslar (demo veri)
                    $courses = array(
                        array(
                            'title' => 'Bilinçli Aile Okulu',
                            'slug' => 'bilincli-aile-okulu',
                            'description' => '0-18 yaş çocuklarınızla daha sağlıklı iletişim kurun. Etkili disiplin, duygusal bağ ve pozitif ebeveynlik tekniklerini öğrenin.',
                            'price' => 1997,
                            'discounted_price' => 997,
                            'duration' => '8 Hafta',
                            'enrolled' => 5234,
                            'level' => 'Başlangıç',
                            'is_free' => false,
                            'category' => 'Aile',
                        ),
                        array(
                            'title' => 'Bilinci Evlilik Akademisi',
                            'slug' => 'bilincli-evlilik-akademisi',
                            'description' => 'Evliliğinizdeki iletişimi güçlendirin, çatışmaları yapıcı çözün ve daha mutlu bir evlilik için gereken becerileri kazanın.',
                            'price' => 1497,
                            'discounted_price' => 747,
                            'duration' => '6 Hafta',
                            'enrolled' => 3156,
                            'level' => 'Başlangıç',
                            'is_free' => false,
                            'category' => 'Evlilik',
                        ),
                        array(
                            'title' => 'Çocuklarla Etkili İletişim',
                            'slug' => 'cocuklarla-etkili-iletisim',
                            'description' => 'Çocuğunuzun duygularını anlayın ve onunla daha iyi bir bağ kurun. Kanıtlanmış iletişim teknikleri.',
                            'price' => 0,
                            'discounted_price' => 0,
                            'duration' => '2 Saat',
                            'enrolled' => 12500,
                            'level' => 'Başlangıç',
                            'is_free' => true,
                            'category' => 'Aile',
                        ),
                    );
                    
                    foreach ($courses as $course) {
                        $final_price = $course['discounted_price'] ? $course['discounted_price'] : $course['price'];
                        $has_discount = $course['discounted_price'] && $course['discounted_price'] < $course['price'];
                        $discount_percent = $has_discount ? round((1 - $course['discounted_price'] / $course['price']) * 100) : 0;
                        ?>
                        <article class="course-card">
                            <div class="course-thumbnail">
                                <span style="font-size: 4rem;">📚</span>
                                <?php if ($course['is_free']) : ?>
                                    <span class="course-badge course-badge-free">Ücretsiz</span>
                                <?php elseif ($has_discount) : ?>
                                    <span class="course-badge course-badge-premium">%<?php echo $discount_percent; ?> İndirim</span>
                                <?php endif; ?>
                            </div>
                            <div class="course-content">
                                <div class="course-category"><?php echo $course['category']; ?></div>
                                <h3 class="course-title">
                                    <a href="<?php echo esc_url(home_url('/kurs/' . $course['slug'])); ?>"><?php echo $course['title']; ?></a>
                                </h3>
                                <p class="course-description"><?php echo $course['description']; ?></p>
                                <div class="course-meta">
                                    <span class="course-meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                        <?php echo $course['duration']; ?>
                                    </span>
                                    <span class="course-meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                                        <?php echo number_format($course['enrolled']); ?>
                                    </span>
                                </div>
                                <div class="course-footer">
                                    <div class="course-price">
                                        <?php if ($course['is_free']) : ?>
                                            <span class="course-price-free">Ücretsiz</span>
                                        <?php else : ?>
                                            <?php if ($has_discount) : ?>
                                                <span class="course-price-original"><?php echo number_format($course['price'], 0, ',', '.'); ?> TL</span>
                                            <?php endif; ?>
                                            <span class="course-price-current"><?php echo number_format($final_price, 0, ',', '.'); ?> TL</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="course-rating">
                                        <span class="course-rating-stars">★★★★★</span>
                                        <span class="course-rating-value">4.9</span>
                                    </div>
                                </div>
                                <a href="<?php echo esc_url(home_url('/kurs/' . $course['slug'])); ?>" class="course-link">
                                    Kursu İncele
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                </a>
                            </div>
                        </article>
                        <?php
                    }
                endif;
                ?>
            </div>
            
            <div class="text-center mt-8">
                <a href="<?php echo esc_url(home_url('/kurslar')); ?>" class="btn btn-outline btn-lg">
                    Tüm Kursları Gör
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="section-badge-icon">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <span class="section-badge-text">Başarı Hikayeleri</span>
                </div>
                <h2 class="section-title">Binlerce Ailenin <span class="hero-title-gradient">Dönüşümü</span></h2>
            </div>
            
            <div class="testimonials-grid">
                <!-- Yorum 1 -->
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">👩‍👦</div>
                        <div>
                            <div class="testimonial-author">Ayşe Y.</div>
                            <div class="testimonial-role">Bilinçli Aile Okulu Mezunu</div>
                        </div>
                    </div>
                    <div class="testimonial-rating">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    </div>
                    <p class="testimonial-content">Çocuğumla ilişkim tamamen değişti. Artık onu dinlemeyi ve anlamayı öğrendim. Tartışmalar yerine konuşuyoruz. Bu kurs hayatımızı kurtardı!</p>
                </div>
                
                <!-- Yorum 2 -->
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">👨‍👩‍👧</div>
                        <div>
                            <div class="testimonial-author">Mehmet K.</div>
                            <div class="testimonial-role">Bilinci Evlilik Akademisi Mezunu</div>
                        </div>
                    </div>
                    <div class="testimonial-rating">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    </div>
                    <p class="testimonial-content">Evliliğimizdeki iletişim sorunları çözüldü. Eşimle artık daha açık konuşabiliyoruz. Birbirimizi daha iyi anlıyoruz. Kesinlikle tavsiye ederim.</p>
                </div>
                
                <!-- Yorum 3 -->
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">👩‍👧‍👦</div>
                        <div>
                            <div class="testimonial-author">Zeynep T.</div>
                            <div class="testimonial-role">Ebeveyn</div>
                        </div>
                    </div>
                    <div class="testimonial-rating">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    </div>
                    <p class="testimonial-content">Ücretsiz mini kursla başladım, sonra tam kursa geçtim. Her kuruşuna değen bir yatırım. Çocuklarım artık bana güveniyor ve açıkça konuşuyor.</p>
                </div>
                
                <!-- Yorum 4 -->
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">👨</div>
                        <div>
                            <div class="testimonial-author">Ahmet M.</div>
                            <div class="testimonial-role">Baba</div>
                        </div>
                    </div>
                    <div class="testimonial-rating">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F59E0B" stroke="#F59E0B" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    </div>
                    <p class="testimonial-content">İş yoğunluğundan dolayı aileme yeterli zaman ayıramıyordum. Bu kurs bana zaman yönetimini ve kaliteli zaman geçirmeyi öğretti.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Lead Capture Section -->
    <section class="lead-capture-section">
        <div class="lead-capture-pattern"></div>
        
        <div class="container">
            <div class="lead-capture-content">
                <div class="lead-capture-text">
                    <div class="lead-capture-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                        <span>Ücretsiz E-kitap</span>
                    </div>
                    
                    <h2 class="lead-capture-title">"Bilinçli Anne Baba Olmanın 7 Sırrı"</h2>
                    
                    <p class="lead-capture-description">
                        Çocuğunuzla daha güçlü bir bağ kurmanızı sağlayacak, 
                        deneyimli uzmanlar tarafından hazırlanan ücretsiz e-kitabımızı 
                        hemen indirin.
                    </p>
                    
                    <ul class="lead-capture-list">
                        <li class="lead-capture-list-item">
                            <span class="lead-capture-list-icon">✓</span>
                            Çocuklarla etkili iletişim teknikleri
                        </li>
                        <li class="lead-capture-list-item">
                            <span class="lead-capture-list-icon">✓</span>
                            Tartışmaları çözüme kavuşturma yöntemleri
                        </li>
                        <li class="lead-capture-list-item">
                            <span class="lead-capture-list-icon">✓</span>
                            Pozitif disiplin stratejileri
                        </li>
                        <li class="lead-capture-list-item">
                            <span class="lead-capture-list-icon">✓</span>
                            Duygusal bağ kurmanın püf noktaları
                        </li>
                    </ul>
                </div>
                
                <div class="lead-capture-form-wrapper">
                    <form class="lead-capture-form" id="lead-capture-form">
                        <h3 class="lead-capture-form-title">Hemen İndirin</h3>
                        
                        <div class="lead-capture-form-group">
                            <label for="lead-name" class="lead-capture-form-label">Adınız</label>
                            <input type="text" id="lead-name" name="name" class="lead-capture-form-input" placeholder="Adınızı girin" required>
                        </div>
                        
                        <div class="lead-capture-form-group">
                            <label for="lead-email" class="lead-capture-form-label">E-posta Adresiniz</label>
                            <input type="email" id="lead-email" name="email" class="lead-capture-form-input" placeholder="ornek@email.com" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg lead-capture-form-submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            Ücretsiz İndir
                        </button>
                        
                        <p class="text-center mt-4" style="font-size: 0.875rem; color: var(--color-text-muted);">
                            Verileriniz asla paylaşılmaz.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php else : ?>
    <!-- Standart Blog/Archive Sayfası -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title">
                <?php
                if (is_category()) {
                    single_cat_title();
                } elseif (is_tag()) {
                    single_tag_title();
                } elseif (is_search()) {
                    printf(__('Arama Sonuçları: %s', 'metabilinc'), get_search_query());
                } elseif (is_archive()) {
                    if (is_post_type_archive('course')) {
                        echo __('Kurslar', 'metabilinc');
                    } else {
                        the_archive_title();
                    }
                } else {
                    the_title();
                }
                ?>
            </h1>
            
            <?php if (is_archive() && !is_post_type_archive('course')) : ?>
                <p class="page-description"><?php the_archive_description(); ?></p>
            <?php elseif (is_search()) : ?>
                <p class="page-description"><?php printf(__('%s sonucu bulundu', 'metabilinc'), $wp_query->found_posts); ?></p>
            <?php endif; ?>
        </div>
    </div>
    
    <section class="course-list-section">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="course-list-grid">
                    <?php
                    while (have_posts()) : the_post();
                        get_template_part('template-parts/content', get_post_type());
                    endwhile;
                    ?>
                </div>
                
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('&laquo; Önceki', 'metabilinc'),
                    'next_text' => __('Sonraki &raquo;', 'metabilinc'),
                ));
                ?>
                
            <?php else : ?>
                <div class="text-center">
                    <p><?php esc_html_e('Henüz içerik bulunmuyor.', 'metabilinc'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
