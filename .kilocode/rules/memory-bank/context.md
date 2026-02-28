# Active Context: Metabilinc Eğitim Platformu

## Current State

**Proje Durumu:** ✅ Tamamlandı - Derleme başarılı

Metabilinc, anne ve baba eğitimleri için kapsamlı bir kurs funnel sistemidir. WordPress yerine modern Next.js 16 ile geliştirilmiştir.

## Tamamlanan Özellikler

### Frontend Sayfalar
- [x] Ana Sayfa - Hero, öne çıkan kurslar, yorumlar, ücretsiz e-kitap lead capture
- [x] Kurslar Sayfası - Filtreleme, arama, grid/list görünümü
- [x] Tek Kurs Sayfası - Müfredat, eğitmen, yorumlar, SSS, satın alma
- [x] Ücretsiz Mini Kurs - Lead capture formu
- [x] Ödeme Sayfası - İyzico/PayTR hazırlığı, taksit seçenekleri
- [x] Kullanıcı Dashboard - Kayıtlı kurslar, ilerleme, sertifikalar, siparişler
- [x] Admin Panel - Kurs yönetimi, siparişler, leadler, ödeme ayarları

### Backend/Veritabanı
- [x] Drizzle ORM şeması (users, courses, modules, lessons, enrollments, leads, orders, reviews, offers)
- [x] SQLite veritabanı yapılandırması
- [x] API route yapıları (admin, auth, kurslar, lead, ödeme)

### Tasarım Sistemi
- [x] Modern UI bileşenleri (Header, Footer, CourseCard)
- [x] Tailwind CSS 4 ile özel tema (primary: #2D5A27, accent: #E8A838)
- [x] Framer Motion animasyonları
- [x] Responsive tasarım

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
│   └── admin/page.tsx           # Admin panel
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
3. Veritabanı migrate
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
