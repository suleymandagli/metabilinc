<?php
/**
 * Footer Şablonu
 * 
 * @package Metabilinc
 */
?>
    </main><!-- #primary -->
    
    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <!-- Brand Column -->
                <div class="footer-brand">
                    <div class="footer-logo">
                        <div class="footer-logo-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </div>
                        <span class="footer-logo-text">
                            <?php bloginfo('name'); ?>
                        </span>
                    </div>
                    <p class="footer-description">
                        <?php bloginfo('description'); ?>
                    </p>
                    <div class="footer-social">
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="footer-social-link" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="footer-social-link" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="footer-social-link" aria-label="YouTube">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                            </svg>
                        </a>
                        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="footer-social-link" aria-label="Twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Kurslar -->
                <div class="footer-column">
                    <h4 class="footer-column-title"><?php esc_html_e('Kurslar', 'metabilinc'); ?></h4>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-courses',
                        'container'      => false,
                        'menu_class'     => 'footer-menu',
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ));
                    
                    // Varsayılan kurs bağlantıları
                    if (!has_nav_menu('footer')) {
                        echo '<ul class="footer-menu">';
                        echo '<li class="footer-menu-item"><a href="' . esc_url(home_url('/kurslar')) . '" class="footer-menu-link">' . __('Tüm Kurslar', 'metabilinc') . '</a></li>';
                        echo '<li class="footer-menu-item"><a href="' . esc_url(home_url('/kurs/bilincli-aile-okulu')) . '" class="footer-menu-link">' . __('Bilinçli Aile Okulu', 'metabilinc') . '</a></li>';
                        echo '<li class="footer-menu-item"><a href="' . esc_url(home_url('/kurs/bilincli-evlilik-akademisi')) . '" class="footer-menu-link">' . __('Bilinci Evlilik Akademisi', 'metabilinc') . '</a></li>';
                        echo '<li class="footer-menu-item"><a href="' . esc_url(home_url('/mini-kurs')) . '" class="footer-menu-link">' . __('Ücretsiz Mini Kurs', 'metabilinc') . '</a></li>';
                        echo '</ul>';
                    }
                    ?>
                </div>
                
                <!-- Kurumsal -->
                <div class="footer-column">
                    <h4 class="footer-column-title"><?php esc_html_e('Kurumsal', 'metabilinc'); ?></h4>
                    <ul class="footer-menu">
                        <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/hakkimizda')); ?>" class="footer-menu-link"><?php esc_html_e('Hakkımızda', 'metabilinc'); ?></a></li>
                        <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/egitmenler')); ?>" class="footer-menu-link"><?php esc_html_e('Eğitmenler', 'metabilinc'); ?></a></li>
                        <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/iletisim')); ?>" class="footer-menu-link"><?php esc_html_e('İletişim', 'metabilinc'); ?></a></li>
                        <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/blog')); ?>" class="footer-menu-link"><?php esc_html_e('Blog', 'metabilinc'); ?></a></li>
                    </ul>
                </div>
                
                <!-- Destek -->
                <div class="footer-column">
                    <h4 class="footer-column-title"><?php esc_html_e('Destek', 'metabilinc'); ?></h4>
                    <ul class="footer-menu">
                        <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/sss')); ?>" class="footer-menu-link"><?php esc_html_e('Sıkça Sorulan Sorular', 'metabilinc'); ?></a></li>
                        <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/gizlilik')); ?>" class="footer-menu-link"><?php esc_html_e('Gizlilik Politikası', 'metabilinc'); ?></a></li>
                        <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/kullanim-sartlari')); ?>" class="footer-menu-link"><?php esc_html_e('Kullanım Şartları', 'metabilinc'); ?></a></li>
                        <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/iade')); ?>" class="footer-menu-link"><?php esc_html_e('İade Politikası', 'metabilinc'); ?></a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p class="footer-copyright">
                    © <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('Tüm hakları saklıdır.', 'metabilinc'); ?>
                </p>
                <div class="footer-legal">
                    <a href="<?php echo esc_url(home_url('/gizlilik')); ?>" class="footer-legal-link"><?php esc_html_e('Gizlilik', 'metabilinc'); ?></a>
                    <a href="<?php echo esc_url(home_url('/kullanim-sartlari')); ?>" class="footer-legal-link"><?php esc_html_e('Şartlar', 'metabilinc'); ?></a>
                    <a href="<?php echo esc_url(home_url('/kvkk')); ?>" class="footer-legal-link"><?php esc_html_e('KVKK', 'metabilinc'); ?></a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay"></div>
    
    <!-- Mobile Menu -->
    <div class="mobile-menu">
        <button class="mobile-menu-close" aria-label="<?php esc_attr_e('Menüyü kapat', 'metabilinc'); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_id'        => 'mobile-menu',
            'container'      => false,
            'menu_class'     => 'mobile-nav-menu',
            'fallback_cb'    => false,
            'walker'         => new Metabilinc_Walker_Nav_Menu(),
            'depth'          => 3,
        ));
        ?>
    </div>

<?php wp_footer(); ?>

</div><!-- #page -->

</body>
</html>
