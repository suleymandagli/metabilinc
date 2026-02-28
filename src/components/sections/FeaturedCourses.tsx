"use client";

import { motion } from "framer-motion";
import Link from "next/link";
import { ArrowRight, Heart, Users, Sparkles } from "lucide-react";
import { CourseCard } from "@/components/ui/CourseCard";

// Sample course data
const courses = [
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
];

const categories = [
  { 
    icon: Heart, 
    name: "Aile Eğitimleri", 
    description: "Çocuk gelişimi ve aile içi iletişim",
    count: 24
  },
  { 
    icon: Users, 
    name: "Evlilik Kursları", 
    description: "Sağlıklı evlilik ve ilişki yönetimi",
    count: 12
  },
  { 
    icon: Sparkles, 
    name: "Kişisel Gelişim", 
    description: "Bilinçli yaşam ve farkındalık",
    count: 18
  },
];

export function FeaturedCourses() {
  return (
    <section className="py-20 bg-secondary-light">
      <div className="container-main">
        {/* Section Header */}
        <div className="text-center mb-16">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="inline-flex items-center gap-2 bg-primary/10 px-4 py-2 rounded-full mb-4"
          >
            <Sparkles className="w-4 h-4 text-primary" />
            <span className="text-sm font-medium text-primary">Eğitimlerimiz</span>
          </motion.div>
          
          <h2 className="section-title mb-4">
            Size Özel <span className="gradient-text">Eğitim Programları</span>
          </h2>
          
          <p className="section-subtitle mx-auto">
            Alanında uzman eğitmenlerden, kanıta dayalı yöntemlerle 
            aile ve evlilik hayatınızı dönüştürecek eğitimler.
          </p>
        </div>

        {/* Categories */}
        <div className="grid md:grid-cols-3 gap-6 mb-16">
          {categories.map((cat, index) => (
            <motion.div
              key={cat.name}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: index * 0.1 }}
              className="bg-surface rounded-2xl p-6 border border-border/50 hover:shadow-lg transition-shadow cursor-pointer group"
            >
              <div className="w-12 h-12 rounded-xl gradient-bg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <cat.icon className="w-6 h-6 text-white" />
              </div>
              <h3 className="font-display text-lg font-semibold mb-2">{cat.name}</h3>
              <p className="text-text-muted text-sm mb-2">{cat.description}</p>
              <span className="text-primary text-sm font-medium">{cat.count} kurs</span>
            </motion.div>
          ))}
        </div>

        {/* Course Grid */}
        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
          {courses.map((course, index) => (
            <motion.div
              key={course.id}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: index * 0.1 }}
            >
              <CourseCard {...course} />
            </motion.div>
          ))}
        </div>

        {/* CTA */}
        <div className="text-center">
          <Link href="/kurslar" className="btn btn-outline">
            Tüm Kursları Gör
            <ArrowRight className="w-5 h-5 ml-2" />
          </Link>
        </div>
      </div>
    </section>
  );
}
