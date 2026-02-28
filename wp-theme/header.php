<?php
/**
 * Header Şablonu
 * 
 * @package Metabilinc
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('İçeriğe atla', 'metabilinc'); ?></a>
    
    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-inner">
                <!-- Logo -->
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                    <div class="logo-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                    </div>
                    <span class="logo-text">
                        <?php 
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                            bloginfo('name');
                        }
                        ?>
                    </span>
                </a>
                
                <!-- Desktop Navigation -->
                <nav id="site-navigation" class="main-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'nav-menu',
                        'fallback_cb'    => false,
                        'walker'         => new Metabilinc_Walker_Nav_Menu(),
                        'depth'          => 3,
                    ));
                    ?>
                </nav>
                
                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" aria-label="<?php esc_attr_e('Menüyü aç', 'metabilinc'); ?>" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>
    
    <main id="primary" class="site-main">
