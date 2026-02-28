"use client";

import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import Link from "next/link";
import { 
  Play, Check, Mail, Lock, ArrowRight, BookOpen, 
  Clock, Users, Award, Star
} from "lucide-react";

const miniCourses = [
  {
    id: 1,
    slug: "cocuklarla-etkili-iletisim",
    title: "Çocuklarla Etkili İletişim",
    description: "Çocuğunuzun duygularını anlayın ve onunla daha iyi bir bağ kurun.",
    duration: "2 Saat",
    lessons: 8,
    thumbnail: "",
    category: "aile",
  },
  {
    id: 2,
    slug: "pozitif-disiplin",
    title: "Pozitif Disiplin Rehberi",
    description: "Ceza yerine etkili disiplin yöntemlerini öğrenin.",
    duration: "1.5 Saat",
    lessons: 6,
    thumbnail: "",
    category: "aile",
  },
  {
    id: 3,
    slug: "evlilik-iletisimi",
    title: "Evlilikte Sağlıklı İletişim",
    description: "Eşinizle daha açık ve etkili iletişim kurun.",
    duration: "2 Saat",
    lessons: 7,
    thumbnail: "",
    category: "evlilik",
  },
];

export default function MiniKursPage() {
  const [selectedCourse, setSelectedCourse] = useState(miniCourses[0]);
  const [formData, setFormData] = useState({ name: "", email: "", phone: "" });
  const [submitted, setSubmitted] = useState(false);
  const [isLoading, setIsLoading] = useState(false);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsLoading(true);
    
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 1500));
    
    setSubmitted(true);
    setIsLoading(false);
  };

  return (
    <div className="min-h-screen bg-background pt-24 pb-20">
      <div className="container-main">
        {/* Header */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          className="text-center mb-16"
        >
          <div className="inline-flex items-center gap-2 bg-accent/10 px-4 py-2 rounded-full mb-6">
            <BookOpen className="w-4 h-4 text-accent" />
            <span className="text-sm font-medium text-accent-dark">Ücretsiz Mini Kurslar</span>
          </div>
          
          <h1 className="section-title mb-6">
            Bilinçli Ebeveynliğe <span className="gradient-text">İlk Adımınızı</span> Atın
          </h1>
          
          <p className="text-xl text-text-muted max-w-2xl mx-auto">
            Ücretsiz mini kurslarımızla ebeveynlik yolculuğunuzda ilk adımları atın.
            Hemen başlayın, ailenizi dönüştürün.
          </p>
        </motion.div>

        <div className="grid lg:grid-cols-2 gap-12">
          {/* Course Selection */}
          <motion.div
            initial={{ opacity: 0, x: -20 }}
            animate={{ opacity: 1, x: 0 }}
          >
            <h2 className="text-2xl font-display font-bold mb-6">Mini Kurslar</h2>
            <div className="space-y-4">
              {miniCourses.map((course) => (
                <button
                  key={course.id}
                  onClick={() => setSelectedCourse(course)}
                  className={`w-full text-left p-6 rounded-2xl border transition-all ${
                    selectedCourse.id === course.id
                      ? "bg-primary text-white border-primary"
                      : "bg-surface border-border hover:border-primary/50"
                  }`}
                >
                  <div className="flex items-center justify-between">
                    <div>
                      <h3 className={`font-semibold mb-2 ${selectedCourse.id === course.id ? "text-white" : "text-text"}`}>
                        {course.title}
                      </h3>
                      <p className={`text-sm ${selectedCourse.id === course.id ? "text-white/80" : "text-text-muted"}`}>
                        {course.description}
                      </p>
                    </div>
                    <div className={`w-12 h-12 rounded-full flex items-center justify-center ${
                      selectedCourse.id === course.id ? "bg-white/20" : "bg-primary/10"
                    }`}>
                      <Play className={`w-5 h-5 ${selectedCourse.id === course.id ? "text-white" : "text-primary"}`} />
                    </div>
                  </div>
                  <div className={`flex items-center gap-4 mt-4 text-sm ${
                    selectedCourse.id === course.id ? "text-white/80" : "text-text-muted"
                  }`}>
                    <div className="flex items-center gap-1">
                      <Clock className="w-4 h-4" />
                      <span>{course.duration}</span>
                    </div>
                    <div className="flex items-center gap-1">
                      <BookOpen className="w-4 h-4" />
                      <span>{course.lessons} ders</span>
                    </div>
                  </div>
                </button>
              ))}
            </div>
          </motion.div>

          {/* Registration Form */}
          <motion.div
            initial={{ opacity: 0, x: 20 }}
            animate={{ opacity: 1, x: 0 }}
          >
            <div className="bg-surface rounded-3xl shadow-xl border border-border/50 overflow-hidden sticky top-28">
              {/* Course Preview */}
              <div className="bg-gradient-to-br from-primary to-primary-light p-8 text-white">
                <h3 className="text-2xl font-display font-bold mb-2">
                  {selectedCourse.title}
                </h3>
                <p className="text-white/90 mb-6">
                  {selectedCourse.description}
                </p>
                <div className="flex items-center gap-4 text-sm">
                  <div className="flex items-center gap-1">
                    <Clock className="w-4 h-4" />
                    <span>{selectedCourse.duration}</span>
                  </div>
                  <div className="flex items-center gap-1">
                    <BookOpen className="w-4 h-4" />
                    <span>{selectedCourse.lessons} Ders</span>
                  </div>
                </div>
              </div>

              {/* Form */}
              <div className="p-8">
                {!submitted ? (
                  <form onSubmit={handleSubmit} className="space-y-6">
                    <div className="text-center mb-6">
                      <h4 className="font-display text-xl font-semibold">Ücretsiz Kaydol</h4>
                      <p className="text-text-muted text-sm">
                        Bu mini kursa hemen erişin
                      </p>
                    </div>

                    <div>
                      <label className="label">Adınız</label>
                      <input
                        type="text"
                        value={formData.name}
                        onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                        placeholder="Adınızı girin"
                        className="input"
                        required
                      />
                    </div>

                    <div>
                      <label className="label">E-posta Adresiniz</label>
                      <div className="relative">
                        <Mail className="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-text-muted" />
                        <input
                          type="email"
                          value={formData.email}
                          onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                          placeholder="email@ornek.com"
                          className="input pl-12"
                          required
                        />
                      </div>
                    </div>

                    <div>
                      <label className="label">Telefon (İsteğe Bağlı)</label>
                      <input
                        type="tel"
                        value={formData.phone}
                        onChange={(e) => setFormData({ ...formData, phone: e.target.value })}
                        placeholder="+90 5XX XXX XX XX"
                        className="input"
                      />
                    </div>

                    <button
                      type="submit"
                      disabled={isLoading}
                      className="btn btn-primary w-full text-lg py-4 disabled:opacity-50"
                    >
                      {isLoading ? (
                        <span className="flex items-center gap-2">
                          <span className="w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin" />
                          Kaydediliyor...
                        </span>
                      ) : (
                        <>
                          <Play className="w-5 h-5 mr-2" />
                          Hemen Başla
                          <ArrowRight className="w-5 h-5 ml-2" />
                        </>
                      )}
                    </button>

                    <p className="text-xs text-text-muted text-center">
                      Kayıt olarak gizlilik politikamızı kabul etmiş olursunuz.
                    </p>
                  </form>
                ) : (
                  <motion.div
                    initial={{ opacity: 0, scale: 0.9 }}
                    animate={{ opacity: 1, scale: 1 }}
                    className="text-center py-8"
                  >
                    <div className="w-20 h-20 rounded-full bg-success/20 flex items-center justify-center mx-auto mb-6">
                      <Check className="w-10 h-10 text-success" />
                    </div>
                    <h3 className="font-display text-2xl font-semibold mb-4">
                      Hoş Geldiniz! 🎉
                    </h3>
                    <p className="text-text-muted mb-6">
                      {selectedCourse.title} kursuna erişim sağladınız. 
                      E-posta adresinize erişim linki gönderildi.
                    </p>
                    
                    <div className="bg-secondary-light rounded-xl p-6 mb-6">
                      <h4 className="font-semibold mb-4">Kurs İçeriği:</h4>
                      <ul className="space-y-3 text-sm">
                        <li className="flex items-center gap-3">
                          <Check className="w-4 h-4 text-success" />
                          <span>Video dersler</span>
                        </li>
                        <li className="flex items-center gap-3">
                          <Check className="w-4 h-4 text-success" />
                          <span>Çalışma materyalleri</span>
                        </li>
                        <li className="flex items-center gap-3">
                          <Check className="w-4 h-4 text-success" />
                          <span>Sertifika</span>
                        </li>
                      </ul>
                    </div>

                    <Link href="/dashboard" className="btn btn-primary">
                      Kursa Git
                      <ArrowRight className="w-5 h-5 ml-2" />
                    </Link>
                  </motion.div>
                )}
              </div>
            </div>
          </motion.div>
        </div>

        {/* Social Proof */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="mt-20 bg-secondary-light rounded-3xl p-12"
        >
          <div className="grid md:grid-cols-3 gap-8 text-center">
            <div>
              <div className="text-4xl font-bold text-primary mb-2">12.500+</div>
              <div className="text-text-muted">Kayıtlı Öğrenci</div>
            </div>
            <div>
              <div className="text-4xl font-bold text-primary mb-2">4.9</div>
              <div className="text-text-muted">Ortalama Puan</div>
            </div>
            <div>
              <div className="text-4xl font-bold text-primary mb-2">%95</div>
              <div className="text-text-muted">Memnuniyet Oranı</div>
            </div>
          </div>
        </motion.div>

        {/* What's Included */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="mt-20"
        >
          <h2 className="text-3xl font-display font-bold text-center mb-12">
            Neler Dahil?
          </h2>
          <div className="grid md:grid-cols-4 gap-6">
            {[
              { icon: Play, title: "Video İçerikler", desc: "Uzman eğitmen videoları" },
              { icon: BookOpen, title: "Materyaller", desc: "Indirilebilir kaynaklar" },
              { icon: Award, title: "Sertifika", desc: "Kurs tamamlama belgesi" },
              { icon: Users, title: "Destek", desc: "Soru-cevap imkanı" },
            ].map((item, index) => (
              <div key={index} className="bg-surface rounded-2xl p-6 border border-border/50 text-center">
                <div className="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center mx-auto mb-4">
                  <item.icon className="w-7 h-7 text-primary" />
                </div>
                <h3 className="font-semibold mb-2">{item.title}</h3>
                <p className="text-sm text-text-muted">{item.desc}</p>
              </div>
            ))}
          </div>
        </motion.div>
      </div>
    </div>
  );
}
