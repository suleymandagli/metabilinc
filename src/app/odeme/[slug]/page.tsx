"use client";

import { useState } from "react";
import { motion } from "framer-motion";
import Link from "next/link";
import Image from "next/image";
import { 
  CreditCard, Lock, Check, ArrowLeft, Shield, 
  Smartphone, Building, ArrowRight, ShoppingCart
} from "lucide-react";
import { formatPrice } from "@/lib/utils";

// Course data
const courseData = {
  id: 1,
  title: "Bilinçli Aile Okulu",
  slug: "bilincli-aile-okulu",
  description: "0-18 yaş çocuklarınızla daha sağlıklı iletişim kurun.",
  thumbnail: "",
  price: 1997,
  discountedPrice: 997,
  originalPrice: 1997,
};

const paymentMethods = [
  { id: "iyzico", name: "Kredi Kartı", icon: CreditCard, description: "Tüm kartlarla tek çekim ve taksit" },
  { id: "paytr", name: "PayTR", icon: Smartphone, description: "Havale, EFT, Papara" },
];

export default function PaymentPage({ params }: { params: { slug: string } }) {
  const [selectedMethod, setSelectedMethod] = useState("iyzico");
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    phone: "",
    cardNumber: "",
    expiryDate: "",
    cvv: "",
  });
  const [isProcessing, setIsProcessing] = useState(false);
  const [paymentSuccess, setPaymentSuccess] = useState(false);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsProcessing(true);
    
    // Simulate payment processing
    await new Promise(resolve => setTimeout(resolve, 3000));
    
    setPaymentSuccess(true);
    setIsProcessing(false);
  };

  const discountPercent = Math.round((1 - courseData.discountedPrice! / courseData.originalPrice) * 100);

  if (paymentSuccess) {
    return (
      <div className="min-h-screen bg-background pt-24 pb-20">
        <div className="container-main">
          <motion.div
            initial={{ opacity: 0, scale: 0.9 }}
            animate={{ opacity: 1, scale: 1 }}
            className="max-w-lg mx-auto text-center"
          >
            <div className="w-24 h-24 rounded-full bg-success/20 flex items-center justify-center mx-auto mb-8">
              <Check className="w-12 h-12 text-success" />
            </div>
            
            <h1 className="text-3xl font-display font-bold mb-4">
              Ödemeniz Başarılı! 🎉
            </h1>
            
            <p className="text-text-muted mb-8">
              Tebrikler! &ldquo;{courseData.title}&rdquo; kursuna kaydoldunuz. 
              E-posta adresinize kurs erişim bilgileri gönderildi.
            </p>

            <div className="bg-surface rounded-2xl p-6 border border-border/50 mb-8">
              <h3 className="font-semibold mb-4">Sipariş Özeti</h3>
              <div className="space-y-3 text-sm">
                <div className="flex justify-between">
                  <span className="text-text-muted">Kurs</span>
                  <span className="font-medium">{courseData.title}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-text-muted">Ödeme Yöntemi</span>
                  <span className="font-medium">
                    {selectedMethod === "iyzico" ? "Kredi Kartı" : "PayTR"}
                  </span>
                </div>
                <div className="flex justify-between pt-3 border-t border-border">
                  <span className="text-text-muted">Toplam</span>
                  <span className="text-xl font-bold text-primary">
                    {formatPrice(courseData.discountedPrice!)}
                  </span>
                </div>
              </div>
            </div>

            <Link href="/dashboard" className="btn btn-primary">
              Kurslarım
              <ArrowRight className="w-5 h-5 ml-2" />
            </Link>

            <p className="mt-6 text-sm text-text-muted">
              Sorularınız için <a href="#" className="text-primary underline">destek@metabilinc.com</a>
            </p>
          </motion.div>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-background pt-24 pb-20">
      <div className="container-main">
        {/* Back Link */}
        <Link 
          href={`/kurs/${courseData.slug}`}
          className="inline-flex items-center gap-2 text-text-muted hover:text-primary mb-8"
        >
          <ArrowLeft className="w-5 h-5" />
          <span>Kursa geri dön</span>
        </Link>

        <div className="grid lg:grid-cols-2 gap-12">
          {/* Payment Form */}
          <motion.div
            initial={{ opacity: 0, x: -20 }}
            animate={{ opacity: 1, x: 0 }}
          >
            <h1 className="text-3xl font-display font-bold mb-8">
              Ödeme Yap
            </h1>

            {/* Payment Method Selection */}
            <div className="mb-8">
              <h2 className="font-semibold mb-4">Ödeme Yöntemi</h2>
              <div className="grid grid-cols-2 gap-4">
                {paymentMethods.map((method) => (
                  <button
                    key={method.id}
                    onClick={() => setSelectedMethod(method.id)}
                    className={`p-4 rounded-xl border-2 text-left transition-all ${
                      selectedMethod === method.id
                        ? "border-primary bg-primary/5"
                        : "border-border hover:border-primary/50"
                    }`}
                  >
                    <div className="flex items-center gap-3 mb-2">
                      <method.icon className={`w-6 h-6 ${
                        selectedMethod === method.id ? "text-primary" : "text-text-muted"
                      }`} />
                      <span className="font-semibold">{method.name}</span>
                    </div>
                    <p className="text-xs text-text-muted">{method.description}</p>
                  </button>
                ))}
              </div>
            </div>

            {/* Customer Info */}
            <form onSubmit={handleSubmit} className="space-y-6">
              <div>
                <h2 className="font-semibold mb-4">Kişisel Bilgiler</h2>
                <div className="grid sm:grid-cols-2 gap-4">
                  <div>
                    <label className="label">Ad Soyad</label>
                    <input
                      type="text"
                      value={formData.name}
                      onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                      placeholder="Adınız Soyadınız"
                      className="input"
                      required
                    />
                  </div>
                  <div>
                    <label className="label">E-posta</label>
                    <input
                      type="email"
                      value={formData.email}
                      onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                      placeholder="email@ornek.com"
                      className="input"
                      required
                    />
                  </div>
                </div>
                <div className="mt-4">
                  <label className="label">Telefon</label>
                  <input
                    type="tel"
                    value={formData.phone}
                    onChange={(e) => setFormData({ ...formData, phone: e.target.value })}
                    placeholder="+90 5XX XXX XX XX"
                    className="input"
                    required
                  />
                </div>
              </div>

              {/* Card Info (for Iyzico) */}
              {selectedMethod === "iyzico" && (
                <div>
                  <h2 className="font-semibold mb-4">Kart Bilgileri</h2>
                  <div className="space-y-4">
                    <div>
                      <label className="label">Kart Numarası</label>
                      <input
                        type="text"
                        value={formData.cardNumber}
                        onChange={(e) => setFormData({ ...formData, cardNumber: e.target.value })}
                        placeholder="0000 0000 0000 0000"
                        className="input"
                        maxLength={19}
                        required
                      />
                    </div>
                    <div className="grid grid-cols-2 gap-4">
                      <div>
                        <label className="label">Son Kullanma</label>
                        <input
                          type="text"
                          value={formData.expiryDate}
                          onChange={(e) => setFormData({ ...formData, expiryDate: e.target.value })}
                          placeholder="AA/YY"
                          className="input"
                          maxLength={5}
                          required
                        />
                      </div>
                      <div>
                        <label className="label">CVV</label>
                        <input
                          type="text"
                          value={formData.cvv}
                          onChange={(e) => setFormData({ ...formData, cvv: e.target.value })}
                          placeholder="000"
                          className="input"
                          maxLength={4}
                          required
                        />
                      </div>
                    </div>
                  </div>
                </div>
              )}

              {/* Installment Selection (for Iyzico) */}
              {selectedMethod === "iyzico" && (
                <div>
                  <label className="label">Taksit Seçeneği</label>
                  <select className="input">
                    <option value="1">Tek Çekim - {formatPrice(courseData.discountedPrice!)}</option>
                    <option value="2">2 Taksit - {formatPrice(courseData.discountedPrice! / 2)} x 2</option>
                    <option value="3">3 Taksit - {formatPrice(courseData.discountedPrice! / 3)} x 3</option>
                    <option value="6">6 Taksit - {formatPrice(courseData.discountedPrice! / 6)} x 6</option>
                    <option value="9">9 Taksit - {formatPrice(courseData.discountedPrice! / 9)} x 9</option>
                    <option value="12">12 Taksit - {formatPrice(courseData.discountedPrice! / 12)} x 12</option>
                  </select>
                </div>
              )}

              {/* Security Info */}
              <div className="flex items-center gap-3 p-4 bg-success/10 rounded-xl">
                <Lock className="w-5 h-5 text-success" />
                <div className="text-sm">
                  <span className="font-semibold text-success">Güvenli Ödeme</span>
                  <span className="text-text-muted"> - 256-bit SSL şifreleme</span>
                </div>
              </div>

              {/* Submit Button */}
              <button
                type="submit"
                disabled={isProcessing}
                className="btn btn-primary w-full text-lg py-4 disabled:opacity-50"
              >
                {isProcessing ? (
                  <span className="flex items-center gap-2">
                    <span className="w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin" />
                    İşleniyor...
                  </span>
                ) : (
                  <>
                    <ShoppingCart className="w-5 h-5 mr-2" />
                    {formatPrice(courseData.discountedPrice!)} Öde
                  </>
                )}
              </button>

              <p className="text-xs text-text-muted text-center">
                Ödemeyi yaparak <a href="#" className="underline">Kullanım Şartları</a> ve <a href="#" className="underline">Gizlilik Politikası</a>&apos;nı kabul etmiş olursunuz.
              </p>
            </form>
          </motion.div>

          {/* Order Summary */}
          <motion.div
            initial={{ opacity: 0, x: 20 }}
            animate={{ opacity: 1, x: 0 }}
          >
            <div className="bg-surface rounded-3xl shadow-xl border border-border/50 overflow-hidden sticky top-28">
              {/* Course Preview */}
              <div className="relative h-48 bg-secondary">
                {courseData.thumbnail ? (
                  <Image src={courseData.thumbnail} alt={courseData.title} fill className="object-cover" />
                ) : (
                  <div className="absolute inset-0 flex items-center justify-center">
                    <div className="w-20 h-20 rounded-full bg-primary/20 flex items-center justify-center">
                      <span className="text-4xl">📚</span>
                    </div>
                  </div>
                )}
              </div>

              <div className="p-8">
                <h3 className="font-display text-xl font-semibold mb-4">
                  {courseData.title}
                </h3>
                <p className="text-text-muted text-sm mb-6">
                  {courseData.description}
                </p>

                {/* Price Breakdown */}
                <div className="space-y-3 pb-6 border-b border-border">
                  <div className="flex justify-between text-sm">
                    <span className="text-text-muted">Eğitim Ücreti</span>
                    <span className="line-through text-text-muted">
                      {formatPrice(courseData.originalPrice)}
                    </span>
                  </div>
                  <div className="flex justify-between text-sm">
                    <span className="text-text-muted">Kampanyalı Fiyat</span>
                    <span className="text-success">
                      -{discountPercent}%
                    </span>
                  </div>
                </div>

                {/* Total */}
                <div className="pt-6">
                  <div className="flex justify-between items-center">
                    <span className="font-semibold">Toplam</span>
                    <div className="text-right">
                      <span className="text-3xl font-bold text-primary">
                        {formatPrice(courseData.discountedPrice!)}
                      </span>
                    </div>
                  </div>
                </div>

                {/* Guarantee */}
                <div className="mt-6 p-4 bg-accent/10 rounded-xl">
                  <div className="flex items-start gap-3">
                    <Shield className="w-6 h-6 text-accent flex-shrink-0" />
                    <div>
                      <div className="font-semibold text-sm">30 Gün Garanti</div>
                      <div className="text-xs text-text-muted">
                        Memnun kalmazsanız paranızı iade ediyoruz.
                      </div>
                    </div>
                  </div>
                </div>

                {/* What's Included */}
                <div className="mt-6">
                  <h4 className="font-semibold text-sm mb-4">Neler Dahil?</h4>
                  <ul className="space-y-3">
                    {[
                      "Lifetime erişim",
                      "40+ saat video içerik",
                      "Indirilebilir materyaller",
                      "Sertifika",
                      "7/24 destek",
                    ].map((item, index) => (
                      <li key={index} className="flex items-center gap-3 text-sm">
                        <Check className="w-4 h-4 text-success" />
                        <span>{item}</span>
                      </li>
                    ))}
                  </ul>
                </div>
              </div>
            </div>
          </motion.div>
        </div>
      </div>
    </div>
  );
}
