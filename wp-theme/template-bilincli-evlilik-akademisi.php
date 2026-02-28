<?php
/**
 * Template Name: Bilinçli Evlilik Akademisi
 * 
 * @package Metabilinc
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero-section marriage-academy-hero">
    <div class="container">
        <div class="hero-content">
            <span class="hero-badge">Bilinçli Evlilik Akademisi</span>
            <h1>Mutlu Bir Evliliğin Temelleri</h1>
            <p>Evliliğinizde iletişimi güçlendirin, bağınızı derinleştirin ve ilişkinizi bilinçli bir şekilde yönetmeyi öğrenin.</p>
            <div class="hero-buttons">
                <a href="#kurslar" class="btn btn-primary">Kursları Keşfet</a>
                <a href="/iletisim" class="btn btn-secondary">İletişime Geç</a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-header">
            <h2>Neler Öğreneceksiniz?</h2>
            <p>Bilinçli Evlilik Akademisi programlarımız</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                </div>
                <h3>Etkili İletişim</h3>
                <p>Eşinizle açık ve dürüst iletişim kurmanın yollarını öğrenin.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </div>
                <h3>Duygusal Bağ</h3>
                <p>Partnerinizle daha derin duygusal bağ kurun.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <h3>Kaliteli Zaman</h3>
                <p>Birlikte kaliteli geçirdiğiniz zamanı artırın.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>
                <h3>Güven İnşası</h3>
                <p>Evliliğinizde güveni yeniden inşa edin.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3>Çatışma Çözümü</h3>
                <p>Anlaşmazlıkları yapıcı şekilde çözümleyin.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </div>
                <h3>Romantizmi Canlı Tutun</h3>
                <p>Evliliğinizde romantizmi ve tutkuyu diri tutun.</p>
            </div>
        </div>
    </div>
</section>

<!-- Courses Section -->
<section class="courses-section" id="kurslar">
    <div class="container">
        <div class="section-header">
            <h2>Evlilik Eğitim Programları</h2>
            <p>Uzman ilişki danışmanları ve terapistlerden alanında uzman eğitimler</p>
        </div>
        
        <div class="courses-grid">
            <?php
            // Query courses from category "evlilik"
            $courses_args = array(
                'post_type' => 'course',
                'posts_per_page' => 6,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'course_category',
                        'field' => 'slug',
                        'terms' => 'evlilik'
                    )
                )
            );
            
            $courses_query = new WP_Query($courses_args);
            
            if ($courses_query->have_posts()) :
                while ($courses_query->have_posts()) : $courses_query->the_post();
                    get_template_part('template-parts/content', 'course-card');
                endwhile;
                wp_reset_postdata();
            else :
                // Fallback: Show sample courses
                $all_courses = array(
                    array('title' => 'Evlilik İletişim Kursu', 'price' => '₺2.499', 'category' => 'Evlilik'),
                    array('title' => 'Mutlu Evlilik Sırları', 'price' => '₺1.999', 'category' => 'Evlilik'),
                    array('title' => 'Evlilik Danışmanlığı Sertifika Programı', 'price' => '₺5.999', 'category' => 'Evlilik'),
                    array('title' => 'Çift Terapisi Eğitimi', 'price' => '₺4.499', 'category' => 'Evlilik'),
                );
                
                foreach ($all_courses as $course) :
                    ?>
                    <div class="course-card">
                        <div class="course-image">
                            <div class="course-category"><?php echo esc_html($course['category']); ?></div>
                        </div>
                        <div class="course-content">
                            <h3><?php echo esc_html($course['title']); ?></h3>
                            <div class="course-meta">
                                <span class="course-price"><?php echo esc_html($course['price']); ?></span>
                            </div>
                            <a href="#" class="btn btn-primary">Kursa Git</a>
                        </div>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header">
            <h2>Mutlu Çiftlerin Hikayeleri</h2>
            <p>Eğitimlerimizden sonra hayatları değişen çiftlerin deneyimleri</p>
        </div>
        
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <p>"Evlilik kursu sayesinde eşimle iletişimimiz çok daha iyi oldu. Küçük sorunları büyümeden çözebiliyoruz artık."</p>
                </div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">A</div>
                    <div class="testimonial-info">
                        <h4>Ahmet & Ayşe</h4>
                        <span>İstanbul</span>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <p>"Bilinçli Evlilik Akademisi'nde öğrendiklerimiz evliliğimizi kurtardı. Tüm çiftlere tavsiye ederim."</p>
                </div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">M</div>
                    <div class="testimonial-info">
                        <h4>Mehmet & Fatma</h4>
                        <span>Ankara</span>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <p>"Eşimle daha mutlu bir evliliğe sahip olabileceğimi hiç düşünmemiştim. Bu eğitim her kuruşuna değer."</p>
                </div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">S</div>
                    <div class="testimonial-info">
                        <h4>Serdar & Zeynep</h4>
                        <span>İzmir</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Evliliğinizi Bugün Dönüştürün</h2>
            <p>Bilinçli bir evlilik için ilk adımı atın. Uzman danışmanlarımızla tanışın.</p>
            <a href="/iletisim" class="btn btn-primary btn-large">Ücretsiz Danışmanlık Al</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
