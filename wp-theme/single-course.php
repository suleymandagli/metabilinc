<?php
/**
 * Tek Kurs Şablonu
 * 
 * @package Metabilinc
 */

get_header();

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

if (!$course_enrolled) $course_enrolled = rand(100, 5000);
?>

<div class="course-detail-section">
    <div class="container">
        <!-- Breadcrumb -->
        <nav class="breadcrumb" style="margin-bottom: 2rem;">
            <a href="<?php echo esc_url(home_url('/')); ?>">Ana Sayfa</a>
            <span style="margin: 0 0.5rem;">›</span>
            <a href="<?php echo esc_url(home_url('/kurslar')); ?>">Kurslar</a>
            <span style="margin: 0 0.5rem;">›</span>
            <span><?php the_title(); ?></span>
        </nav>
        
        <div class="course-detail-grid">
            <!-- Sol İçerik -->
            <div class="course-detail-content">
                <!-- Başlık -->
                <h1><?php the_title(); ?></h1>
                
                <!-- Meta -->
                <div class="course-meta" style="margin-bottom: 2rem;">
                    <span class="course-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <?php echo esc_html($course_duration ? $course_duration : '8 Hafta'); ?>
                    </span>
                    <span class="course-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                        </svg>
                        <?php echo number_format($course_enrolled); ?> Kayıtlı
                    </span>
                    <span class="course-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <?php echo esc_html(ucfirst($course_level ? $course_level : 'Başlangıç')); ?>
                    </span>
                </div>
                
                <!-- Thumbnail -->
                <?php if (has_post_thumbnail()) : ?>
                    <div style="margin-bottom: 2rem; border-radius: 1rem; overflow: hidden;">
                        <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto;')); ?>
                    </div>
                <?php endif; ?>
                
                <!-- İçerik -->
                <?php the_content(); ?>
                
                <!-- Paylaş Bölümü -->
                <div class="course-share-section" style="margin-top: 3rem; padding: 2rem; background: var(--color-secondary-light); border-radius: 1rem;">
                    <h3 style="margin-bottom: 1rem;"><?php esc_html_e('Bu Kursu Paylaş', 'metabilinc'); ?></h3>
                    
                    <!-- Paylaş Butonları -->
                    <div class="share-buttons" style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <!-- WhatsApp -->
                        <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" 
                           target="_blank" 
                           class="btn btn-secondary share-btn share-whatsapp"
                           data-platform="whatsapp"
                           aria-label="WhatsApp'ta paylaş">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                            </svg>
                            WhatsApp
                        </a>
                        
                        <!-- Twitter/X -->
                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo urlencode(get_permalink()); ?>" 
                           target="_blank" 
                           class="btn btn-secondary share-btn share-twitter"
                           data-platform="twitter"
                           aria-label="Twitter'da paylaş">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                            </svg>
                            Twitter
                        </a>
                        
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                           target="_blank" 
                           class="btn btn-secondary share-btn share-facebook"
                           data-platform="facebook"
                           aria-label="Facebook'ta paylaş">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                            Facebook
                        </a>
                        
                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                           target="_blank" 
                           class="btn btn-secondary share-btn share-linkedin"
                           data-platform="linkedin"
                           aria-label="LinkedIn'de paylaş">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                            LinkedIn
                        </a>
                        
                        <!-- Instagram Story için kopyalama -->
                        <button type="button" 
                                class="btn btn-secondary share-btn share-instagram"
                                data-platform="instagram"
                                onclick="metabilincShareCard('<?php echo esc_js(get_the_title()); ?>', '<?php echo esc_js(get_the_excerpt()); ?>', '<?php echo esc_url(get_permalink()); ?>')"
                                aria-label="Instagram'da paylaş">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                            Instagram
                        </button>
                        
                        <!-- Link Kopyala -->
                        <button type="button" 
                                class="btn btn-secondary share-btn share-copy"
                                data-platform="copy"
                                onclick="metabilincCopyLink('<?php echo esc_js(get_permalink()); ?>')"
                                aria-label="Linki kopyala">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                            </svg>
                            Linki Kopyala
                        </button>
                    </div>
                    
                    <!-- Paylaşım Kartı Önizleme (Gizli - Modal için) -->
                    <div id="share-card-preview" style="display: none; margin-top: 1.5rem; padding: 1rem; background: white; border-radius: 0.5rem;">
                        <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-bottom: 0.5rem;">
                            Instagram Story boyutunda paylaşım kartı:
                        </p>
                        <div id="share-card-canvas" style="width: 320px; height: 568px; background: linear-gradient(135deg, #1F2937 0%, #F97316 100%); border-radius: 0.75rem; padding: 1.5rem; display: flex; flex-direction: column; justify-content: space-between; color: white;">
                            <!-- Logo -->
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div style="width: 32px; height: 32px; background: rgba(255,255,255,0.2); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                    </svg>
                                </div>
                                <span style="font-weight: 600;">Metabilinç Akademi</span>
                            </div>
                            
                            <!-- İçerik -->
                            <div>
                                <h4 id="share-card-title" style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; line-height: 1.2;"></h4>
                                <p id="share-card-desc" style="font-size: 0.875rem; opacity: 0.9; margin-bottom: 1rem;"></p>
                                <div style="font-size: 0.75rem; opacity: 0.8;">
                                    👨‍👩‍👧‍👦 <?php echo number_format($course_enrolled); ?>+ kayıtlı
                                </div>
                            </div>
                            
                            <!-- Footer -->
                            <div>
                                <div style="font-size: 0.75rem; opacity: 0.7;">
                                    👆 Kursu keşfetmek için tıkla
                                </div>
                            </div>
                        </div>
                        <p style="font-size: 0.75rem; color: var(--color-text-muted); margin-top: 0.5rem;">
                            Bu görseli kaydedip Instagram Story'de paylaşabilirsiniz.
                        </p>
                    </div>
                </div>
                
                <!-- Hediye Et Bölümü -->
                <div class="course-gift-section" style="margin-top: 2rem; padding: 2rem; background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-accent) 100%); border-radius: 1rem; color: white;">
                    <h3 style="margin-bottom: 1rem; color: white;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 0.5rem;">
                            <path d="M20 12v10H4V12"></path>
                            <path d="M2 7h20v5H2z"></path>
                            <path d="M12 22V7"></path>
                            <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                            <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                        </svg>
                        Bu Kursu Hediye Et
                    </h3>
                    <p style="margin-bottom: 1.5rem; opacity: 0.9;">
                        Sevdiklerinize bu kursu hediye edin. Satın aldıktan sonra alıcının e-posta adresini girerek 
                        kurs erişim bağlantısı oluşturabilirsiniz.
                    </p>
                    
                    <form id="gift-form" class="gift-form" style="display: grid; gap: 1rem;">
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Alıcının Adı</label>
                            <input type="text" name="gift_name" placeholder="Alıcının adı" required 
                                   style="width: 100%; padding: 0.75rem 1rem; border: none; border-radius: 0.5rem; font-size: 1rem;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Alıcının E-posta</label>
                            <input type="email" name="gift_email" placeholder="alici@email.com" required 
                                   style="width: 100%; padding: 0.75rem 1rem; border: none; border-radius: 0.5rem; font-size: 1rem;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Hediye Mesajı (Opsiyonel)</label>
                            <textarea name="gift_message" placeholder="Bir mesaj yazın..." rows="3" 
                                      style="width: 100%; padding: 0.75rem 1rem; border: none; border-radius: 0.5rem; font-size: 1rem; resize: vertical;"></textarea>
                        </div>
                        <button type="submit" class="btn" style="background: white; color: var(--color-primary); font-weight: 600;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            Hediye Bağlantısı Oluştur
                        </button>
                    </form>
                    
                    <!-- Hediye Bağlantısı Sonucu -->
                    <div id="gift-result" style="display: none; margin-top: 1.5rem; padding: 1rem; background: rgba(255,255,255,0.1); border-radius: 0.5rem;">
                        <p style="margin-bottom: 0.5rem; font-weight: 500;">Hediye bağlantısı oluşturuldu!</p>
                        <p style="font-size: 0.875rem; opacity: 0.8; margin-bottom: 1rem;">
                            Aşağıdaki bağlantıyı kopyalayıp <?php the_title(); ?> kursuna erişim için <?php echo isset($_POST['gift_name']) ? $_POST['gift_name'] : 'alıcıya'; ?> gönderebilirsiniz.
                        </p>
                        <div style="display: flex; gap: 0.5rem;">
                            <input type="text" id="gift-link" readonly 
                                   style="flex: 1; padding: 0.5rem; border: none; border-radius: 0.25rem; font-size: 0.875rem; background: white; color: var(--color-text);">
                            <button type="button" onclick="metabilincCopyLink(document.getElementById('gift-link').value)" 
                                    class="btn btn-secondary" style="padding: 0.5rem 1rem;">
                                Kopyala
                            </button>
                        </div>
                        <button type="button" onclick="metabilincShareGiftLink()" 
                                style="margin-top: 1rem; background: transparent; border: 1px solid white; color: white; padding: 0.5rem 1rem; border-radius: 0.25rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="18" cy="5" r="3"></circle>
                                <circle cx="6" cy="12" r="3"></circle>
                                <circle cx="18" cy="19" r="3"></circle>
                                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                            </svg>
                            WhatsApp ile Gönder
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Sağ Sidebar -->
            <div class="course-detail-sidebar">
                <div class="course-purchase-card">
                    <!-- Fiyat -->
                    <div class="course-purchase-price">
                        <?php if ($course_is_free === '1') : ?>
                            <span class="course-purchase-current" style="color: var(--color-success);">Ücretsiz</span>
                        <?php else : ?>
                            <?php if ($has_discount) : ?>
                                <span class="course-purchase-original"><?php echo number_format($course_price, 0, ',', '.'); ?> TL</span>
                            <?php endif; ?>
                            <span class="course-purchase-current">
                                <?php echo number_format($final_price, 0, ',', '.'); ?> TL
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Özellikler -->
                    <ul class="course-purchase-features">
                        <li class="course-purchase-feature">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-success)" stroke-width="2" class="course-purchase-feature-icon">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <?php echo esc_html($course_duration ? $course_duration : '8 Hafta'); ?> Eğitim İçeriği
                        </li>
                        <li class="course-purchase-feature">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-success)" stroke-width="2" class="course-purchase-feature-icon">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Sınırsız Erişim
                        </li>
                        <li class="course-purchase-feature">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-success)" stroke-width="2" class="course-purchase-feature-icon">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Sertifika
                        </li>
                        <li class="course-purchase-feature">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-success)" stroke-width="2" class="course-purchase-feature-icon">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Canlı Soru-Cevap
                        </li>
                        <li class="course-purchase-feature">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-success)" stroke-width="2" class="course-purchase-feature-icon">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            7/24 Destek
                        </li>
                    </ul>
                    
                    <!-- Satın Al Butonu -->
                    <?php if ($course_is_free === '1') : ?>
                        <a href="<?php echo esc_url(home_url('/kurs/' . get_post_field('post_name'))); ?>" class="btn btn-accent btn-lg" style="width: 100%; justify-content: center;">
                            Kursa Başla
                        </a>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/odeme/' . get_post_field('post_name'))); ?>" class="btn btn-accent btn-lg" style="width: 100%; justify-content: center;">
                            Hemen Satın Al
                        </a>
                    <?php endif; ?>
                    
                    <!-- Para İadesi -->
                    <p style="text-align: center; font-size: 0.875rem; color: var(--color-text-muted); margin-top: 1rem;">
                        30 gün para iadesi garantisi
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
