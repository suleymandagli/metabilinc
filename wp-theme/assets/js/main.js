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
            this.scrollAnimations();
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
                    
                    var formData = {
                        action: 'metabilinc_create_gift',
                        nonce: metabilincData.nonce,
                        course_id: form.find('input[name="course_id"]').val() || 0,
                        gift_name: form.find('input[name="gift_name"]').val(),
                        gift_email: form.find('input[name="gift_email"]').val(),
                        gift_message: form.find('textarea[name="gift_message"]').val()
                    };
                    
                    // AJAX isteği yerine doğrudan bağlantı oluştur
                    var courseSlug = window.location.pathname.split('/').filter(Boolean).pop();
                    var giftToken = this.generateGiftToken();
                    var giftLink = window.location.origin + '/kurs/' + courseSlug + '?gift=' + giftToken + '&to=' + encodeURIComponent(formData.gift_email);
                    
                    // Bağlantıyı göster
                    $('#gift-result').show();
                    $('#gift-link').val(giftLink);
                    
                    // Bağlantıyı localStorage'a kaydet (gerçek uygulamada sunucuya kaydedilmeli)
                    var gifts = JSON.parse(localStorage.getItem('metabilinc_gifts') || '[]');
                    gifts.push({
                        token: giftToken,
                        course_slug: courseSlug,
                        recipient_email: formData.gift_email,
                        recipient_name: formData.gift_name,
                        message: formData.gift_message,
                        created_at: new Date().toISOString()
                    });
                    localStorage.setItem('metabilinc_gifts', JSON.stringify(gifts));
                    
                    form.hide();
                }.bind(this));
            }
        },
        
        // Benzersiz hediye token oluştur
        generateGiftToken: function() {
            return 'gift_' + Date.now().toString(36) + '_' + Math.random().toString(36).substr(2, 9);
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
    
    // Linki panoya kopyala
    window.metabilincCopyLink = function(text) {
        var textarea = document.createElement('textarea');
        textarea.value = text;
        textarea.style.position = 'fixed';
        textarea.style.opacity = '0';
        document.body.appendChild(textarea);
        textarea.select();
        
        try {
            document.execCommand('copy');
            alert('Link kopyalandı!');
        } catch (err) {
            console.error('Kopyalama hatası:', err);
        }
        
        document.body.removeChild(textarea);
    };
    
    // Instagram Story paylaşım kartı
    window.metabilincShareCard = function(title, desc, url) {
        var preview = document.getElementById('share-card-preview');
        var titleEl = document.getElementById('share-card-title');
        var descEl = document.getElementById('share-card-desc');
        
        if (preview && titleEl && descEl) {
            titleEl.textContent = title;
            descEl.textContent = desc.substring(0, 100) + (desc.length > 100 ? '...' : '');
            
            // Göster/gizle
            if (preview.style.display === 'none') {
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
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
