"use client";

import { motion } from "framer-motion";
import Link from "next/link";
import { ArrowRight, Play, Heart, Users, BookOpen } from "lucide-react";

export function HeroSection() {
  return (
    <section className="relative min-h-screen flex items-center overflow-hidden pt-20">
      {/* Background */}
      <div className="absolute inset-0 gradient-bg opacity-5" />
      <div className="absolute top-20 right-0 w-[600px] h-[600px] bg-accent/10 rounded-full blur-3xl" />
      <div className="absolute bottom-0 left-0 w-[400px] h-[400px] bg-primary/10 rounded-full blur-3xl" />

      <div className="container-main relative">
        <div className="grid lg:grid-cols-2 gap-12 items-center">
          {/* Content */}
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
          >
            <div className="inline-flex items-center gap-2 bg-secondary px-4 py-2 rounded-full mb-6">
              <span className="w-2 h-2 bg-accent rounded-full animate-pulse" />
              <span className="text-sm font-medium text-text">
                📚 Yeni dönem kayıtları başladı
              </span>
            </div>

            <h1 className="section-title mb-6 leading-tight">
              Bilinçli Anne Baba{" "}
              <span className="gradient-text">Olma Yolculuğunuz</span> Burada Başlıyor
            </h1>

            <p className="text-xl text-text-muted mb-8 max-w-xl">
              Çocuğunuzla daha sağlıklı iletişim kurun, aile içi 
              ilişkilerinizi güçlendirin ve hayatınızı dönüştürün.
            </p>

            <div className="flex flex-col sm:flex-row gap-4 mb-12">
              <Link href="/kurslar" className="btn btn-primary text-lg px-8 py-4">
                Kursları Keşfet
                <ArrowRight className="w-5 h-5 ml-2" />
              </Link>
              <Link href="/mini-kurs" className="btn btn-secondary text-lg px-8 py-4">
                <Play className="w-5 h-5 mr-2" />
                Ücretsiz Demo
              </Link>
            </div>

            {/* Stats */}
            <div className="grid grid-cols-3 gap-6">
              <div className="text-center">
                <div className="text-3xl font-bold text-primary">5000+</div>
                <div className="text-sm text-text-muted">Aile</div>
              </div>
              <div className="text-center">
                <div className="text-3xl font-bold text-primary">50+</div>
                <div className="text-sm text-text-muted">Eğitim</div>
              </div>
              <div className="text-center">
                <div className="text-3xl font-bold text-primary">4.9</div>
                <div className="text-sm text-text-muted">Puan</div>
              </div>
            </div>
          </motion.div>

          {/* Visual */}
          <motion.div
            initial={{ opacity: 0, x: 20 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ duration: 0.6, delay: 0.2 }}
            className="relative hidden lg:block"
          >
            <div className="relative">
              {/* Main Card */}
              <div className="bg-surface rounded-3xl shadow-2xl p-8 border border-border/50">
                <div className="flex items-center gap-4 mb-6">
                  <div className="w-16 h-16 rounded-2xl gradient-bg flex items-center justify-center">
                    <Heart className="w-8 h-8 text-white" />
                  </div>
                  <div>
                    <h3 className="font-display text-xl font-semibold">Bilinçli Aile Okulu</h3>
                    <p className="text-text-muted">0-18 yaş çocuklar için</p>
                  </div>
                </div>
                
                <div className="space-y-3 mb-6">
                  <div className="flex items-center gap-3 text-text">
                    <Users className="w-5 h-5 text-primary" />
                    <span>Etkili İletişim Teknikleri</span>
                  </div>
                  <div className="flex items-center gap-3 text-text">
                    <BookOpen className="w-5 h-5 text-primary" />
                    <span>Pozitif Disiplin Yöntemleri</span>
                  </div>
                  <div className="flex items-center gap-3 text-text">
                    <Heart className="w-5 h-5 text-primary" />
                    <span>Duygusal Bağ Kurma</span>
                  </div>
                </div>

                <div className="flex items-center justify-between pt-4 border-t border-border">
                  <div>
                    <span className="text-3xl font-bold text-primary">₺997</span>
                    <span className="text-text-muted line-through ml-2">₺1997</span>
                  </div>
                  <span className="bg-accent/20 text-accent-dark px-3 py-1 rounded-full text-sm font-medium">
                    %50 İndirim
                  </span>
                </div>
              </div>

              {/* Floating Elements */}
              <motion.div
                animate={{ y: [0, -10, 0] }}
                transition={{ duration: 3, repeat: Infinity }}
                className="absolute -top-6 -right-6 bg-surface rounded-2xl shadow-xl p-4 border border-border/50"
              >
                <div className="flex items-center gap-3">
                  <div className="w-10 h-10 bg-success/20 rounded-full flex items-center justify-center">
                    <span className="text-xl">⭐</span>
                  </div>
                  <div>
                    <div className="font-semibold">4.9/5</div>
                    <div className="text-xs text-text-muted">Puan</div>
                  </div>
                </div>
              </motion.div>

              <motion.div
                animate={{ y: [0, 10, 0] }}
                transition={{ duration: 4, repeat: Infinity }}
                className="absolute -bottom-6 -left-6 bg-surface rounded-2xl shadow-xl p-4 border border-border/50"
              >
                <div className="flex items-center gap-3">
                  <div className="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center">
                    <Users className="w-5 h-5 text-primary" />
                  </div>
                  <div>
                    <div className="font-semibold">5000+</div>
                    <div className="text-xs text-text-muted">Mezun</div>
                  </div>
                </div>
              </motion.div>
            </div>
          </motion.div>
        </div>
      </div>
    </section>
  );
}
