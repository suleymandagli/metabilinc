<?php
/**
 * Template Name: Bilinçli Aile Okulu
 * 
 * @package Metabilinc
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero-section family-school-hero">
    <div class="container">
        <div class="hero-content">
            <span class="hero-badge">Bilinçli Aile Okulu</span>
            <h1>Çocuklarınızı Bilinçli Büyütün</h1>
            <p>Aile içi iletişimden çocuk gelişimine, her konuda uzman eğitimlerle ailenizi güçlendirin.</p>
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
            <p>Bilinçli Aile Okulu programlarımız</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3>Aile İletişimi</h3>
                <p>Aile içi sağlıklı iletişim kurmanın püf noktalarını öğrenin.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                </div>
                <h3>Çocuk Gelişimi</h3>
                <p>Her yaşta çocuğunuzun gelişimini destekleyin.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                        <line x1="9" y1="9" x2="9.01" y2="9"></line>
                        <line x1="15" y1="9" x2="15.01" y2="9"></line>
                    </svg>
                </div>
                <h3>Duygusal Zeka</h3>
                <p>Çocuğunuzun duygusal gelişimini destekleyin.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3>Güvenli Bağlanma</h3>
                <p>Çocuğunuzla sağlıklı bağ kurmanın yollarını keşfedin.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </div>
                <h3>Disiplin Yöntemleri</h3>
                <p>Etkili ve sağlıklı disiplin tekniklerini öğrenin.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg>
                </div>
                <h3>Ekran Süresi Yönetimi</h3>
                <p>Çocuğunuzun ekran kullanımını sağlıklı yönetin.</p>
            </div>
        </div>
    </div>
</section>

<!-- Courses Section -->
<section class="courses-section" id="kurslar">
    <div class="container">
        <div class="section-header">
            <h2>Aile Eğitim Programları</h2>
            <p>Uzman pedagog ve psikologlardan alanında uzman eğitimler</p>
        </div>
        
        <div class="courses-grid">
            <?php
            // Query courses from category "aile"
            $courses_args = array(
                'post_type' => 'course',
                'posts_per_page' => 6,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'course_category',
                        'field' => 'slug',
                        'terms' => 'aile'
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
                // Fallback: Show all courses if none in category
                $all_courses = array(
                    array('title' => 'Bilinçli Ebeveynlik Kursu', 'price' => '₺2.999', 'category' => 'Aile'),
                    array('title' => 'Çocuk Gelişimi Sertifika Programı', 'price' => '₺4.999', 'category' => 'Aile'),
                    array('title' => 'Ergenlik Dönemi Eğitimi', 'price' => '₺1.999', 'category' => 'Aile'),
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

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ailenizin Geleceğini Şimdi Şekillendirin</h2>
            <p>Bilinçli bir ebeveyn olmak için ilk adımı atın. Uzman eğitmenlerimizle tanışın.</p>
            <a href="/iletisim" class="btn btn-primary btn-large">Ücretsiz Danışmanlık Al</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
