"use client";

import { motion } from "framer-motion";
import { useState } from "react";
import { BookOpen, Mail, Check, ArrowRight, Download, Play } from "lucide-react";

export function FreeLeadCapture() {
  const [email, setEmail] = useState("");
  const [name, setName] = useState("");
  const [submitted, setSubmitted] = useState(false);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    // API call would go here
    setSubmitted(true);
  };

  return (
    <section className="py-20 gradient-bg relative overflow-hidden">
      {/* Background Pattern */}
      <div className="absolute inset-0 opacity-10">
        <div className="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAxOGMtOS45NDEgMC0xOCA4LjA1OS0xOCAxOHM4LjA1OSAxOCAxOCAxOCAxOC04LjA1OSAxOC0xOC04LjA1OS0xOC0xOC0xOHptMCAzMmMtNy43MzIgMC0xNC02LjI2OC0xNC0xNHM2LjI2OC0xNCAxNC0xNCAxNCA2LjI2OCAxNCAxNC02LjI2OCAxNC0xNCAxNHoiIGZpbGw9IiNmZmYiLz48L2c+PC9zdmc+')] bg-repeat" />
      </div>

      <div className="container-main relative">
        <div className="grid lg:grid-cols-2 gap-12 items-center">
          {/* Content */}
          <motion.div
            initial={{ opacity: 0, x: -20 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            className="text-white"
          >
            <div className="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
              <BookOpen className="w-4 h-4" />
              <span className="text-sm font-medium">Ücretsiz E-kitap</span>
            </div>

            <h2 className="text-3xl md:text-4xl font-display font-bold mb-6">
              &ldquo;Bilinçli Anne Baba Olmanın 7 Sırrı&rdquo;
            </h2>

            <p className="text-xl text-white/90 mb-8">
              Çocuğunuzla daha güçlü bir bağ kurmanızı sağlayacak, 
              deneyimli uzmanlar tarafından hazırlanan ücretsiz e-kitabımızı 
              hemen indirin.
            </p>

            <div className="space-y-4 mb-8">
              {[
                "Çocuklarla etkili iletişim teknikleri",
                "Tartışmaları çözüme kavuşturma yöntemleri",
                "Pozitif disiplin stratejileri",
                "Duygusal bağ kurmanın püf noktaları",
              ].map((item, index) => (
                <motion.div
                  key={index}
                  initial={{ opacity: 0, x: -20 }}
                  whileInView={{ opacity: 1, x: 0 }}
                  viewport={{ once: true }}
                  transition={{ delay: index * 0.1 }}
                  className="flex items-center gap-3"
                >
                  <div className="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0">
                    <Check className="w-4 h-4" />
                  </div>
                  <span>{item}</span>
                </motion.div>
              ))}
            </div>

            <div className="flex items-center gap-4 text-white/80">
              <div className="flex -space-x-2">
                <span className="w-8 h-8 rounded-full bg-white/30 flex items-center justify-center text-sm">👨</span>
                <span className="w-8 h-8 rounded-full bg-white/30 flex items-center justify-center text-sm">👩</span>
                <span className="w-8 h-8 rounded-full bg-white/30 flex items-center justify-center text-sm">👧</span>
              </div>
              <span className="text-sm">12.500+ aile indirdi</span>
            </div>
          </motion.div>

          {/* Form */}
          <motion.div
            initial={{ opacity: 0, x: 20 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
          >
            <div className="bg-surface rounded-3xl p-8 shadow-2xl">
              {!submitted ? (
                <form onSubmit={handleSubmit} className="space-y-6">
                  <div className="text-center mb-6">
                    <div className="w-16 h-16 rounded-2xl gradient-bg flex items-center justify-center mx-auto mb-4">
                      <Download className="w-8 h-8 text-white" />
                    </div>
                    <h3 className="font-display text-2xl font-semibold text-text">
                      Ücretsiz E-kitap
                    </h3>
                    <p className="text-text-muted">
                      Hemen indirin, ailenizi dönüştürün
                    </p>
                  </div>

                  <div>
                    <label className="label">Adınız</label>
                    <input
                      type="text"
                      value={name}
                      onChange={(e) => setName(e.target.value)}
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
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        placeholder="email@ornek.com"
                        className="input pl-12"
                        required
                      />
                    </div>
                  </div>

                  <button
                    type="submit"
                    className="btn btn-primary w-full text-lg py-4"
                  >
                    <Download className="w-5 h-5 mr-2" />
                    Ücretsiz İndir
                  </button>

                  <p className="text-xs text-text-muted text-center">
                    E-posta adresiniz asla paylaşılmayacaktır. Gizlilik politikamızı inceleyebilirsiniz.
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
                  <h3 className="font-display text-2xl font-semibold text-text mb-4">
                    Teşekkürler! 🎉
                  </h3>
                  <p className="text-text-muted mb-6">
                    E-kitabınız e-posta adresinize gönderildi. Ayrıca ücretsiz mini kursumuza da erişebilirsiniz.
                  </p>
                  <a href="/mini-kurs" className="btn btn-primary">
                    <Play className="w-5 h-5 mr-2" />
                    Ücretsiz Mini Kurs
                    <ArrowRight className="w-5 h-5 ml-2" />
                  </a>
                </motion.div>
              )}
            </div>
          </motion.div>
        </div>
      </div>
    </section>
  );
}
