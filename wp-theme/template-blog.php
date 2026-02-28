<?php
/**
 * Template Name: Blog
 * 
 * @package Metabilinc
 */

get_header();
?>

<!-- Blog Hero -->
<section class="blog-hero">
    <div class="container">
        <div class="blog-hero-content">
            <span class="blog-hero-badge">Blog</span>
            <h1>Anne Baba <span class="text-accent">Blog</span></h1>
            <p>Çocuk yetiştirme, eğitim ve aile içi iletişim hakkında uzman makaleleri ve güncel yazılar.</p>
        </div>
    </div>
</section>

<!-- Blog Grid -->
<section class="blog-section">
    <div class="container">
        <div class="blog-grid">
            <?php
            // Blog yazıları (varsayılan veriler - WordPress veritabanından çekilebilir)
            $blog_posts = array(
                array(
                    'slug' => "cocuklarda-ogrenme-motivasyonu",
                    'title' => "Çocuklarda Öğrenme Motivasyonunu Artırma",
                    'excerpt' => "Çocuğunuzun öğrenme motivasyonunu nasıl artırabileceğinizi keşfedin. Etkili stratejiler ve ipuçları...",
                    'date' => "15 Şubat 2026",
                    'category' => "Eğitim",
                    'readTime' => "5 dk okuma",
                ),
                array(
                    'slug' => "aile-iletisimi",
                    'title' => "Etkili Aile İletişimi Nasıl Kurulur?",
                    'excerpt' => "Aile içi iletişimi güçlendirmek için kanıtlanmış teknikler ve stratejiler.",
                    'date' => "10 Şubat 2026",
                    'category' => "İletişim",
                    'readTime' => "7 dk okuma",
                ),
                array(
                    'slug' => "ergenlik-donemi",
                    'title' => "Ergenlik Dönemini Anlamak",
                    'excerpt' => "Ergenlik dönemindeki çocuğunuzla sağlıklı bir ilişki kurmanın yolları.",
                    'date' => "5 Şubat 2026",
                    'category' => "Gelişim",
                    'readTime' => "8 dk okuma",
                ),
                array(
                    'slug' => "teknoloji-ve-cocuklar",
                    'title' => "Çocuklarda Teknoloji Kullanımı",
                    'excerpt' => "Dijital çağda çocuğunuzun teknoloji kullanımını nasıl yönetebilirsiniz?",
                    'date' => "1 Şubat 2026",
                    'category' => "Teknoloji",
                    'readTime' => "6 dk okuma",
                ),
                array(
                    'slug' => "sorumluluk-egitimi",
                    'title' => "Çocuklara Sorumluluk Öğretme",
                    'excerpt' => "Çocuklarınıza yaşına uygun sorumluluklar vermek ve öz disiplin geliştirmelerini sağlamak.",
                    'date' => "28 Ocak 2026",
                    'category' => "Eğitim",
                    'readTime' => "5 dk okuma",
                ),
                array(
                    'slug' => "basari-icin-aile-destegi",
                    'title' => "Çocuğunuzun Başarısı İçin Aile Desteği",
                    'excerpt' => "Çocuğunuzun akademik ve kişisel başarısında ailenin rolü ve etkili destek yöntemleri.",
                    'date' => "25 Ocak 2026",
                    'category' => "Başarı",
                    'readTime' => "6 dk okuma",
                ),
            );
            
            foreach ($blog_posts as $post) :
            ?>
                <article class="blog-card">
                    <!-- Image Placeholder -->
                    <div class="blog-card-image">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v1m2 13a2 2 0 0 1-2-2V7m2 13a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>

                    <!-- Content -->
                    <div class="blog-card-content">
                        <div class="blog-card-meta">
                            <span class="blog-card-category"><?php echo $post['category']; ?></span>
                            <span class="blog-card-readtime"><?php echo $post['readTime']; ?></span>
                        </div>
                        <h2 class="blog-card-title">
                            <a href="<?php echo esc_url(home_url('/blog/' . $post['slug'])); ?>"><?php echo $post['title']; ?></a>
                        </h2>
                        <p class="blog-card-excerpt"><?php echo $post['excerpt']; ?></p>
                        <div class="blog-card-date">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <?php echo $post['date']; ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <!-- Newsletter CTA -->
        <div class="blog-newsletter">
            <h2>Güncel Yazılardan Haberdar Olun</h2>
            <p>Blog yazılarımızdan haberdar olmak için e-posta listemize kaydolun.</p>
            <form class="blog-newsletter-form">
                <input type="email" placeholder="E-posta adresiniz" required>
                <button type="submit" class="btn btn-accent">Abone Ol</button>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>
