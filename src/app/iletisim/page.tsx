import { Metadata } from "next";
import { Header } from "@/components/layout/Header";
import { Footer } from "@/components/layout/Footer";
import { Mail, Phone, MapPin, Clock, Send, MessageCircle } from "lucide-react";

export const metadata: Metadata = {
  title: "İletişim | Metabilinc",
  description: "Metabilinc ile iletişime geçin. Sorularınız için bize ulaşın.",
};

export default function IletisimPage() {
  return (
    <>
      <Header />
      
      {/* Hero Section */}
      <section className="relative pt-32 pb-20 bg-gradient-to-br from-primary-dark via-primary to-primary-light">
        <div className="container-main">
          <div className="max-w-3xl mx-auto text-center">
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-display font-bold text-white mb-6">
              İletişim
            </h1>
            <p className="text-xl text-white/80">
              Sorularınız mı var? Bizimle iletişime geçmekten çekinmeyin. 
              En kısa sürede size dönüş yapacağız.
            </p>
          </div>
        </div>
      </section>

      {/* Contact Info & Form */}
      <section className="py-20 bg-surface">
        <div className="container-main">
          <div className="grid lg:grid-cols-2 gap-12">
            {/* Contact Info */}
            <div>
              <h2 className="text-3xl font-display font-bold text-text mb-8">
                Bize Ulaşın
              </h2>
              
              <div className="space-y-6">
                <div className="flex items-start gap-4 p-6 bg-secondary rounded-2xl">
                  <div className="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <Phone className="w-6 h-6 text-primary" />
                  </div>
                  <div>
                    <h3 className="font-bold text-text mb-1">Telefon</h3>
                    <a href="tel:+905551234567" className="text-accent hover:underline">
                      +90 555 123 45 67
                    </a>
                    <p className="text-sm text-text-muted mt-1">Hafta içi 09:00 - 18:00</p>
                  </div>
                </div>
                
                <div className="flex items-start gap-4 p-6 bg-secondary rounded-2xl">
                  <div className="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <Mail className="w-6 h-6 text-primary" />
                  </div>
                  <div>
                    <h3 className="font-bold text-text mb-1">E-posta</h3>
                    <a href="mailto:info@metabilinc.com" className="text-accent hover:underline">
                      info@metabilinc.com
                    </a>
                    <p className="text-sm text-text-muted mt-1">24 saat içinde yanıtlanır</p>
                  </div>
                </div>
                
                <div className="flex items-start gap-4 p-6 bg-secondary rounded-2xl">
                  <div className="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <MapPin className="w-6 h-6 text-primary" />
                  </div>
                  <div>
                    <h3 className="font-bold text-text mb-1">Adres</h3>
                    <p className="text-text-light">
                      Çankaya, Ankara<br />
                      Türkiye
                    </p>
                  </div>
                </div>
                
                <div className="flex items-start gap-4 p-6 bg-secondary rounded-2xl">
                  <div className="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <Clock className="w-6 h-6 text-primary" />
                  </div>
                  <div>
                    <h3 className="font-bold text-text mb-1">Çalışma Saatleri</h3>
                    <p className="text-text-light">
                      Pazartesi - Cuma: 09:00 - 18:00<br />
                      Cumartesi: 10:00 - 14:00<br />
                      Pazar: Kapalı
                    </p>
                  </div>
                </div>
              </div>

              {/* WhatsApp */}
              <div className="mt-8 p-6 bg-green-50 border border-green-200 rounded-2xl">
                <div className="flex items-center gap-4">
                  <div className="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <MessageCircle className="w-6 h-6 text-white" />
                  </div>
                  <div>
                    <h3 className="font-bold text-text mb-1">WhatsApp</h3>
                    <a href="https://wa.me/905551234567" className="text-green-600 hover:underline font-medium">
                      +90 555 123 45 67
                    </a>
                    <p className="text-sm text-text-muted mt-1">Hızlı yanıt için WhatsApp</p>
                  </div>
                </div>
              </div>
            </div>

            {/* Contact Form */}
            <div>
              <div className="bg-secondary rounded-3xl p-8">
                <h2 className="text-3xl font-display font-bold text-text mb-6">
                  Mesaj Gönderin
                </h2>
                
                <form className="space-y-6">
                  <div className="grid md:grid-cols-2 gap-6">
                    <div>
                      <label htmlFor="name" className="label">
                        Adınız Soyadınız
                      </label>
                      <input
                        type="text"
                        id="name"
                        name="name"
                        className="input"
                        placeholder="Adınızı girin"
                        required
                      />
                    </div>
                    <div>
                      <label htmlFor="phone" className="label">
                        Telefon Numaranız
                      </label>
                      <input
                        type="tel"
                        id="phone"
                        name="phone"
                        className="input"
                        placeholder="05XX XXX XX XX"
                      />
                    </div>
                  </div>
                  
                  <div>
                    <label htmlFor="email" className="label">
                      E-posta Adresiniz
                    </label>
                    <input
                      type="email"
                      id="email"
                      name="email"
                      className="input"
                      placeholder="ornek@email.com"
                      required
                    />
                  </div>
                  
                  <div>
                    <label htmlFor="subject" className="label">
                      Konu
                    </label>
                    <select
                      id="subject"
                      name="subject"
                      className="input"
                      required
                    >
                      <option value="">Konu seçin</option>
                      <option value="genel">Genel Soru</option>
                      <option value="kurs">Kurs Bilgisi</option>
                      <option value="fatura">Fatura ve Ödeme</option>
                      <option value="teklif">Kurumsal Teklif</option>
                      <option value="diger">Diğer</option>
                    </select>
                  </div>
                  
                  <div>
                    <label htmlFor="message" className="label">
                      Mesajınız
                    </label>
                    <textarea
                      id="message"
                      name="message"
                      rows={5}
                      className="input resize-none"
                      placeholder="Mesajınızı buraya yazın..."
                      required
                    />
                  </div>
                  
                  <div className="flex items-start gap-3">
                    <input
                      type="checkbox"
                      id="privacy"
                      name="privacy"
                      className="mt-1 w-5 h-5 rounded border-border text-primary focus:ring-primary"
                      required
                    />
                    <label htmlFor="privacy" className="text-sm text-text-muted">
                      <a href="#" className="text-accent hover:underline">Gizlilik politikasını</a> okudum ve kabul ediyorum.
                    </label>
                  </div>
                  
                  <button
                    type="submit"
                    className="btn btn-primary w-full gap-2"
                  >
                    <Send className="w-5 h-5" />
                    Mesaj Gönder
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* FAQ Teaser */}
      <section className="py-20 bg-secondary">
        <div className="container-main">
          <div className="max-w-3xl mx-auto text-center">
            <h2 className="text-3xl font-display font-bold text-text mb-4">
              Sıkça Sorulan Sorular
            </h2>
            <p className="text-text-muted mb-8">
              Önce SSS sayfamızı ziyaret edebilirsiniz. Belki sorunuzun cevabı orada olabilir.
            </p>
            <a href="/sss" className="btn btn-outline">
              SSS Sayfasını Görüntüle
            </a>
          </div>
        </div>
      </section>

      {/* Map Section */}
      <section className="h-80 bg-secondary-dark flex items-center justify-center">
        <div className="text-center">
          <MapPin className="w-12 h-12 text-text-muted mx-auto mb-4" />
          <p className="text-text-muted">Harita yakında eklenecektir</p>
        </div>
      </section>

      <Footer />
    </>
  );
}
