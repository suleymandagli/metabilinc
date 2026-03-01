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
                <div class="course-share-section" style="margin-top: 3rem;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; color: var(--color-text-light);">
                            Paylaş
                        </h3>
                        <button type="button"
                                onclick="metabilincShareCard('<?php echo esc_js(get_the_title()); ?>', '<?php echo esc_js(wp_strip_all_tags(get_the_excerpt())); ?>', '<?php echo esc_url(get_permalink()); ?>')"
                                style="background: transparent; border: 1px solid var(--color-accent); color: var(--color-accent); padding: 0.375rem 0.75rem; border-radius: 2rem; cursor: pointer; font-size: 0.75rem; font-weight: 500; display: flex; align-items: center; gap: 0.375rem; transition: all 0.2s ease;"
                                onmouseover="this.style.background='var(--color-accent)'; this.style.color='white';"
                                onmouseout="this.style.background='transparent'; this.style.color='var(--color-accent)';">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            Story Kartı
                        </button>
                    </div>
                    
                    <!-- Minimalist İkon-Only Paylaş Butonları -->
                    <div class="share-buttons" style="display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center;">
                        <!-- WhatsApp -->
                        <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>"
                           target="_blank"
                           class="share-btn"
                           data-platform="whatsapp"
                           style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: #f0fdf4; border: none; transition: all 0.2s ease;"
                           onmouseover="this.style.background='#25D366'; this.querySelector('svg').style.stroke='white'; this.style.transform='scale(1.1)';"
                           onmouseout="this.style.background='#f0fdf4'; this.querySelector('svg').style.stroke='#25D366'; this.style.transform='scale(1)';"
                           aria-label="WhatsApp">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#25D366" stroke-width="2" style="transition: stroke 0.2s ease;">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                            </svg>
                        </a>
                        
                        <!-- Twitter/X -->
                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo urlencode(get_permalink()); ?>"
                           target="_blank"
                           class="share-btn"
                           data-platform="twitter"
                           style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: #f8fafc; border: none; transition: all 0.2s ease;"
                           onmouseover="this.style.background='#000000'; this.querySelector('svg').style.stroke='white'; this.style.transform='scale(1.1)';"
                           onmouseout="this.style.background='#f8fafc'; this.querySelector('svg').style.stroke='#000000'; this.style.transform='scale(1)';"
                           aria-label="X (Twitter)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" style="transition: stroke 0.2s ease;">
                                <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
                                <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                            </svg>
                        </a>
                        
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                           target="_blank"
                           class="share-btn"
                           data-platform="facebook"
                           style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: #eff6ff; border: none; transition: all 0.2s ease;"
                           onmouseover="this.style.background='#1877F2'; this.querySelector('svg').style.stroke='white'; this.style.transform='scale(1.1)';"
                           onmouseout="this.style.background='#eff6ff'; this.querySelector('svg').style.stroke='#1877F2'; this.style.transform='scale(1)';"
                           aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1877F2" stroke-width="2" style="transition: stroke 0.2s ease;">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        
                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>"
                           target="_blank"
                           class="share-btn"
                           data-platform="linkedin"
                           style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: #eff6ff; border: none; transition: all 0.2s ease;"
                           onmouseover="this.style.background='#0A66C2'; this.querySelector('svg').style.stroke='white'; this.style.transform='scale(1.1)';"
                           onmouseout="this.style.background='#eff6ff'; this.querySelector('svg').style.stroke='#0A66C2'; this.style.transform='scale(1)';"
                           aria-label="LinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0A66C2" stroke-width="2" style="transition: stroke 0.2s ease;">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                        
                        <!-- Telegram -->
                        <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
                           target="_blank"
                           class="share-btn"
                           data-platform="telegram"
                           style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: #ecfeff; border: none; transition: all 0.2s ease;"
                           onmouseover="this.style.background='#0088cc'; this.querySelector('svg').style.stroke='white'; this.style.transform='scale(1.1)';"
                           onmouseout="this.style.background='#ecfeff'; this.querySelector('svg').style.stroke='#0088cc'; this.style.transform='scale(1)';"
                           aria-label="Telegram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0088cc" stroke-width="2" style="transition: stroke 0.2 ease;">
                                <path d="M22 2L11 13"></path>
                                <path d="M22 2l-7 20-4-9-9-4 20-7z"></path>
                            </svg>
                        </a>
                        
                        <div style="width: 1px; height: 24px; background: var(--color-border); margin: 0 0.5rem;"></div>
                        
                        <!-- Link Kopyala -->
                        <button type="button"
                                class="share-btn"
                                data-platform="copy"
                                onclick="metabilincCopyLink('<?php echo esc_js(get_permalink()); ?>')"
                                style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border-radius: 2rem; background: var(--color-secondary-light); border: none; font-size: 0.75rem; font-weight: 500; color: var(--color-text); cursor: pointer; transition: all 0.2s ease;"
                                onmouseover="this.style.background='var(--color-primary)'; this.style.color='white';"
                                onmouseout="this.style.background='var(--color-secondary-light)'; this.style.color='var(--color-text)';"
                                aria-label="Linki kopyala">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                            </svg>
                            Link Kopyala
                        </button>
                    </div>
                    
                    <!-- Premium NFT-Style Paylaşım Kartı Modal -->
                    <div id="share-card-preview" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.85); backdrop-filter: blur(8px); z-index: 1000; align-items: center; justify-content: center; padding: 2rem;">
                        <div style="position: relative; max-width: 420px; width: 100%;">
                            <!-- Close Button -->
                            <button type="button" onclick="document.getElementById('share-card-preview').style.display='none'"
                                    style="position: absolute; top: -50px; right: 0; background: rgba(255,255,255,0.1); border: none; color: white; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease;"
                                    onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                                    onmouseout="this.style.background='rgba(255,255,255,0.1)';">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                            
                            <!-- NFT-Style Card -->
                            <div style="background: linear-gradient(145deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); border-radius: 1.5rem; padding: 1px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);">
                                <div style="background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%); border-radius: 1.5rem; padding: 1.5rem; position: relative; overflow: hidden;">
                                    <!-- Glow Effect -->
                                    <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(249,115,22,0.15) 0%, transparent 50%); pointer-events: none;"></div>
                                    
                                    <!-- Card Header -->
                                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; position: relative;">
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            <div style="width: 36px; height: 36px; background: linear-gradient(135deg, var(--color-accent), #ea580c); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div style="color: white; font-weight: 700; font-size: 0.875rem;">METABILINC</div>
                                                <div style="color: rgba(255,255,255,0.5); font-size: 0.625rem; text-transform: uppercase; letter-spacing: 0.1em;">Akademi</div>
                                            </div>
                                        </div>
                                        <div style="width: 32px; height: 32px; border: 2px solid var(--color-accent); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <div style="width: 8px; height: 8px; background: var(--color-accent); border-radius: 50%;"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Card Image Area -->
                                    <div style="aspect-ratio: 1; background: linear-gradient(135deg, rgba(249,115,22,0.1) 0%, rgba(31,41,55,0.5) 100%); border-radius: 1rem; margin-bottom: 1.5rem; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; text-align: center; position: relative; border: 1px solid rgba(255,255,255,0.05);">
                                        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--color-accent), #ea580c); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; box-shadow: 0 10px 40px rgba(249,115,22,0.3);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
                                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                            </svg>
                                        </div>
                                        <h4 id="share-card-title" style="color: white; font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem; line-height: 1.3;"></h4>
                                        <p id="share-card-desc" style="color: rgba(255,255,255,0.6); font-size: 0.875rem; line-height: 1.5;"></p>
                                    </div>
                                    
                                    <!-- Card Stats -->
                                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.05);">
                                        <div style="text-align: center;">
                                            <div style="color: var(--color-accent); font-weight: 700; font-size: 1rem;"><?php echo number_format($course_enrolled); ?></div>
                                            <div style="color: rgba(255,255,255,0.4); font-size: 0.625rem; text-transform: uppercase; letter-spacing: 0.05em;">Öğrenci</div>
                                        </div>
                                        <div style="text-align: center;">
                                            <div style="color: var(--color-accent); font-weight: 700; font-size: 1rem;"><?php echo esc_html($course_duration ? $course_duration : '8 Hafta'); ?></div>
                                            <div style="color: rgba(255,255,255,0.4); font-size: 0.625rem; text-transform: uppercase; letter-spacing: 0.05em;">Süre</div>
                                        </div>
                                        <div style="text-align: center;">
                                            <div style="color: var(--color-accent); font-weight: 700; font-size: 1rem;">#001</div>
                                            <div style="color: rgba(255,255,255,0.4); font-size: 0.625rem; text-transform: uppercase; letter-spacing: 0.05em;">Token ID</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Card Footer -->
                                    <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.1);">
                                        <div style="color: rgba(255,255,255,0.5); font-size: 0.75rem;">
                                            metabilincakademi.com
                                        </div>
                                        <div style="color: var(--color-accent); font-size: 0.75rem; font-weight: 600;">
                                            LIMITED
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Download Button -->
                            <button type="button" onclick="metabilincDownloadCard()"
                                    style="margin-top: 1.5rem; width: 100%; background: linear-gradient(135deg, var(--color-accent), #ea580c); color: white; border: none; padding: 1rem; border-radius: 1rem; cursor: pointer; font-weight: 600; font-size: 0.9375rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.2s ease; box-shadow: 0 10px 30px rgba(249,115,22,0.3);"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 40px rgba(249,115,22,0.4)';"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(249,115,22,0.3)';">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Story İçin İndir
                            </button>
                        </div>
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
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-accent btn-lg" style="width: 100%; justify-content: center;">
                            Kursa Başla
                        </a>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/odeme?course=' . get_post_field('post_name'))); ?>" class="btn btn-accent btn-lg" style="width: 100%; justify-content: center;">
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
