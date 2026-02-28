"use client";

import { useState } from "react";
import { motion } from "framer-motion";
import { Search, Filter, Grid, List, SlidersHorizontal } from "lucide-react";
import { CourseCard } from "@/components/ui/CourseCard";

// Sample courses data
const allCourses = [
  {
    id: 1,
    title: "Bilinçli Aile Okulu",
    slug: "bilincli-aile-okulu",
    shortDescription: "0-18 yaş çocuklarınızla daha sağlıklı iletişim kurun. Etkili disiplin, duygusal bağ ve pozitif ebeveynlik tekniklerini öğrenin.",
    thumbnail: "",
    price: 1997,
    discountedPrice: 997,
    duration: "8 Hafta",
    enrolledCount: 5234,
    rating: 4.9,
    reviewCount: 847,
    level: "baslangic",
    isFree: false,
    category: "aile",
  },
  {
    id: 2,
    title: "Bilinci Evlilik Akademisi",
    slug: "bilincli-evlilik-akademisi",
    shortDescription: "Evliliğinizdeki iletişimi güçlendirin, çatışmaları yapıcı çözün ve daha mutlu bir evlilik için gereken becerileri kazanın.",
    thumbnail: "",
    price: 1497,
    discountedPrice: 747,
    duration: "6 Hafta",
    enrolledCount: 3156,
    rating: 4.8,
    reviewCount: 523,
    level: "baslangic",
    isFree: false,
    category: "evlilik",
  },
  {
    id: 3,
    title: "Çocuklarla Etkili İletişim",
    slug: "cocuklarla-etkili-iletisim",
    shortDescription: "Çocuğunuzun duygularını anlayın ve onunla daha iyi bir bağ kurun. Kanıtlanmış iletişim teknikleri.",
    thumbnail: "",
    price: 0,
    discountedPrice: 0,
    duration: "2 Saat",
    enrolledCount: 12500,
    rating: 4.9,
    reviewCount: 2100,
    level: "baslangic",
    isFree: true,
    category: "aile",
  },
  {
    id: 4,
    title: "Ergenlik Döneminde İletişim",
    slug: "ergenlik-donemi-iletisim",
    shortDescription: "Ergen çocuğunuzla sağlıklı iletişim kurun. Bu zorlu dönemi birlikte atlatın.",
    thumbnail: "",
    price: 497,
    discountedPrice: 247,
    duration: "4 Hafta",
    enrolledCount: 2156,
    rating: 4.7,
    reviewCount: 312,
    level: "orta",
    isFree: false,
    category: "aile",
  },
  {
    id: 5,
    title: "Evliliğe Hazırlık Kursu",
    slug: "evlilik-hazirlik",
    shortDescription: "Evlilik öncesi çiftler için kapsamlı hazırlık programı. Sağlıklı bir evliliğin temellerini atın.",
    thumbnail: "",
    price: 997,
    discountedPrice: 497,
    duration: "5 Hafta",
    enrolledCount: 1567,
    rating: 4.8,
    reviewCount: 234,
    level: "baslangic",
    isFree: false,
    category: "evlilik",
  },
  {
    id: 6,
    title: "Çocuklarda Özgüven Gelişimi",
    slug: "cocuklarda-ozguven",
    shortDescription: "Çocuğunuzun özgüvenini geliştirin. Başarılı ve mutlu bir birey olmasına yardımcı olun.",
    thumbnail: "",
    price: 747,
    discountedPrice: 397,
    duration: "3 Hafta",
    enrolledCount: 3421,
    rating: 4.9,
    reviewCount: 567,
    level: "baslangic",
    isFree: false,
    category: "aile",
  },
];

const categories = [
  { id: "all", name: "Tümü", count: allCourses.length },
  { id: "aile", name: "Aile Eğitimleri", count: allCourses.filter(c => c.category === "aile").length },
  { id: "evlilik", name: "Evlilik Kursları", count: allCourses.filter(c => c.category === "evlilik").length },
];

const levels = [
  { id: "all", name: "Tüm Seviyeler" },
  { id: "baslangic", name: "Başlangıç" },
  { id: "orta", name: "Orta" },
  { id: "ileri", name: "İleri" },
];

const priceRanges = [
  { id: "all", name: "Tümü" },
  { id: "free", name: "Ücretsiz" },
  { id: "paid", name: "Ücretli" },
];

