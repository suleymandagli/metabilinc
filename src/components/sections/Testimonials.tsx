"use client";

import { motion } from "framer-motion";
import { Star, Quote } from "lucide-react";

const testimonials = [
  {
    id: 1,
    name: "Ayşe Y.",
    role: "Bilinçli Aile Okulu Mezunu",
    avatar: "👩‍👦",
    rating: 5,
    comment: "Çocuğumla ilişkim tamamen değişti. Artık onu dinlemeyi ve anlamayı öğrendim. Tartışmalar yerine konuşuyoruz. Bu kurs hayatımızı kurtardı!",
  },
  {
    id: 2,
    name: "Mehmet K.",
    role: "Bilinci Evlilik Akademisi Mezunu",
    avatar: "👨‍👩‍👧",
    rating: 5,
    comment: "Evliliğimizdeki iletişim sorunları çözüldü. Eşimle artık daha açık konuşabiliyoruz. Birbirimizi daha iyi anlıyoruz. Kesinlikle tavsiye ederim.",
  },
  {
    id: 3,
    name: "Zeynep T.",
    role: "Ebevehn",
    avatar: "👩‍👧‍👦",
    rating: 5,
    comment: "Ücretsiz mini kursla başladım, sonra tam kursa geçtim. Her kuruşuna değen bir yatırım. Çocuklarım artık bana güveniyor ve açıkça konuşuyor.",
  },
  {
    id: 4,
    name: "Ahmet M.",
    role: "Baba",
    avatar: "👨",
    rating: 5,
    comment: "İş yoğunluğundan dolayı aileme yeterli zaman ayıramıyordum. Bu kurs bana zaman yönetimini ve kaliteli zaman geçirmeyi öğretti.",
  },
];

export function Testimonials() {
  return (
    <section className="py-20 bg-white">
      <div className="container-main">
        {/* Header */}
        <div className="text-center mb-16">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="inline-flex items-center gap-2 bg-accent/10 px-4 py-2 rounded-full mb-4"
          >
            <Star className="w-4 h-4 text-accent" />
            <span className="text-sm font-medium text-accent-dark">Başarı Hikayeleri</span>
          </motion.div>
          
          <h2 className="section-title mb-4">
            Binlerce Ailenin <span className="gradient-text">Dönüşümü</span>
          </h2>
          
          <p className="section-subtitle mx-auto">
            Öğrencilerimizin deneyimleri ve başarı hikayeleri
          </p>
        </div>

        {/* Testimonials Grid */}
        <div className="grid md:grid-cols-2 gap-8">
          {testimonials.map((testimonial, index) => (
            <motion.div
              key={testimonial.id}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: index * 0.1 }}
              className="bg-secondary-light rounded-2xl p-8 relative"
            >
              <Quote className="absolute top-6 right-6 w-8 h-8 text-primary/20" />
              
              {/* Rating */}
              <div className="flex items-center gap-1 mb-4">
                {[...Array(testimonial.rating)].map((_, i) => (
                  <Star key={i} className="w-5 h-5 fill-accent text-accent" />
                ))}
              </div>
              
              {/* Comment */}
              <p className="text-text mb-6 leading-relaxed">
                &ldquo;{testimonial.comment}&rdquo;
              </p>
              
              {/* Author */}
              <div className="flex items-center gap-4">
                <div className="w-12 h-12 rounded-full bg-surface flex items-center justify-center text-2xl">
                  {testimonial.avatar}
                </div>
                <div>
                  <div className="font-semibold text-text">{testimonial.name}</div>
                  <div className="text-sm text-text-muted">{testimonial.role}</div>
                </div>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}
