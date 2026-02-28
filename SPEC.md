# Metabilinc Eğitim Platformu - Teknik Şartname

## Proje Genel Bakış

**Proje Adı:** Metabilinc Eğitim Platformu  
**Alan Adı:** metabilinc.com  
**Platform:** Next.js 16 + React 19 + TypeScript  
**Veritabanı:** SQLite + Drizzle ORM (Geliştirme), PostgreSQL (Production)

---

## Funnel Akışı

```
Ana Sayfa → Kurslar Sayfası → Tek Kurs Sayfası → 
Ücretsiz Mini Kurs (Lead Capture) → Ücretli Kurs Teklifi → 
Ödeme Sayfası → Kullanıcı Dashboard
```

### Upsell/Downsell Mantığı
- **Upsell:** Ana kursu satın alan kullanıcılara ek paketler sunma
- **Downsell:** Ana kursu reddedenlere daha uygun fiyatlı alternatif sunma

---

## Sayfa Yapısı

### 1. Ana Sayfa (/)
**Bileşenler:**
- Hero Section: Başlık, alt başlık, CTA butonları
- Eğitim Kategorileri (Bilinçli Aile Okulu, Bilinçli Evlilik Akademisi)
- Öne Çıkan Kurslar
- Sosyal Kanıtlar (İstatistikler, Yorumlar)
- Ücretsiz E-kitap/Mini Kurs Tanıtımı
- Footer (İletişim, Yasal)

### 2. Kurslar Sayfası (/kurslar)
- Tüm kursların kart görünümü
- Filtreleme (Kategori, Fiyat, Seviye)
- Her kartta: Görsel, Başlık, Açıklama, Fiyat, "İncele" butonu

### 3. Tek Kurs Sayfası (/kurs/[slug])
- Kurs görseli/banner
- Kurs başlığı ve açıklaması
- Müfredat (Modüller ve dersler)
- Eğitmen tanıtımı
- Fiyat ve Satın Alma CTA
- İçerik kazanımları
- SSS bölümü
- Yorumlar

### 4. Ücretsiz Mini Kurs / Lead Capture (/mini-kurs/[slug])
- Email kayıt formu (Ad, Email, Telefon)
- E-kitap/Video tanıtımı
- Kayıt olduktan sonra içeriğe erişim
- Lead bilgileri veritabanına kaydedilir

### 5. Ödeme Sayfası (/odeme/[slug])
- Kurs özeti
- Fiyat bilgisi
- İyzico entegrasyonu
- PayTR entegrasyonu
- Güvenli ödeme formu
- Başarısız/başarılı yönlendirme sayfaları

### 6. Kullanıcı Dashboard (/dashboard)
- Satın aldığı kurslar
- İlerleme durumu
- Profil bilgileri
- Ödeme geçmişi

### 7. Admin Panel (/admin)
- Kurs CRUD (Ekle, Düzenle, Sil, Listele)
- Müfredat yönetimi
- Lead yönetimi
- Sipariş yönetimi
- Kullanıcı yönetimi

---

## Ana Kurslar

### 1. Bilinçli Aile Okulu
**Hedef Kitle:** 0-20 yaş çocuklu anne-babalar  
**Modüller:**
1. Çocuk Gelişimi Temelleri
2. Etkili İletişim Teknikleri
3. Problem Çözme Becerileri
4. Pozitif Disiplin
5. Duygusal Zeka Geliştirme
6. Teknoloji ve Ekran Süresi
7. Özgüven ve Motivasyon
8. Okul Başarısı

### 2. Bilinçli Evlilik Akademisi
**Hedef Kitle:** Evlilik öncesi ve sonrası çiftler  
**Modüller:**
1. Evliliğe Hazırlık
2. İletişim ve Bağlantı
3. Çatışma Yönetimi
4. Duygusal ve İlişkisel İhtiyaçlar
5. Çocuk Sahibi Olma Planlaması
6. Aile Ekonomisi
7. İntim ve Romantizm
8. Aile Değerleri ve Kültür

---

## Ödeme Sistemleri

### İyzico Entegrasyonu
- Kredi kartı tek çekim
- Taksitli ödeme
- Sanal POS

### PayTR Entegrasyonu
- Kredi kartı
- Havale/EFT
- Papara

---

## Teknik Gereksinimler

### Frontend
- Next.js 16 (App Router)
- React 19
- TypeScript 5.9
- Tailwind CSS 4
- Framer Motion (Animasyonlar)

### Backend
- Next.js API Routes
- Drizzle ORM
- NextAuth.js (Authentication)
- Zod (Validation)

### Ödeme
- İyzico API
- PayTR API

---

## Tasarım Prensipleri

### Renk Paleti
- **Primary:** #2D5A27 (Bilinçli yeşil)
- **Secondary:** #F5E6D3 (Sıcak krem)
- **Accent:** #E8A838 (Altın sarısı)
- **Text:** #1A1A1A
- **Background:** #FAFAFA

### Tipografi
- **Başlıklar:** Playfair Display
- **Gövde:** Inter

### UI Bileşenleri
- Modern kart tasarımları
- Yumuşak gölgeler ve kenarlar
- Hover efektleri
- Responsive tasarım
- Mobil öncelikli

---

## Geliştirme Aşamaları

1. [ ] Proje yapılandırması
2. [ ] Veritabanı şeması
3. [ ] Auth sistemi
4. [ ] Admin panel
5. [ ] Ana sayfa
6. [ ] Kurslar sayfası
7. [ ] Tek kurs sayfası
8. [ ] Lead capture sayfası
9. [ ] Ödeme sayfası
10. [ ] Kullanıcı dashboard
11. [ ] İyzico entegrasyonu
12. [ ] PayTR entegrasyonu
13. [ ] Test ve optimizasyon
