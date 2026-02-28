import { Metadata } from "next";
import { Header } from "@/components/layout/Header";
import { Footer } from "@/components/layout/Footer";
import { CheckCircle, Heart, Users, Lightbulb } from "lucide-react";

export const metadata: Metadata = {
  title: "Hakkımızda | Metabilinc",
  description: "Metabilinc - Aile eğitim platformunun hikayesi ve misyonu. 30 yıllık deneyimle aileleri güçlendiriyoruz.",
};

export default function HakkimizdaPage() {
  return (
    <>
      <Header />
      
      {/* Hero Section */}
      <section className="relative pt-32 pb-20 bg-gradient-to-br from-primary-dark via-primary to-primary-light">
        <div className="container-main">
          <div className="max-w-3xl mx-auto text-center">
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-display font-bold text-white mb-6">
              Hakkımızda
            </h1>
            <p className="text-xl text-white/80">
              Güçlü aileler, doğru farkındalık ve çağın ihtiyaçlarına uygun becerilerle inşa edilir.
            </p>
          </div>
        </div>
      </section>

      {/* Founder Section */}
      <section className="py-20 bg-surface">
        <div className="container-main">
          <div className="grid lg:grid-cols-2 gap-12 items-center">
            <div className="order-2 lg:order-1">
              <div className="inline-flex items-center gap-2 px-4 py-2 bg-accent/10 text-accent rounded-full mb-6">
                <Users className="w-4 h-4" />
                <span className="font-medium">Kurucumuz</span>
              </div>
              <h2 className="text-3xl md:text-4xl font-display font-bold text-text mb-6">
                Ben Süleyman Dağlı
              </h2>
              <div className="space-y-4 text-text-light leading-relaxed">
                <p>
                  Aile Danışmanı, Psikolojik Danışman ve Eğitim Bilimleri Uzmanıyım. 
                  Yaklaşık 30 yıldır eğitimin ve ailenin tam merkezinde çalışıyorum.
                </p>
                <p>
                  Mesleki yolculuğumun ilk yıllarında odağım çoğunlukla çocuklardı. Ancak 
                  yüzlerce bireysel ve grup psikolojik danışma seansı ilerledikçe çok net 
                  bir gerçeği fark ettim:
                </p>
                <p className="text-lg font-medium text-primary">
                  Bugün anne babaların yaşadığı pek çok zorluk, yalnızca bireysel değil; 
                  çağın getirdiği yeni risklerle de yakından ilişkili.
                </p>
              </div>
            </div>
            
            <div className="order-1 lg:order-2">
              <div className="relative">
                <div className="aspect-square max-w-md mx-auto bg-gradient-to-br from-secondary to-secondary-dark rounded-3xl overflow-hidden flex items-center justify-center">
                  <div className="text-center p-8">
                    <div className="w-32 h-32 mx-auto mb-6 bg-primary/10 rounded-full flex items-center justify-center">
                      <Users className="w-16 h-16 text-primary" />
                    </div>
                    <p className="text-2xl font-bold text-primary">30+ Yıl</p>
                    <p className="text-text-muted">Saha Deneyimi</p>
                  </div>
                </div>
                <div className="absolute -bottom-6 -right-6 w-24 h-24 bg-accent rounded-2xl flex items-center justify-center shadow-xl">
                  <span className="text-white font-bold text-center">Eğitim<br/>Uzmanı</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* The Problem */}
      <section className="py-20 bg-secondary">
        <div className="container-main">
          <div className="max-w-4xl mx-auto">
            <h2 className="text-3xl md:text-4xl font-display font-bold text-text text-center mb-12">
              Çağın Aile Sorunları
            </h2>
            
            <div className="grid md:grid-cols-2 gap-6">
              {[
                "Dijital ekranların erken yaşta hayatın merkezine yerleşmesi",
                "Yoğun akademik baskı ve hızlı yaşam temposu",
                "Yalnızlaşan aile yapısı ve tükenen ebeveyn sabrı",
                "Söz dinlemeyen ve sınır zorlayan çocuklar",
                "Ekran bağımlılığı ve dikkat dağınıklığı",
                "Ergenle iletişim kuramama",
                "Ev içinde artan öfke ve çatışma",
                "Çocuk yetiştirme konusunda eşler arası uyumsuzluk"
              ].map((item, index) => (
                <div key={index} className="flex items-start gap-3 p-4 bg-surface rounded-xl">
                  <div className="w-2 h-2 mt-2 rounded-full bg-accent flex-shrink-0" />
                  <span className="text-text-light">{item}</span>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* The Insight */}
      <section className="py-20 bg-surface">
        <div className="container-main">
          <div className="max-w-3xl mx-auto">
            <div className="bg-gradient-to-br from-primary to-primary-light rounded-3xl p-8 md:p-12 text-white">
              <div className="flex items-center gap-3 mb-6">
                <Lightbulb className="w-8 h-8 text-accent" />
                <h3 className="text-2xl font-display font-bold">Önemli Bir Farkındalık</h3>
              </div>
              
              <p className="text-lg text-white/90 mb-6">
                Anne babalar çoğu zaman sevgisiz değil; aksine son derece ilgili ve iyi niyetli. 
                Ancak çağın hızına karşı eski reflekslerle ebeveynlik yapmak, farkında olmadan 
                sorunları büyütebiliyor.
              </p>
              
              <ul className="space-y-3 text-white/80">
                <li className="flex items-start gap-3">
                  <CheckCircle className="w-5 h-5 text-accent mt-0.5" />
                  <span>Fazla korumak çocuğu güçlendirmek yerine kırılganlaştırabiliyor</span>
                </li>
                <li className="flex items-start gap-3">
                  <CheckCircle className="w-5 h-5 text-accent mt-0.5" />
                  <span>Sürekli uyarmak iletişimi açmak yerine kapatabiliyor</span>
                </li>
                <li className="flex items-start gap-3">
                  <CheckCircle className="w-5 h-5 text-accent mt-0.5" />
                  <span>Her sorunu hızla çözmek çocuğun dayanıklılığını zayıflatabiliyor</span>
                </li>
                <li className="flex items-start gap-3">
                  <CheckCircle className="w-5 h-5 text-accent mt-0.5" />
                  <span>Eşler arasındaki küçük uyumsuzluklar bile çocuğun davranışlarına doğrudan yansıyabiliyor</span>
                </li>
              </ul>
              
              <p className="mt-6 text-xl font-medium text-accent">
                Yani mesele çoğu zaman ne kadar çabaladığımız değil; çağın gerçeklerine 
                uygun doğru becerileri kullanıp kullanmadığımızdır.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* Our Mission */}
      <section className="py-20 bg-secondary">
        <div className="container-main">
          <div className="max-w-4xl mx-auto">
            <h2 className="text-3xl md:text-4xl font-display font-bold text-text text-center mb-8">
              Misyonumuz
            </h2>
            
            <div className="text-center mb-12">
              <p className="text-2xl text-text-light italic">
                &ldquo;Sadece ortaya çıkan problemleri onarmanın yeterli olmadığını; asıl ihtiyacın, 
                sorunlar büyümeden önce aileyi güçlendirmek olduğunu gördüm.&rdquo;
              </p>
              <p className="mt-4 text-text-muted">— Süleyman Dağlı</p>
            </div>
            
            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
              {[
                {
                  icon: Heart,
                  title: "Sağlıklı İletişim",
                  description: "Çocuğunuzla sağlıklı ve güçlü iletişim kurmanıza destek olmak"
                },
                {
                  icon: Users,
                  title: "Eş Uyumu",
                  description: "Eşinizle aynı ebeveynlik dilinde buluşmanızı sağlamak"
                },
                {
                  icon: Lightbulb,
                  title: "Dijital Çağa Hazırlık",
                  description: "Dijital çağın risklerine karşı aileyi güçlendirmek"
                },
                {
                  icon: CheckCircle,
                  title: "Huzurlu Ev",
                  description: "Ev içindeki gerilimi azaltmanıza yardımcı olmak"
                },
                {
                  icon: CheckCircle,
                  title: "Problem Çözümü",
                  description: "Tekrar eden problem döngülerini kırmanızı sağlamak"
                }
              ].map((item, index) => (
                <div key={index} className="bg-surface p-6 rounded-2xl">
                  <item.icon className="w-10 h-10 text-accent mb-4" />
                  <h3 className="text-lg font-bold text-text mb-2">{item.title}</h3>
                  <p className="text-text-muted">{item.description}</p>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Education */}
      <section className="py-20 bg-surface">
        <div className="container-main">
          <div className="max-w-3xl mx-auto">
            <h2 className="text-3xl md:text-4xl font-display font-bold text-text text-center mb-12">
              Eğitim Geçmişi
            </h2>
            
            <div className="space-y-6">
              <div className="flex items-center gap-6 p-6 bg-secondary rounded-2xl">
                <div className="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                  <span className="text-2xl">🎓</span>
                </div>
                <div>
                  <h3 className="text-lg font-bold text-text">Ankara Üniversitesi</h3>
                  <p className="text-text-muted">Psikolojik Danışmanlık ve Rehberlik (PDR)</p>
                </div>
              </div>
              
              <div className="flex items-center gap-6 p-6 bg-secondary rounded-2xl">
                <div className="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                  <span className="text-2xl">📚</span>
                </div>
                <div>
                  <h3 className="text-lg font-bold text-text">Eğitim Bilimleri</h3>
                  <p className="text-text-muted">Yüksek Lisans</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* CTA */}
      <section className="py-20 bg-gradient-to-br from-primary-dark via-primary to-accent">
        <div className="container-main">
          <div className="max-w-3xl mx-auto text-center">
            <h2 className="text-3xl md:text-4xl font-display font-bold text-white mb-6">
              İlk Adımı Atın
            </h2>
            <p className="text-xl text-white/80 mb-8">
              Eğer siz de çağın karmaşası içinde çocuğunuzla bağınızı güçlendirmek, 
              eşinizle daha uyumlu hareket etmek ve evinizde daha huzurlu bir iklim 
              oluşturmak istiyorsanız, şimdi programı inceleyerek ilk adımı atabilirsiniz.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <a href="/kurslar" className="btn bg-white text-primary hover:bg-secondary">
                Kursları Keşfet
              </a>
              <a href="/iletisim" className="btn border-2 border-white text-white hover:bg-white/10">
                Bizimle İletişime Geçin
              </a>
            </div>
          </div>
        </div>
      </section>

      <Footer />
    </>
  );
}
