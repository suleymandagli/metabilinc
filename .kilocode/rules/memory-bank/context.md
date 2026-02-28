# Active Context: Metabilinc Eğitim Platformu

## Current State

**Proje Durumu:** ✅ Tamamlandı - Build başarılı

Metabilinc, anne ve baba eğitimleri için kapsamlı bir kurs funnel sistemidir. Güncel renk paleti uygulandı.

## Tamamlanan Özellikler

### Tasarım Sistemi (Güncel)
- [x] Ana renk paleti - Antrasit & Turuncu
- [x] Primary: `#1F2937` (antrasit)
- [x] Accent: `#F97316` (turuncu)
- [x] Background: `#FFFFFF` (beyaz)
- [x] Secondary: `#E5E7EB` (destek gri)

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