export default function CoursesPage() {
  const [searchQuery, setSearchQuery] = useState("");
  const [selectedCategory, setSelectedCategory] = useState("all");
  const [selectedLevel, setSelectedLevel] = useState("all");
  const [selectedPrice, setSelectedPrice] = useState("all");
  const [viewMode, setViewMode] = useState<"grid" | "list">("grid");
  const [showFilters, setShowFilters] = useState(false);

  const filteredCourses = allCourses.filter(course => {
    const matchesSearch = course.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
      course.shortDescription?.toLowerCase().includes(searchQuery.toLowerCase());
    const matchesCategory = selectedCategory === "all" || course.category === selectedCategory;
    const matchesLevel = selectedLevel === "all" || course.level === selectedLevel;
    const matchesPrice = selectedPrice === "all" || 
      (selectedPrice === "free" && course.isFree) ||
      (selectedPrice === "paid" && !course.isFree);
    
    return matchesSearch && matchesCategory && matchesLevel && matchesPrice;
  });

  return (
    <div className="min-h-screen bg-background pt-24 pb-20">
      <div className="container-main">
        {/* Header */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          className="mb-12"
        >
          <h1 className="section-title mb-4">
            Tüm <span className="gradient-text">Kurslarımız</span>
          </h1>
          <p className="text-xl text-text-muted max-w-2xl">
            Aile ve evlilik hayatınızı dönüştürecek profesyonel eğitimlerimizi keşfedin.
            Alanında uzman eğitmenlerden öğrenin.
          </p>
        </motion.div>

        {/* Search & Filter Bar */}
        <div className="bg-surface rounded-2xl p-4 mb-8 border border-border/50">
          <div className="flex flex-col lg:flex-row gap-4">
            {/* Search */}
            <div className="flex-1 relative">
              <Search className="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-text-muted" />
              <input
                type="text"
                placeholder="Kurs ara..."
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                className="input pl-12"
              />
            </div>

            {/* Filter Toggle (Mobile) */}
            <button
              onClick={() => setShowFilters(!showFilters)}
              className="lg:hidden btn btn-secondary"
            >
              <SlidersHorizontal className="w-5 h-5 mr-2" />
              Filtrele
            </button>

            {/* Desktop Filters */}
            <div className="hidden lg:flex items-center gap-4">
              <select
                value={selectedCategory}
                onChange={(e) => setSelectedCategory(e.target.value)}
                className="input w-auto"
              >
                {categories.map(cat => (
                  <option key={cat.id} value={cat.id}>{cat.name}</option>
                ))}
              </select>

              <select
                value={selectedLevel}
                onChange={(e) => setSelectedLevel(e.target.value)}
                className="input w-auto"
              >
                {levels.map(level => (
                  <option key={level.id} value={level.id}>{level.name}</option>
                ))}
              </select>

              <select
                value={selectedPrice}
                onChange={(e) => setSelectedPrice(e.target.value)}
                className="input w-auto"
              >
                {priceRanges.map(price => (
                  <option key={price.id} value={price.id}>{price.name}</option>
                ))}
              </select>

              {/* View Mode */}
              <div className="flex items-center border border-border rounded-lg overflow-hidden">
                <button
                  onClick={() => setViewMode("grid")}
                  className={`p-2 ${viewMode === "grid" ? "bg-primary text-white" : "hover:bg-secondary"}`}
                >
                  <Grid className="w-5 h-5" />
                </button>
                <button
                  onClick={() => setViewMode("list")}
                  className={`p-2 ${viewMode === "list" ? "bg-primary text-white" : "hover:bg-secondary"}`}
                >
                  <List className="w-5 h-5" />
                </button>
              </div>
            </div>
          </div>

          {/* Mobile Filters */}
          {showFilters && (
            <motion.div
              initial={{ opacity: 0, height: 0 }}
              animate={{ opacity: 1, height: "auto" }}
              className="lg:hidden mt-4 pt-4 border-t border-border grid grid-cols-2 gap-4"
            >
              <select
                value={selectedCategory}
                onChange={(e) => setSelectedCategory(e.target.value)}
                className="input"
              >
                {categories.map(cat => (
                  <option key={cat.id} value={cat.id}>{cat.name}</option>
                ))}
              </select>

              <select
                value={selectedLevel}
                onChange={(e) => setSelectedLevel(e.target.value)}
                className="input"
              >
                {levels.map(level => (
                  <option key={level.id} value={level.id}>{level.name}</option>
                ))}
              </select>

              <select
                value={selectedPrice}
                onChange={(e) => setSelectedPrice(e.target.value)}
                className="input"
              >
                {priceRanges.map(price => (
                  <option key={price.id} value={price.id}>{price.name}</option>
                ))}
              </select>
            </motion.div>
          )}
        </div>

        {/* Results Count */}
        <div className="mb-8">
          <span className="text-text-muted">
            <span className="font-semibold text-text">{filteredCourses.length}</span> kurs bulundu
          </span>
        </div>

        {/* Course Grid */}
        {filteredCourses.length > 0 ? (
          <div className={`grid gap-8 ${viewMode === "grid" ? "md:grid-cols-2 lg:grid-cols-3" : "grid-cols-1"}`}>
            {filteredCourses.map((course, index) => (
              <motion.div
                key={course.id}
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: index * 0.05 }}
              >
                <CourseCard {...course} />
              </motion.div>
            ))}
          </div>
        ) : (
          <div className="text-center py-20">
            <div className="w-20 h-20 rounded-full bg-secondary flex items-center justify-center mx-auto mb-6">
              <Search className="w-10 h-10 text-text-muted" />
            </div>
            <h3 className="font-display text-xl font-semibold mb-2">Kurs bulunamadı</h3>
            <p className="text-text-muted">
              Farklı filtreler deneyebilir veya arama teriminizi değiştirebilirsiniz.
            </p>
          </div>
        )}
      </div>
    </div>
  );
}
