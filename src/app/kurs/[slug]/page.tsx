"use client";

import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import Link from "next/link";
import Image from "next/image";
import { 
  Clock, Users, Star, Play, Check, ChevronDown, 
  ChevronUp, BookOpen, Award, MessageCircle, ArrowRight,
  Shield, Headphones, Clock4
} from "lucide-react";
import { formatPrice } from "@/lib/utils";

// Course data
const courseData = {
  id: 1,
  title: "Bilinçli Aile Okulu",
  slug: "bilincli-aile-okulu",
  description: "0-18 yaş çocuklarınızla daha sağlıklı iletişim kurun, etkili disiplin yöntemlerini öğrenin ve aile içi ilişkilerinizi güçlendirin. Bu kapsamlı program, çocuk gelişimi uzmanları tarafından hazırlanmış ve binlerce aile tarafından başarıyla tamamlanmıştır.",
  shortDescription: "0-18 yaş çocuklarınızla daha sağlıklı iletişim kurun. Etkili disiplin, duygusal bağ ve pozitif ebeveynlik tekniklerini öğrenin.",
  thumbnail: "",
  price: 1997,
  discountedPrice: 997,
  originalPrice: 1997,
  duration: "8 Hafta",
  totalHours: "40+ Saat",
  enrolledCount: 5234,
  rating: 4.9,
  reviewCount: 847,
  level: "baslangic",
  isFree: false,
  category: "aile",
  instructor: {
    name: "Uzm. Psikolog Ayşe Demir",
    title: "Çocuk ve Aile Psikoloğu",
    bio: "15+ yıl deneyimli, binlerce aileye yardımcı olmuş uzman eğitmen",
    avatar: "",
  },
  learningOutcomes: [
    "Çocuğunuzun duygularını anlama ve onunla empati kurma",
    "Etkili iletişim teknikleri ile bağınızı güçlendirme",
    "Pozitif disiplin yöntemlerini uygulama",
    "Çocuklarda özgüven ve motivasyon geliştirme",
    "Ekran süresi ve teknoloji yönetimi",
    "Okul başarısını destekleme stratejileri",
  ],
  requirements: [
    "Bilgisayar veya mobil cihaz",
    "İnternet bağlantısı",
    "Değişime açık olmak",
    "Haftada 2-3 saat eğitim zamanı",
  ],
  syllabus: [
    {
      title: "1. Modül: Çocuk Gelişimi Temelleri",
      lessons: [
        { title: "Yaş dönemlerine göre gelişim özellikleri", duration: "45 dk", isFree: true },
        { title: "Bilişsel, duygusal ve sosyal gelişim", duration: "50 dk", isFree: false },
        { title: "Bireysel farklılıkları anlama", duration: "40 dk", isFree: false },
      ]
    },
    {
      title: "2. Modül: Etkili İletişim",
      lessons: [
        { title: "Aktif dinleme teknikleri", duration: "55 dk", isFree: true },
        { title: "Duyguları ifade etme ve karşılama", duration: "45 dk", isFree: false },
        { title: "Sorgulamadan konuşma", duration: "40 dk", isFree: false },
        { title: "Non-verbal iletişim", duration: "35 dk", isFree: false },
      ]
    },
    {
      title: "3. Modül: Pozitif Disiplin",
      lessons: [
        { title: "Ceza yerine alternatifler", duration: "50 dk", isFree: false },
        { title: "Sınırlar koyma ve tutarlılık", duration: "45 dk", isFree: false },
        { title: "Davranış değişikliği stratejileri", duration: "55 dk", isFree: false },
      ]
    },
    {
      title: "4. Modül: Duygusal Bağ",
      lessons: [
        { title: "Güvenli bağlanma", duration: "45 dk", isFree: false },
        { title: "Duygusal ihtiyaçları karşılama", duration: "50 dk", isFree: false },
        { title: "Kaliteli zaman geçirme", duration: "40 dk", isFree: false },
      ]
    },
    {
      title: "5. Modül: Özgüven ve Motivasyon",
      lessons: [
        { title: "Çocuğun özgüvenini destekleme", duration: "45 dk", isFree: false },
        { title: "ç motivİasyon oluşturma", duration: "50 dk", isFree: false },
        { title: "Başarıyı kutlama", duration: "35 dk", isFree: false },
      ]
    },
    {
      title: "6. Modül: Teknoloji Yönetimi",
      lessons: [
        { title: "Ekran süresi sınırları", duration: "45 dk", isFree: false },
        { title: "Teknolojiyi yararlı kullanma", duration: "50 dk", isFree: false },
        { title: "Dijital ebeveynlik", duration: "40 dk", isFree: false },
      ]
    },
  ],
  faqs: [
    {
      question: "Bu kurs kimler için uygun?",
      answer: "0-18 yaş arasında çocuğu olan tüm anne-babalara uygundur. İster ilk çocuğunuz olsun, ister deneyimli bir ebeveyn olun, bu kurs size yeni perspektifler kazandıracaktır."
    },
    {
      question: "Kurs ne kadar sürer?",
      answer: "Toplam 8 hafta süren bu program, haftada 2-3 saatinizi alacaktır. İstediğiniz tempo ilerleyebilir, kursa lifetime erişim hakkınız vardır."
    },
    {
      question: "Para iade garantisi var mı?",
      answer: "Evet! 30 gün içinde memnun kalmazsanız, koşulsuz ve sorunsuz bir şekilde paranızı iade ediyoruz."
    },
    {
      question: "Sertifika alacak mıyım?",
      answer: "Kursu başarıyla tamamladığınızda, Metabilinc tarafından onaylı bir sertifika alacaksınız."
    },
    {
      question: "Kursu kimler veriyor?",
      answer: "Alanında uzman, 15+ yıl deneyimli çocuk ve aile psikologları tarafından hazırlanmış ve sunulmaktadır."
    },
  ],
  testimonials: [
    {
      name: "Zeynep K.",
      rating: 5,
      comment: "Kurs hayatımızı değiştirdi. Artık çocuğumla tartışmak yerine konuşuyoruz. Teşekkürler!",
    },
    {
      name: "Mehmet A.",
      rating: 5,
      comment: "Ergen oğlumla ilişkim düzeldi. Bu kursu almadan önce çözüm bulamıyorduk.",
    },
    {
      name: "Ayşe Y.",
      rating: 5,
      comment: "Her anne-baba bu kursu almalı. İlk çocuğumla çok zorlandım, ikincisinde çok daha bilinçliyim.",
    },
  ],
  features: [
    { icon: Clock4, title: "Lifetime Erişim", description: "Sınırsız tekrar izleme" },
    { icon: Award, title: "Sertifika", description: "Kurs tamamlama belgesi" },
    { icon: Headphones, title: "7/24 Destek", description: "Her zaman yanınızdayız" },
    { icon: Shield, title: "30 Gün İade", description: "Risksiz satın alma" },
  ],
};

