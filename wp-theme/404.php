<?php
/**
 * 404 Hata Sayfası Şablonu
 * 
 * @package Metabilinc
 */

get_header();
?>

<!-- 404 Hero -->
<section class="error-404">
    <div class="container">
        <div class="error-404-content">
            <!-- Error Number -->
            <div class="error-404-number">
                404
            </div>
            
            <!-- Title -->
            <h1>Sayfa Bulunamadı</h1>
            
            <!-- Description -->
            <p class="error-404-description">
                Aradığınız sayfa taşınmış, silinmiş veya hiç var olmamış olabilir. 
                Ana sayfaya dönerek aradığınızı bulabilirsiniz.
            </p>
            
            <!-- Search Form -->
            <div class="error-404-search">
                <form role="search" method="get" class="error-404-search-form" action="<?php echo home_url('/'); ?>">
                    <input type="search" placeholder="Ara..." value="<?php echo get_search_query(); ?>" name="s" class="error-404-search-input" />
                    <button type="submit" class="error-404-search-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </button>
                </form>
            </div>
            
            <!-- Quick Links -->
            <div class="error-404-links">
                <h3>Popüler Sayfalar</h3>
                <div class="error-404-links-grid">
                    <a href="<?php echo esc_url(home_url('/kurslar')); ?>" class="error-404-link-card">
                        <div class="error-404-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </div>
                        <span>Kurslar</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog')); ?>" class="error-404-link-card">
                        <div class="error-404-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v1m2 13a2 2 0 0 1-2-2V7m2 13a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <span>Blog</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/hakkimizda')); ?>" class="error-404-link-card">
                        <div class="error-404-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            </svg>
                        </div>
                        <span>Hakkımızda</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/iletisim')); ?>" class="error-404-link-card">
                        <div class="error-404-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </div>
                        <span>İletişim</span>
                    </a>
                </div>
            </div>
            
            <!-- Back Home Button -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="error-404-home-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                Ana Sayfaya Dön
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
