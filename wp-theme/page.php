<?php
/**
 * Sayfa Şablonu
 * 
 * @package Metabilinc
 */

get_header();
?>

<div class="page-header">
    <div class="container">
        <h1 class="page-title"><?php the_title(); ?></h1>
    </div>
</div>

<section class="course-list-section">
    <div class="container">
        <div class="entry-content">
            <?php
            while (have_posts()) : the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
