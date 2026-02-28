# Active Context: Metabilinc Eğitim Platformu

## Current State

**Proje Durumu:** ✅ Tamamlandı - Build başarılı

Metabilinc, anne ve baba eğitimleri için kapsamlı bir kurs funnel sistemidir. Premium renk paleti güncellendi.

## Tamamlanan Özellikler

### Tasarım Sistemi (Güncellendi)
- [x] Premium renk paleti - Lüks yeşil & altın tonları
- [x] Primary: `#1B4332` (derin forest green)
- [x] Secondary: `#F5F0E8` (şık krem/şampanya)
- [x] Accent: `#B8860B` (premium altın/bronze)
- [x] Background: `#FAF9F7` (sıcak beyaz)
- [x] Luxury gradient sınıfları eklendi

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
