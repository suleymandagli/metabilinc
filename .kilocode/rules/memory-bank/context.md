# Active Context: Metabilinc Eğitim Platformu

## Current State

**Proje Durumu:** ✅ Tamamlandı - Build başarılı

Metabilinc, anne ve baba eğitimleri için kapsamlı bir kurs funnel sistemidir. 
- Next.js versiyonu: Tamamlandı
- **WordPress Tema versiyonu:** ✅ Tamamlandı

## Tamamlanan Özellikler

### WordPress Tema
- [x] `wp-theme/` klasörü oluşturuldu
- [x] style.css - Tema meta verileri ve tam CSS tasarım sistemi
- [x] functions.php - Tema fonksiyonları, custom post type, AJAX handlers
- [x] header.php - Header şablonu
- [x] footer.php - Footer şablonu
- [x] index.php - Ana sayfa şablonu
- [x] page.php - Standart sayfa şablonu
- [x] archive-course.php - Kurslar listesi
- [x] single-course.php - Kurs detay sayfası + **Paylaş & Hediye özellikleri**
- [x] template-parts/content-course-card.php - Kurs kartı bileşeni
- [x] inc/class-metabilinc-walker-nav-menu.php - Menü walker
- [x] assets/js/main.js - JavaScript (mobil menü, lead form, paylaş, hediye)

#### Paylaş Özellikleri (single-course.php)
- [x] WhatsApp paylaşımı
- [x] Twitter/X paylaşımı
- [x] Facebook paylaşımı
- [x] LinkedIn paylaşımı
- [x] Instagram Story için grafik kartı (320x568px, story boyutu)
- [x] Link kopyalama

#### Hediye Et Özelliği
- [x] Hediye formu (alıcı adı, e-posta, mesaj)
- [x] Benzersiz hediye token oluşturma
- [x] Hediye bağlantısı oluşturma ve paylaşma
- [x] Veritabanına hediye kaydetme
- [x] Hediye kullanım takibi

### Tasarım Sistemi (Güncel)
- [x] Ana renk paleti - Antrasit & Turuncu
- [x] Primary: `#1F2937` (antrasit)
- [x] Accent: `#F97316` (turuncu)
- [x] Background: `#FFFFFF` (beyaz)
- [x] Secondary: `#E5E7EB` (destek gri)

### Admin Panel (Tam İşlevsel)
- [x] Veritabanı entegrasyonu
- [x] Kurs CRUD (oluştur, oku, güncelle, sil)
- [x] Sipariş yönetimi
- [x] Lead yönetimi
- [x] İstatistikler (gelir, öğrenci, kurs sayıları)
- [x] Kurs ekleme/düzenleme modal formu
- [x] API routes: `/api/admin/courses`, `/api/admin/orders`, `/api/admin/leads`, `/api/admin/stats`

### Sayfalar
- [x] Ana Sayfa
- [x] Kurslar Listesi
- [x] Kurs Detay Sayfası
- [x] Ödeme Sayfası
- [x] Mini Kurs
- [x] Dashboard
- [x] Admin Panel
- [x] **Hakkımızda** (yeni eklendi)
- [x] **İletişim** (yeni eklendi)
- [x] **Blog** (yeni eklendi)

## Yapı

```
src/
├── app/
│   ├── page.tsx                 # Ana sayfa
│   ├── layout.tsx               # Root layout
│   ├── globals.css              # Global stiller
│   ├── kurslar/page.tsx         # Kurslar listesi
│   ├── kurs/[slug]/page.tsx     # Tek kurs detay
│   ├── mini-kurs/page.tsx       # Ücretsiz mini kurs
│   ├── odeme/[slug]/page.tsx   # Ödeme sayfası
│   ├── dashboard/page.tsx       # Kullanıcı dashboard
│   ├── admin/page.tsx           # Admin panel
│   ├── blog/page.tsx             # Blog sayfası
│   └── hakkimizda/page.tsx       # Hakkımızda
├── components/
│   ├── layout/                  # Header, Footer
│   ├── sections/                # Hero, Courses, Testimonials, LeadCapture
│   └── ui/                      # CourseCard
├── db/
│   ├── schema.ts                # Veritabanı şeması
│   └── index.ts                 # DB bağlantısı
└── lib/
    └── utils.ts                 # Utility fonksiyonları
```

## Sonraki Adımlar

1. İyzico/PayTR gerçek API entegrasyonu
2. NextAuth.js ile kullanıcı girişi
3. Veritabanı migrate (veritabanını oluşturma)
4. Gerçek içerik ekleme
5. Deployment (Vercel/Netlify)

## Teknolojiler

- Next.js 16.1.6
- React 19
- TypeScript
- Tailwind CSS 4
- Drizzle ORM
- SQLite
- Framer Motion
