<?php
/**
 * Kurs Arşiv Şablonu (Kurslar Listesi)
 * 
 * @package Metabilinc
 */

get_header();
?>

<div class="page-header">
    <div class="container">
        <h1 class="page-title">Kurslarımız</h1>
        <p class="page-description">Aile ve evlilik eğitiminde lider platform. Bilinçli anne-babalık ve sağlıklı evlilikler için profesyonel eğitimler sunuyoruz.</p>
    </div>
</div>

<section class="course-list-section">
    <div class="container">
        <!-- Kategori Filtreleri -->
        <?php
        $categories = get_terms(array(
            'taxonomy' => 'course_category',
            'hide_empty' => true,
        ));
        
        if (!empty($categories)) :
        ?>
            <div class="course-filters" style="margin-bottom: 2rem; display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center;">
                <a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>" 
                   class="btn <?php echo !isset($_GET['category']) ? 'btn-primary' : 'btn-secondary'; ?>">
                    Tümü
                </a>
                <?php foreach ($categories as $cat) : ?>
                    <a href="<?php echo esc_url(add_query_arg('category', $cat->slug)); ?>" 
                       class="btn <?php echo isset($_GET['category']) && $_GET['category'] === $cat->slug ? 'btn-primary' : 'btn-secondary'; ?>">
                        <?php echo esc_html($cat->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <!-- Kurslar Grid -->
        <?php
        $args = array(
            'post_type'      => 'course',
            'posts_per_page' => 12,
            'post_status'   => 'publish',
            'paged'         => get_query_var('paged') ? get_query_var('paged') : 1,
        );
        
        // Kategori filtresi
        if (isset($_GET['category'])) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'course_category',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field($_GET['category']),
                ),
            );
        }
        
        $courses_query = new WP_Query($args);
        
        if ($courses_query->have_posts()) :
        ?>
            <div class="course-list-grid">
                <?php
                while ($courses_query->have_posts()) : $courses_query->the_post();
                    get_template_part('template-parts/content', 'course-card');
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            
            <!-- Sayfalama -->
            <?php
            $total_pages = $courses_query->max_num_pages;
            if ($total_pages > 1) :
            ?>
                <div class="pagination" style="margin-top: 3rem; display: flex; justify-content: center; gap: 0.5rem;">
                    <?php
                    echo paginate_links(array(
                        'base'    => get_pagenum_link(1) . '%_%',
                        'format'  => 'page/%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total'   => $total_pages,
                        'prev_text' => '&laquo; Önceki',
                        'next_text' => 'Sonraki &raquo;',
                        'mid_size' => 2,
                    ));
                    ?>
                </div>
            <?php endif; ?>
            
        <?php else : ?>
            <div class="text-center" style="padding: 4rem 0;">
                <p style="font-size: 1.25rem; color: var(--color-text-muted);">Henüz kurs bulunmuyor.</p>
                <a href="<?php echo esc_url(home_url('/kurslar')); ?>" class="btn btn-primary mt-4">
                    Tüm Kursları Gör
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Alt CTA -->
<section class="lead-capture-section" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-accent) 100%);">
    <div class="lead-capture-pattern"></div>
    <div class="container">
        <div style="text-align: center; color: white; position: relative;">
            <h2 style="color: white; margin-bottom: 1rem;">Ücretsiz Mini Kursumuzu Deneyin</h2>
            <p style="opacity: 0.9; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                Başlamak için hiçbir şey ödemenize gerek yok. Hemen ücretsiz mini kursumuzu keşfedin.
            </p>
            <a href="<?php echo esc_url(home_url('/mini-kurs')); ?>" class="btn" style="background: white; color: var(--color-primary);">
                Ücretsiz Başla
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