export default function CourseDetailPage({ params }: { params: { slug: string } }) {
  const [expandedModules, setExpandedModules] = useState<number[]>([0]);
  const [activeFaq, setActiveFaq] = useState<number | null>(null);
  const [activeTab, setActiveTab] = useState<"overview" | "curriculum" | "reviews">("overview");

  const toggleModule = (index: number) => {
    setExpandedModules(prev => 
      prev.includes(index) 
        ? prev.filter(i => i !== index)
        : [...prev, index]
    );
  };

  const discountPercent = Math.round((1 - courseData.discountedPrice! / courseData.originalPrice) * 100);

  return (
    <div className="min-h-screen bg-background pt-24">
      {/* Hero Section */}
      <section className="bg-gradient-to-b from-secondary-light to-white py-16">
        <div className="container-main">
          <div className="grid lg:grid-cols-2 gap-12 items-center">
            {/* Content */}
            <motion.div
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
            >
              {/* Breadcrumb */}
              <div className="flex items-center gap-2 text-sm text-text-muted mb-6">
                <Link href="/" className="hover:text-primary">Ana Sayfa</Link>
                <span>/</span>
                <Link href="/kurslar" className="hover:text-primary">Kurslar</Link>
                <span>/</span>
                <span className="text-text">{courseData.title}</span>
              </div>

              <h1 className="text-4xl md:text-5xl font-display font-bold mb-6">
                {courseData.title}
              </h1>

              <p className="text-xl text-text-muted mb-8">
                {courseData.description}
              </p>

              {/* Stats */}
              <div className="flex flex-wrap items-center gap-6 mb-8">
                <div className="flex items-center gap-2">
                  <Star className="w-5 h-5 fill-accent text-accent" />
                  <span className="font-semibold">{courseData.rating}</span>
                  <span className="text-text-muted">({courseData.reviewCount} yorum)</span>
                </div>
                <div className="flex items-center gap-2">
                  <Users className="w-5 h-5 text-text-muted" />
                  <span>{courseData.enrolledCount.toLocaleString('tr-TR')} öğrenci</span>
                </div>
                <div className="flex items-center gap-2">
                  <Clock className="w-5 h-5 text-text-muted" />
                  <span>{courseData.duration}</span>
                </div>
              </div>

              {/* Instructor */}
              <div className="flex items-center gap-4">
                <div className="w-14 h-14 rounded-full bg-primary/20 flex items-center justify-center">
                  <span className="text-2xl">👩‍⚕️</span>
                </div>
                <div>
                  <div className="font-semibold">{courseData.instructor.name}</div>
                  <div className="text-sm text-text-muted">{courseData.instructor.title}</div>
                </div>
              </div>
            </motion.div>

            {/* Purchase Card */}
            <motion.div
              initial={{ opacity: 0, x: 20 }}
              animate={{ opacity: 1, x: 0 }}
              className="bg-surface rounded-3xl shadow-xl border border-border/50 overflow-hidden"
            >
              {/* Thumbnail */}
              <div className="relative h-64 bg-secondary">
                {courseData.thumbnail ? (
                  <Image src={courseData.thumbnail} alt={courseData.title} fill className="object-cover" />
                ) : (
                  <div className="absolute inset-0 flex items-center justify-center">
                    <div className="w-24 h-24 rounded-full bg-primary/20 flex items-center justify-center">
                      <Play className="w-10 h-10 text-primary ml-1" />
                    </div>
                  </div>
                )}
                <div className="absolute inset-0 bg-black/30 flex items-center justify-center">
                  <button className="w-20 h-20 rounded-full bg-white/90 flex items-center justify-center hover:scale-110 transition-transform">
                    <Play className="w-8 h-8 text-primary ml-1" />
                  </button>
                </div>
              </div>

              <div className="p-8">
                {/* Price */}
                <div className="flex items-center justify-between mb-6">
                  <div>
                    <span className="text-4xl font-bold text-primary">{formatPrice(courseData.discountedPrice!)}</span>
                    <span className="text-xl text-text-muted line-through ml-3">{formatPrice(courseData.originalPrice)}</span>
                  </div>
                  <span className="bg-accent text-white px-3 py-1 rounded-full font-bold">%{discountPercent} İndirim</span>
                </div>

                <Link href={`/odeme/${courseData.slug}`} className="btn btn-primary w-full text-lg py-4 mb-4">
                  Hemen Kaydol
                  <ArrowRight className="w-5 h-5 ml-2" />
                </Link>

                <p className="text-center text-text-muted text-sm mb-6">
                  30 gün para iade garantisi ✓
                </p>

                {/* Features */}
                <div className="space-y-3">
                  {courseData.features.map((feature, index) => (
                    <div key={index} className="flex items-center gap-3">
                      <div className="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                        <feature.icon className="w-4 h-4 text-primary" />
                      </div>
                      <span className="text-sm">{feature.title}</span>
                    </div>
                  ))}
                </div>
              </div>
            </motion.div>
          </div>
        </div>
      </section>

      {/* Tabs */}
      <section className="border-b border-border">
        <div className="container-main">
          <div className="flex gap-8">
            {(["overview", "curriculum", "reviews"] as const).map((tab) => (
              <button
                key={tab}
                onClick={() => setActiveTab(tab)}
                className={`py-4 px-2 font-medium border-b-2 transition-colors ${
                  activeTab === tab 
                    ? "border-primary text-primary" 
                    : "border-transparent text-text-muted hover:text-text"
                }`}
              >
                {tab === "overview" ? "Genel Bakış" : tab === "curriculum" ? "Müfredat" : "Yorumlar"}
              </button>
            ))}
          </div>
        </div>
      </section>

      {/* Content */}
      <section className="py-16">
        <div className="container-main">
          {activeTab === "overview" && (
            <div className="grid lg:grid-cols-3 gap-12">
              <div className="lg:col-span-2 space-y-12">
                {/* Learning Outcomes */}
                <div>
                  <h2 className="text-2xl font-display font-bold mb-6">Neler Öğreneceksiniz?</h2>
                  <div className="grid sm:grid-cols-2 gap-4">
                    {courseData.learningOutcomes.map((outcome, index) => (
                      <div key={index} className="flex items-start gap-3">
                        <div className="w-6 h-6 rounded-full bg-success/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                          <Check className="w-4 h-4 text-success" />
                        </div>
                        <span>{outcome}</span>
                      </div>
                    ))}
                  </div>
                </div>

                {/* Requirements */}
                <div>
                  <h2 className="text-2xl font-display font-bold mb-6">Gereksinimler</h2>
                  <ul className="space-y-3">
                    {courseData.requirements.map((req, index) => (
                      <li key={index} className="flex items-center gap-3">
                        <div className="w-2 h-2 rounded-full bg-primary" />
                        <span>{req}</span>
                      </li>
                    ))}
                  </ul>
                </div>

                {/* Instructor */}
                <div className="bg-secondary-light rounded-2xl p-8">
                  <h2 className="text-2xl font-display font-bold mb-6">Eğitmen</h2>
                  <div className="flex items-start gap-6">
                    <div className="w-20 h-20 rounded-2xl bg-primary/20 flex items-center justify-center flex-shrink-0">
                      <span className="text-4xl">👩‍⚕️</span>
                    </div>
                    <div>
                      <h3 className="text-xl font-semibold mb-2">{courseData.instructor.name}</h3>
                      <p className="text-primary font-medium mb-2">{courseData.instructor.title}</p>
                      <p className="text-text-muted">{courseData.instructor.bio}</p>
                    </div>
                  </div>
                </div>
              </div>

              {/* Sidebar */}
              <div>
                <div className="sticky top-28 space-y-8">
                  {/* Course Includes */}
                  <div className="bg-surface rounded-2xl p-6 border border-border/50">
                    <h3 className="font-semibold mb-4">Kurs İçeriği</h3>
                    <div className="space-y-3 text-sm">
                      <div className="flex justify-between">
                        <span className="text-text-muted">Süre</span>
                        <span>{courseData.totalHours}</span>
                      </div>
                      <div className="flex justify-between">
                        <span className="text-text-muted">Modül</span>
                        <span>{courseData.syllabus.length}</span>
                      </div>
                      <div className="flex justify-between">
                        <span className="text-text-muted">Ders</span>
                        <span>{courseData.syllabus.reduce((acc, m) => acc + m.lessons.length, 0)}</span>
                      </div>
                      <div className="flex justify-between">
                        <span className="text-text-muted">Sertifika</span>
                        <span>Evet</span>
                      </div>
                      <div className="flex justify-between">
                        <span className="text-text-muted">Erişim</span>
                      <span>Ömür Boyu</span>
                      </div>
                    </div>
                  </div>

                  {/* Share */}
                  <div className="bg-surface rounded-2xl p-6 border border-border/50">
                    <h3 className="font-semibold mb-4">Paylaş</h3>
                    <div className="flex gap-3">
                      <button className="w-10 h-10 rounded-full bg-primary/10 hover:bg-primary hover:text-white transition-colors flex items-center justify-center">
                        <span className="text-lg">📱</span>
                      </button>
                      <button className="w-10 h-10 rounded-full bg-primary/10 hover:bg-primary hover:text-white transition-colors flex items-center justify-center">
                        <span className="text-lg">✉️</span>
                      </button>
                      <button className="w-10 h-10 rounded-full bg-primary/10 hover:bg-primary hover:text-white transition-colors flex items-center justify-center">
                        <span className="text-lg">💬</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          )}

          {activeTab === "curriculum" && (
            <div className="max-w-4xl mx-auto">
              <h2 className="text-2xl font-display font-bold mb-8">Kurs Müfredatı</h2>
              <div className="space-y-4">
                {courseData.syllabus.map((module, moduleIndex) => (
                  <div key={moduleIndex} className="bg-surface rounded-2xl border border-border/50 overflow-hidden">
                    <button
                      onClick={() => toggleModule(moduleIndex)}
                      className="w-full p-6 flex items-center justify-between hover:bg-secondary-light/50 transition-colors"
                    >
                      <div className="flex items-center gap-4">
                        <span className="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                          {moduleIndex + 1}
                        </span>
                        <div className="text-left">
                          <h3 className="font-semibold">{module.title}</h3>
                          <p className="text-sm text-text-muted">{module.lessons.length} ders</p>
                        </div>
                      </div>
                      {expandedModules.includes(moduleIndex) ? (
                        <ChevronUp className="w-5 h-5 text-text-muted" />
                      ) : (
                        <ChevronDown className="w-5 h-5 text-text-muted" />
                      )}
                    </button>
                    
                    <AnimatePresence>
                      {expandedModules.includes(moduleIndex) && (
                        <motion.div
                          initial={{ height: 0, opacity: 0 }}
                          animate={{ height: "auto", opacity: 1 }}
                          exit={{ height: 0, opacity: 0 }}
                          className="border-t border-border"
                        >
                          <div className="p-4 bg-secondary-light/30 space-y-2">
                            {module.lessons.map((lesson, lessonIndex) => (
                              <div
                                key={lessonIndex}
                                className="flex items-center justify-between p-3 bg-surface rounded-lg"
                              >
                                <div className="flex items-center gap-3">
                                  {lesson.isFree ? (
                                    <span className="text-success text-sm font-medium">ÜCRETSİZ</span>
                                  ) : (
                                    <Play className="w-4 h-4 text-text-muted" />
                                  )}
                                  <span>{lesson.title}</span>
                                </div>
                                <span className="text-sm text-text-muted">{lesson.duration}</span>
                              </div>
                            ))}
                          </div>
                        </motion.div>
                      )}
                    </AnimatePresence>
                  </div>
                ))}
              </div>
            </div>
          )}

          {activeTab === "reviews" && (
            <div className="max-w-4xl mx-auto">
              <h2 className="text-2xl font-display font-bold mb-8">Öğrenci Yorumları</h2>
              <div className="space-y-6">
                {courseData.testimonials.map((testimonial, index) => (
                  <div key={index} className="bg-surface rounded-2xl p-6 border border-border/50">
                    <div className="flex items-center justify-between mb-4">
                      <div className="flex items-center gap-3">
                        <div className="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center">
                          <span className="text-xl">{testimonial.name[0]}</span>
                        </div>
                        <div>
                          <div className="font-semibold">{testimonial.name}</div>
                          <div className="flex gap-1">
                            {[...Array(testimonial.rating)].map((_, i) => (
                              <Star key={i} className="w-4 h-4 fill-accent text-accent" />
                            ))}
                          </div>
                        </div>
                      </div>
                    </div>
                    <p className="text-text-muted">&ldquo;{testimonial.comment}&rdquo;</p>
                  </div>
                ))}
              </div>
            </div>
          )}
        </div>
      </section>

      {/* FAQ Section */}
      <section className="py-16 bg-secondary-light">
        <div className="container-main">
          <h2 className="text-3xl font-display font-bold text-center mb-12">
            Sıkça Sorulan <span className="gradient-text">Sorular</span>
          </h2>
          <div className="max-w-3xl mx-auto space-y-4">
            {courseData.faqs.map((faq, index) => (
              <div key={index} className="bg-surface rounded-2xl overflow-hidden">
                <button
                  onClick={() => setActiveFaq(activeFaq === index ? null : index)}
                  className="w-full p-6 flex items-center justify-between text-left"
                >
                  <span className="font-semibold pr-8">{faq.question}</span>
                  {activeFaq === index ? (
                    <ChevronUp className="w-5 h-5 text-primary flex-shrink-0" />
                  ) : (
                    <ChevronDown className="w-5 h-5 text-text-muted flex-shrink-0" />
                  )}
                </button>
                <AnimatePresence>
                  {activeFaq === index && (
                    <motion.div
                      initial={{ height: 0, opacity: 0 }}
                      animate={{ height: "auto", opacity: 1 }}
                      exit={{ height: 0, opacity: 0 }}
                      className="px-6 pb-6"
                    >
                      <p className="text-text-muted">{faq.answer}</p>
                    </motion.div>
                  )}
                </AnimatePresence>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-16 gradient-bg">
        <div className="container-main text-center text-white">
          <h2 className="text-3xl md:text-4xl font-display font-bold mb-6">
            Hemen Bugün Başlayın
          </h2>
          <p className="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
            Ailenizin geleceğini bugünden değiştirin. 
            30 gün para iade garantisi ile risk sizin.
          </p>
          <Link href={`/odeme/${courseData.slug}`} className="btn bg-white text-primary hover:bg-secondary text-lg px-8 py-4">
            Kursa Kaydol
            <ArrowRight className="w-5 h-5 ml-2" />
          </Link>
        </div>
      </section>
    </div>
  );
}
