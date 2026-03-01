<?php
/**
 * Template Name: Kurslar
 * 
 * @package Metabilinc
 */

get_header();

// Kursları veritabanından çek
$args = array(
    'post_type' => 'course',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'menu_order date',
    'order' => 'ASC',
);

$courses_query = new WP_Query($args);
$total_courses = $courses_query->found_posts;
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

<!-- Courses Grid -->
<section class="courses-section">
    <div class="container">
        <div class="courses-results">
            <p><strong><?php echo $total_courses; ?></strong> kurs bulundu</p>
        </div>
        
        <div class="courses-grid" id="courses-grid">
            <?php if ($courses_query->have_posts()) : ?>
                <?php while ($courses_query->have_posts()) : $courses_query->the_post(); ?>
                    <?php
                    $course_id = get_the_ID();
                    $course_price = get_post_meta($course_id, '_course_price', true);
                    $course_discounted_price = get_post_meta($course_id, '_course_discounted_price', true);
                    $course_duration = get_post_meta($course_id, '_course_duration', true);
                    $course_start_date = get_post_meta($course_id, '_course_start_date', true);
                    $course_level = get_post_meta($course_id, '_course_level', true);
                    $course_enrolled = get_post_meta($course_id, '_course_enrolled', true);
                    $course_is_free = get_post_meta($course_id, '_course_is_free', true);
                    $course_is_featured = get_post_meta($course_id, '_course_is_featured', true);
                    
                    // Fiyat hesaplamaları
                    $final_price = $course_discounted_price ? $course_discounted_price : $course_price;
                    $has_discount = $course_discounted_price && $course_discounted_price < $course_price;
                    $discount_percent = $has_discount ? round((1 - $course_discounted_price / $course_price) * 100) : 0;
                    
                    // Varsayılan değerler
                    if (!$course_enrolled) $course_enrolled = rand(100, 5000);
                    if (!$course_duration) $course_duration = '8 Hafta';
                    
                    // Seviye çevirisi
                    $level_text = array(
                        'baslangic' => 'Başlangıç',
                        'orta' => 'Orta',
                        'ileri' => 'İleri',
                    );
                    $level_display = isset($level_text[$course_level]) ? $level_text[$course_level] : 'Başlangıç';
                    
                    // Kategori
                    $terms = get_the_terms($course_id, 'course_category');
                    $category_name = 'Kurs';
                    if ($terms && !is_wp_error($terms)) {
                        $category_name = $terms[0]->name;
                    }
                    ?>
                    
                    <article class="course-card" data-category="<?php echo esc_attr($course_level); ?>">
                        <?php if ($course_is_featured === '1') : ?>
                            <div class="course-card-badge">En Çok Satan</div>
                        <?php elseif ($course_is_free === '1') : ?>
                            <div class="course-card-badge course-card-badge-free">Ücretsiz</div>
                        <?php elseif ($has_discount) : ?>
                            <div class="course-card-badge">%<?php echo esc_html($discount_percent); ?> İndirim</div>
                        <?php endif; ?>
                        
                        <div class="course-card-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('metabilinc-course-thumb', array('alt' => get_the_title())); ?>
                            <?php else : ?>
                                <div class="course-card-placeholder">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="course-card-content">
                            <span class="course-card-category"><?php echo esc_html($category_name); ?></span>
                            <h3 class="course-card-title"><?php the_title(); ?></h3>
                            <p class="course-card-description"><?php echo metabilinc_get_course_excerpt($course_id, 20); ?></p>
                            
                            <div class="course-card-meta">
                                <span class="course-card-duration">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <?php echo esc_html($course_duration); ?>
                                </span>
                                <?php if ($course_start_date) : ?>
                                    <span class="course-card-start-date">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        <?php echo esc_html($course_start_date); ?>
                                    </span>
                                <?php endif; ?>
                                <span class="course-card-level"><?php echo esc_html($level_display); ?></span>
                            </div>
                            
                            <div class="course-card-stats">
                                <span class="course-card-stat">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                    </svg>
                                    <?php echo number_format($course_enrolled); ?>
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
                                    <?php if ($course_is_free === '1') : ?>
                                        <span class="course-card-price-current">Ücretsiz</span>
                                    <?php else : ?>
                                        <?php if ($has_discount) : ?>
                                            <span class="course-card-price-original">₺<?php echo number_format($course_price, 0, ',', '.'); ?></span>
                                        <?php endif; ?>
                                        <span class="course-card-price-current">₺<?php echo number_format($final_price, 0, ',', '.'); ?></span>
                                    <?php endif; ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">İncele</a>
                            </div>
                        </div>
                    </article>
                    
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                
            <?php else : ?>
                <div class="no-courses" style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                    <p>Henüz kurs bulunmuyor.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
