/**
 * Metabilinç Akademi Tema JavaScript
 * 
 * @package Metabilinc
 */

(function($) {
    'use strict';
    
    // Sayfa yüklendiğinde çalışsın
    $(document).ready(function() {
        Metabilinc.init();
    });
    
    var Metabilinc = {
        
        init: function() {
            this.mobileMenu();
            this.stickyHeader();
            this.leadCaptureForm();
            this.giftForm();
            this.contactForm();
            this.courseFilters();
            this.faqAccordion();
            this.scrollAnimations();
        },
        
        // Benzersiz hediye token oluştur
        generateGiftToken: function() {
            return 'gift_' + Date.now().toString(36) + '_' + Math.random().toString(36).substr(2, 9);
        },
        
        // Mobil Menü
        mobileMenu: function() {
            var toggle = $('.mobile-menu-toggle');
            var overlay = $('.mobile-menu-overlay');
            var menu = $('.mobile-menu');
            var close = $('.mobile-menu-close');
            
            if (toggle.length) {
                toggle.on('click', function(e) {
                    e.preventDefault();
                    $('body').addClass('menu-open');
                    menu.addClass('active');
                    overlay.addClass('active');
                });
                
                close.on('click', function(e) {
                    e.preventDefault();
                    $('body').removeClass('menu-open');
                    menu.removeClass('active');
                    overlay.removeClass('active');
                });
                
                overlay.on('click', function(e) {
                    e.preventDefault();
                    $('body').removeClass('menu-open');
                    menu.removeClass('active');
                    overlay.removeClass('active');
                });
            }
        },
        
        // Sticky Header
        stickyHeader: function() {
            var header = $('.site-header');
            
            if (header.length) {
                $(window).on('scroll', function() {
                    if ($(this).scrollTop() > 50) {
                        header.addClass('scrolled');
                    } else {
                        header.removeClass('scrolled');
                    }
                });
            }
        },
        
        // Lead Capture Form
        leadCaptureForm: function() {
            var form = $('#lead-capture-form');
            
            if (form.length) {
                form.on('submit', function(e) {
                    e.preventDefault();
                    
                    var submitBtn = form.find('button[type="submit"]');
                    var originalText = submitBtn.html();
                    
                    submitBtn.prop('disabled', true).html('<span class="loading-spinner"></span> Yükleniyor...');
                    
                    var formData = {
                        action: 'metabilinc_lead_form',
                        nonce: metabilincData.nonce,
                        name: form.find('#lead-name').val(),
                        email: form.find('#lead-email').val()
                    };
                    
                    $.ajax({
                        url: metabilincData.ajaxUrl,
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.success) {
                                form.html('<div class="alert alert-success"><p>' + response.data.message + '</p></div>');
                            } else {
                                form.find('.lead-capture-form-group').append('<p class="error" style="color: red;">' + response.data.message + '</p>');
                                submitBtn.prop('disabled', false).html(originalText);
                            }
                        },
                        error: function() {
                            form.find('.lead-capture-form-group').append('<p class="error" style="color: red;">' + metabilincData.strings.error + '</p>');
                            submitBtn.prop('disabled', false).html(originalText);
                        }
                    });
                });
            }
        },
        
        // Hediye Form
        giftForm: function() {
            var form = $('#gift-form');
            
            if (form.length) {
                form.on('submit', function(e) {
                    e.preventDefault();
                    
                    var submitBtn = form.find('button[type="submit"]');
                    var originalText = submitBtn.html();
                    submitBtn.prop('disabled', true).html('<span class="loading-spinner"></span> Yükleniyor...');
                    
                    var courseSlug = window.location.pathname.split('/').filter(Boolean).pop();
                    var giftToken = this.generateGiftToken();
                    
                    var formData = {
                        action: 'metabilinc_create_gift',
                        nonce: metabilincData.nonce,
                        course_id: form.find('input[name="course_id"]').val() || 0,
                        course_slug: courseSlug,
                        gift_token: giftToken,
                        gift_name: form.find('input[name="gift_name"]').val(),
                        gift_email: form.find('input[name="gift_email"]').val(),
                        gift_message: form.find('textarea[name="gift_message"]').val()
                    };
                    
                    $.ajax({
                        url: metabilincData.ajaxUrl,
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.success) {
                                var giftLink = window.location.origin + '/kurs/' + courseSlug + '?gift=' + giftToken + '&to=' + encodeURIComponent(formData.gift_email);
                                
                                $('#gift-result').show();
                                $('#gift-link').val(giftLink);
                                form.hide();
                            } else {
                                alert(response.data.message || 'Hediye oluşturulurken bir hata oluştu.');
                                submitBtn.prop('disabled', false).html(originalText);
                            }
                        },
                        error: function() {
                            alert('Sunucu hatası oluştu. Lütfen tekrar deneyin.');
                            submitBtn.prop('disabled', false).html(originalText);
                        }
                    });
                }.bind(this));
            }
        },
        
        // İletişim Form
        contactForm: function() {
            var form = $('#contact-form, .contact-form');
            
            if (form.length) {
                form.on('submit', function(e) {
                    e.preventDefault();
                    
                    var submitBtn = form.find('button[type="submit"]');
                    var originalText = submitBtn.html();
                    submitBtn.prop('disabled', true).html('<span class="loading-spinner"></span> Yükleniyor...');
                    
                    var formData = {
                        action: 'metabilinc_contact_form',
                        nonce: metabilincData.nonce,
                        name: form.find('input[name="name"]').val() || form.find('input[name="your-name"]').val(),
                        email: form.find('input[name="email"]').val() || form.find('input[name="your-email"]').val(),
                        subject: form.find('input[name="subject"]').val() || form.find('input[name="your-subject"]').val(),
                        message: form.find('textarea[name="message"]').val() || form.find('textarea[name="your-message"]').val()
                    };
                    
                    $.ajax({
                        url: metabilincData.ajaxUrl,
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.success) {
                                form.html('<div class="alert alert-success"><p>' + response.data.message + '</p></div>');
                            } else {
                                form.find('.form-messages').html('<p class="error" style="color: red;">' + (response.data.message || 'Bir hata oluştu.') + '</p>');
                                submitBtn.prop('disabled', false).html(originalText);
                            }
                        },
                        error: function() {
                            form.find('.form-messages').html('<p class="error" style="color: red;">Sunucu hatası oluştu. Lütfen tekrar deneyin.</p>');
                            submitBtn.prop('disabled', false).html(originalText);
                        }
                    });
                });
            }
        },
        
        // Kurs Filtreleme
        courseFilters: function() {
            var filterForm = $('.course-filter-form, #course-filter-form');
            var courseGrid = $('.course-grid, .courses-grid, .course-list');
            
            if (filterForm.length && courseGrid.length) {
                filterForm.on('change', 'select, input', function(e) {
                    e.preventDefault();
                    
                    var category = filterForm.find('select[name="category"]').val() || '';
                    var level = filterForm.find('select[name="level"]').val() || '';
                    var price = filterForm.find('select[name="price"]').val() || '';
                    
                    var filterBtn = filterForm.find('button[type="submit"]');
                    var originalText = filterBtn.html();
                    filterBtn.prop('disabled', true).html('<span class="loading-spinner"></span> Filtreleniyor...');
                    
                    var formData = {
                        action: 'metabilinc_filter_courses',
                        nonce: metabilincData.nonce,
                        category: category,
                        level: level,
                        price: price
                    };
                    
                    $.ajax({
                        url: metabilincData.ajaxUrl,
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.success) {
                                courseGrid.fadeOut(200, function() {
                                    $(this).html(response.data.html).fadeIn(200);
                                });
                            } else {
                                alert('Filtreleme sırasında bir hata oluştu.');
                            }
                            filterBtn.prop('disabled', false).html(originalText);
                        },
                        error: function() {
                            alert('Sunucu hatası oluştu.');
                            filterBtn.prop('disabled', false).html(originalText);
                        }
                    });
                });
                
                // Reset button
                filterForm.on('click', '.filter-reset', function(e) {
                    e.preventDefault();
                    filterForm.find('select').val('');
                    filterForm.find('input').val('');
                    courseGrid.fadeOut(200, function() {
                        $(this).load(window.location.href + ' ' + courseGrid.selector, function() {
                            $(this).fadeIn(200);
                        });
                    });
                });
            }
        },
        
        // SSS Akordiyon
        faqAccordion: function() {
            var faqItems = $('.faq-item, .accordion-item');
            
            if (faqItems.length) {
                faqItems.each(function() {
                    var question = $(this).find('.faq-question, .accordion-question, .faq-header');
                    var answer = $(this).find('.faq-answer, .accordion-content, .faq-response');
                    
                    if (question.length && answer.length) {
                        question.on('click', function(e) {
                            e.preventDefault();
                            
                            var isActive = $(this).parent().hasClass('active');
                            
                            // Tümünü kapat
                            faqItems.removeClass('active');
                            faqItems.find('.faq-answer, .accordion-content, .faq-response').slideUp(300);
                            
                            // Tıklananı aç
                            if (!isActive) {
                                $(this).parent().addClass('active');
                                answer.slideDown(300);
                            }
                        });
                    }
                });
            }
        },
        
        // Scroll Animations
        scrollAnimations: function() {
            // Intersection Observer kullanarak animasyonlar
            if ('IntersectionObserver' in window) {
                var observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1 });
                
                $('.course-card, .testimonial-card, .hero-visual').each(function() {
                    observer.observe(this);
                });
            }
        }
    };
    
    // Global fonksiyonlar
    
    // Linki panoya kopyala - Modern Clipboard API
    window.metabilincCopyLink = function(text) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(function() {
                // Başarılı bildirim
                showNotification('Link kopyalandı!', 'success');
            }).catch(function(err) {
                console.error('Kopyalama hatası:', err);
                fallbackCopy(text);
            });
        } else {
            fallbackCopy(text);
        }
        
        function fallbackCopy(text) {
            var textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();
            
            try {
                document.execCommand('copy');
                showNotification('Link kopyalandı!', 'success');
            } catch (err) {
                console.error('Kopyalama hatası:', err);
                showNotification('Kopyalama başarısız oldu', 'error');
            }
            
            document.body.removeChild(textarea);
        }
        
        function showNotification(message, type) {
            // Mevcut bildirimi kaldır
            var existing = document.querySelector('.copy-notification');
            if (existing) existing.remove();
            
            var notification = document.createElement('div');
            notification.className = 'copy-notification';
            notification.style.cssText = 'position: fixed; bottom: 2rem; left: 50%; transform: translateX(-50%); background: ' + (type === 'success' ? 'var(--color-success, #10B981)' : 'var(--color-error, #EF4444)') + '; color: white; padding: 0.75rem 1.5rem; border-radius: 2rem; font-size: 0.875rem; font-weight: 500; z-index: 9999; animation: slideUp 0.3s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.2);';
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(function() {
                notification.style.animation = 'slideDown 0.3s ease';
                setTimeout(function() {
                    notification.remove();
                }, 300);
            }, 2000);
        }
    };
    
    // NFT-Style Paylaşım Kartı Modal
    window.metabilincShareCard = function(title, desc, url) {
        var preview = document.getElementById('share-card-preview');
        var titleEl = document.getElementById('share-card-title');
        var descEl = document.getElementById('share-card-desc');
        
        if (preview && titleEl && descEl) {
            titleEl.textContent = title;
            descEl.textContent = desc ? desc.substring(0, 120) + (desc.length > 120 ? '...' : '') : 'Ebeveynlik yolculuğunuzda uzman rehberlik ile bilinçli aile olmanın anahtarı burada.';
            
            // Modal'ı göster
            preview.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Sayfayı kaydırmayı engelle
        }
    };
    
    // Paylaşım kartını indir
    window.metabilincDownloadCard = function() {
        var canvas = document.getElementById('share-card-canvas');
        if (!canvas) {
            alert('Paylaşım kartı bulunamadı!');
            return;
        }
        
        // Canvas'ı resim olarak kaydetmek için html2canvas kullan
        if (typeof html2canvas !== 'undefined') {
            html2canvas(canvas, {
                scale: 2,
                backgroundColor: null,
                useCORS: true
            }).then(function(renderedCanvas) {
                var link = document.createElement('a');
                link.download = 'metabilinc-kurs-paylasim.png';
                link.href = renderedCanvas.toDataURL('image/png');
                link.click();
            }).catch(function(err) {
                console.error('Kart indirme hatası:', err);
                alert('Kart indirilirken bir hata oluştu.');
            });
        } else {
            // html2canvas yoksa alternatif yöntem
            alert('Paylaşım kartını indirmek için lütfen ekran görüntüsü alın veya Instagram Story özelliğini kullanın.');
        }
    };
    
    // Hediye bağlantısını paylaş
    window.metabilincShareGiftLink = function() {
        var link = document.getElementById('gift-link');
        if (link && link.value) {
            var text = 'Size ' + window.location.hostname + ' üzerinden bir kurs hediye ettim! 🎁\n\nAşağıdaki bağlantıdan kursa erişebilirsiniz:\n' + link.value;
            var whatsappUrl = 'https://wa.me/?text=' + encodeURIComponent(text);
            window.open(whatsappUrl, '_blank');
        }
    };
    
    // Mobil menü hover dropdown
    $(document).on('click', '.mobile-nav-menu .nav-item-has-children > a', function(e) {
        if ($(window).width() < 1024) {
            e.preventDefault();
            var $this = $(this);
            var $submenu = $this.next('.submenu');
            
            if ($submenu.length) {
                $submenu.slideToggle(300);
                $this.parent().toggleClass('active');
            }
        }
    });
    
    // Smooth scroll
    $('a[href^="#"]').on('click', function(e) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 500);
        }
    });
    
    //lazy load images
    if ('loading' in HTMLImageElement.prototype) {
        document.querySelectorAll('img[loading="lazy"]').forEach(function(img) {
            img.src = img.dataset.src;
        });
    } else {
        // Fallback for older browsers
        var script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.0/lazysizes.min.js';
        document.head.appendChild(script);
    }
    
})(jQuery);
