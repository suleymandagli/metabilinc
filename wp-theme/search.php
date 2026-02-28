<?php
/**
 * Arama Sonuçları Şablonu
 * 
 * @package Metabilinc
 */

get_header();
?>

<!-- Search Hero -->
<section class="search-hero">
    <div class="container">
        <div class="search-hero-content">
            <h1>Arama Sonuçları</h1>
            <p>"<?php echo get_search_query(); ?>" için bulunan sonuçlar</p>
        </div>
    </div>
</section>

<!-- Search Results -->
<section class="search-section">
    <div class="container">
        <?php if (have_posts()) : ?>
            <!-- Results Count -->
            <div class="search-results-count">
                <span><?php echo $wp_query->found_posts; ?></span> sonuç bulundu
            </div>
            
            <!-- Results Grid -->
            <div class="search-results-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="search-result-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="search-result-image">
                                <?php the_post_thumbnail('medium', array('style' => 'width: 100%; height: 180px; object-fit: cover; border-radius: 0.75rem;')); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>" class="search-result-image search-result-image-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                </svg>
                            </a>
                        <?php endif; ?>
                        
                        <div class="search-result-content">
                            <!-- Category -->
                            <?php 
                            $categories = get_the_category();
                            if (!empty($categories)) :
                                $category = $categories[0];
                            ?>
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="search-result-category">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            <?php endif; ?>
                            
                            <!-- Title -->
                            <h2 class="search-result-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <!-- Excerpt -->
                            <p class="search-result-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
                            </p>
                            
                            <!-- Meta -->
                            <div class="search-result-meta">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <?php echo get_the_date('d F Y'); ?>
                                </span>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <!-- Pagination -->
            <div class="search-pagination">
                <?php 
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '← Önceki',
                    'next_text' => 'Sonraki →',
                    'class' => 'search-pagination-list',
                ));
                ?>
            </div>
            
        <?php else : ?>
            <!-- No Results -->
            <div class="search-no-results">
                <div class="search-no-results-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                        <path d="M8 8l6 6"></path>
                        <path d="M14 8l-6 6"></path>
                    </svg>
                </div>
                <h2>Sonuç Bulunamadı</h2>
                <p>"<?php echo get_search_query(); ?>" için hiçbir sonuç bulunamadı.</p>
                <p>Farklı anahtar kelimeler deneyebilir veya ana sayfaya dönebilirsiniz.</p>
                
                <!-- Search Again -->
                <div class="search-again">
                    <form role="search" method="get" class="search-again-form" action="<?php echo home_url('/'); ?>">
                        <input type="search" placeholder="Başka bir şey ara..." value="<?php echo get_search_query(); ?>" name="s" class="search-again-input" />
                        <button type="submit" class="search-again-btn">Ara</button>
                    </form>
                </div>
                
                <a href="<?php echo esc_url(home_url('/')); ?>" class="search-home-btn">
                    Ana Sayfaya Dön
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
