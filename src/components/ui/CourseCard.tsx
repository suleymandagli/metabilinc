"use client";

import { motion } from "framer-motion";
import Link from "next/link";
import Image from "next/image";
import { Clock, Users, Star, ArrowRight, BookOpen } from "lucide-react";
import { formatPrice } from "@/lib/utils";

interface CourseCardProps {
  id: number;
  title: string;
  slug: string;
  shortDescription?: string;
  thumbnail?: string;
  price: number;
  discountedPrice?: number;
  duration: string;
  enrolledCount: number;
  rating: number;
  reviewCount: number;
  level: string;
  isFree?: boolean;
  category: string;
}

export function CourseCard({
  id,
  title,
  slug,
  shortDescription,
  thumbnail,
  price,
  discountedPrice,
  duration,
  enrolledCount,
  rating,
  reviewCount,
  level,
  isFree,
  category,
}: CourseCardProps) {
  const finalPrice = discountedPrice || price;
  const hasDiscount = discountedPrice && discountedPrice < price;
  const discountPercent = hasDiscount 
    ? Math.round((1 - discountedPrice! / price) * 100) 
    : 0;

  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      className="card card-hover group"
    >
      {/* Thumbnail */}
      <div className="relative h-48 bg-secondary overflow-hidden">
        {thumbnail ? (
          <Image
            src={thumbnail}
            alt={title}
            fill
            className="object-cover group-hover:scale-105 transition-transform duration-500"
          />
        ) : (
          <div className="absolute inset-0 flex items-center justify-center">
            <BookOpen className="w-16 h-16 text-primary/30" />
          </div>
        )}
        
        {/* Category Badge */}
        <div className="absolute top-4 left-4">
          <span className="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-medium text-primary">
            {category === 'aile' ? '👨‍👩‍👧 Aile' : category === 'evlilik' ? '💑 Evlilik' : '📚 Genel'}
          </span>
        </div>

        {/* Free Badge */}
        {isFree && (
          <div className="absolute top-4 right-4">
            <span className="bg-accent text-white px-3 py-1 rounded-full text-xs font-bold">
              ÜCRETSİZ
            </span>
          </div>
        )}

        {/* Gradient Overlay */}
        <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity" />
      </div>

      {/* Content */}
      <div className="p-6">
        <h3 className="font-display text-xl font-semibold mb-2 group-hover:text-primary transition-colors line-clamp-2">
          {title}
        </h3>
        
        {shortDescription && (
          <p className="text-text-muted text-sm mb-4 line-clamp-2">
            {shortDescription}
          </p>
        )}

        {/* Meta Info */}
        <div className="flex items-center gap-4 text-sm text-text-muted mb-4">
          <div className="flex items-center gap-1">
            <Clock className="w-4 h-4" />
            <span>{duration}</span>
          </div>
          <div className="flex items-center gap-1">
            <Users className="w-4 h-4" />
            <span>{enrolledCount.toLocaleString('tr-TR')}</span>
          </div>
          <div className="flex items-center gap-1">
            <Star className="w-4 h-4 fill-accent text-accent" />
            <span>{rating.toFixed(1)}</span>
          </div>
        </div>

        {/* Level */}
        <div className="mb-4">
          <span className="text-xs font-medium text-text-muted uppercase tracking-wide">
            {level === 'baslangic' ? 'Başlangıç' : level === 'orta' ? 'Orta' : 'İleri'} Seviye
          </span>
        </div>

        {/* Price & CTA */}
        <div className="flex items-center justify-between pt-4 border-t border-border">
          <div>
            {hasDiscount && (
              <span className="text-sm text-text-muted line-through">
                {formatPrice(price)}
              </span>
            )}
            <div className="flex items-center gap-2">
              <span className={`text-2xl font-bold ${isFree ? 'text-success' : 'text-primary'}`}>
                {isFree ? 'Ücretsiz' : formatPrice(finalPrice)}
              </span>
              {hasDiscount && (
                <span className="bg-accent/20 text-accent-dark px-2 py-0.5 rounded-full text-xs font-bold">
                  %{discountPercent}
                </span>
              )}
            </div>
          </div>
          
          <Link 
            href={`/kurs/${slug}`}
            className="btn btn-primary py-2 px-4 text-sm"
          >
            İncele
            <ArrowRight className="w-4 h-4 ml-1" />
          </Link>
        </div>
      </div>
    </motion.div>
  );
}
