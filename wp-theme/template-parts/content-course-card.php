<?php
/**
 * Kurs Kartı Şablon Parçası
 * 
 * @package Metabilinc
 */

$course_id = get_the_ID();
$course_price = get_post_meta($course_id, '_course_price', true);
$course_discounted_price = get_post_meta($course_id, '_course_discounted_price', true);
$course_duration = get_post_meta($course_id, '_course_duration', true);
$course_level = get_post_meta($course_id, '_course_level', true);
$course_enrolled = get_post_meta($course_id, '_course_enrolled', true);
$course_is_free = get_post_meta($course_id, '_course_is_free', true);

// Fiyat hesaplamaları
$final_price = $course_discounted_price ? $course_discounted_price : $course_price;
$has_discount = $course_discounted_price && $course_discounted_price < $course_price;
$discount_percent = $has_discount ? round((1 - $course_discounted_price / $course_price) * 100) : 0;

// Varsayılan değerler
if (!$course_enrolled) $course_enrolled = rand(100, 5000);
if (!$course_duration) $course_duration = '8 Hafta';
?>

<article class="course-card">
    <!-- Thumbnail -->
    <div class="course-thumbnail">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('metabilinc-course-thumb', array('alt' => get_the_title())); ?>
        <?php else : ?>
            <span style="font-size: 4rem;">📚</span>
        <?php endif; ?>
        
        <?php if ($course_is_free === '1') : ?>
            <span class="course-badge course-badge-free">Ücretsiz</span>
        <?php elseif ($has_discount) : ?>
            <span class="course-badge course-badge-premium">%<?php echo esc_html($discount_percent); ?> İndirim</span>
        <?php endif; ?>
    </div>
    
    <!-- İçerik -->
    <div class="course-content">
        <!-- Kategori -->
        <?php
        $terms = get_the_terms($course_id, 'course_category');
        if ($terms && !is_wp_error($terms)) :
            $term = reset($terms);
        ?>
            <div class="course-category"><?php echo esc_html($term->name); ?></div>
        <?php endif; ?>
        
        <!-- Başlık -->
        <h3 class="course-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        
        <!-- Açıklama -->
        <p class="course-description">
            <?php echo metabilinc_get_course_excerpt($course_id, 20); ?>
        </p>
        
        <!-- Meta -->
        <div class="course-meta">
            <span class="course-meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <?php echo esc_html($course_duration); ?>
            </span>
            <span class="course-meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <?php echo number_format($course_enrolled); ?>
            </span>
        </div>
        
        <!-- Footer -->
        <div class="course-footer">
            <div class="course-price">
                <?php if ($course_is_free === '1') : ?>
                    <span class="course-price-free">Ücretsiz</span>
                <?php else : ?>
                    <?php if ($has_discount) : ?>
                        <span class="course-price-original"><?php echo number_format($course_price, 0, ',', '.'); ?> TL</span>
                    <?php endif; ?>
                    <span class="course-price-current">
                        <?php echo number_format($final_price, 0, ',', '.'); ?> TL
                    </span>
                <?php endif; ?>
            </div>
            
            <div class="course-rating">
                <span class="course-rating-stars">★★★★★</span>
                <span class="course-rating-value">4.9</span>
                <span class="course-rating-count">(<?php echo rand(100, 900); ?>)</span>
            </div>
        </div>
        
        <!-- Link -->
        <a href="<?php the_permalink(); ?>" class="course-link">
            <?php esc_html_e('Kursu İncele', 'metabilinc'); ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </a>
    </div>
</article>
