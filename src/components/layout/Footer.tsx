import Link from "next/link";
import { BookOpen, Mail, Phone, MapPin, Instagram, Facebook, Youtube } from "lucide-react";

const footerLinks = {
  kurslar: [
    { name: "Bilinçli Aile Okulu", href: "/kurs/bilincli-aile-okulu" },
    { name: "Bilinci Evlilik Akademisi", href: "/kurs/bilincli-evlilik-akademisi" },
    { name: "Ücretsiz Mini Kurs", href: "/mini-kurs" },
    { name: "Tüm Kurslar", href: "/kurslar" },
  ],
  kurumsal: [
    { name: "Hakkımızda", href: "/hakkimizda" },
    { name: "Eğitmenler", href: "/egitmenler" },
    { name: "İletişim", href: "/iletisim" },
    { name: "Blog", href: "/blog" },
  ],
  destek: [
    { name: "Sıkça Sorulan Sorular", href: "/sss" },
    { name: "Gizlilik Politikası", href: "/gizlilik" },
    { name: "Kullanım Şartları", href: "/kullanim-sartlari" },
    { name: "İade Politikası", href: "/iade" },
  ],
};

const socialLinks = [
  { name: "Instagram", icon: Instagram, href: "#" },
  { name: "Facebook", icon: Facebook, href: "#" },
  { name: "Youtube", icon: Youtube, href: "#" },
];

export function Footer() {
  return (
    <footer className="bg-primary text-white">
      {/* Top Section */}
      <div className="container-main py-16">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12">
          {/* Brand */}
          <div className="lg:col-span-2">
            <Link href="/" className="flex items-center gap-3 mb-6">
              <div className="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                <BookOpen className="w-6 h-6" />
              </div>
              <span className="font-display text-2xl font-bold">
                Metabilinç Akademi
              </span>
            </Link>
            <p className="text-white/80 mb-6 max-w-md">
              Aile ve evlilik eğitiminde lider platform. Bilinçli anne-babalık 
              ve sağlıklı evlilikler için profesyonel eğitimler sunuyoruz.
            </p>
            <div className="space-y-3">
              <div className="flex items-center gap-3 text-white/80">
                <Mail className="w-5 h-5" />
                <span>info@metabilinc.com</span>
              </div>
              <div className="flex items-center gap-3 text-white/80">
                <Phone className="w-5 h-5" />
                <span>+90 (212) 123 45 67</span>
              </div>
              <div className="flex items-center gap-3 text-white/80">
                <MapPin className="w-5 h-5" />
                <span>İstanbul, Türkiye</span>
              </div>
            </div>
          </div>

          {/* Links */}
          <div>
            <h4 className="font-display text-lg font-semibold mb-4">Kurslar</h4>
            <ul className="space-y-3">
              {footerLinks.kurslar.map((link) => (
                <li key={link.name}>
                  <Link 
                    href={link.href}
                    className="text-white/80 hover:text-white transition-colors"
                  >
                    {link.name}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          <div>
            <h4 className="font-display text-lg font-semibold mb-4">Kurumsal</h4>
            <ul className="space-y-3">
              {footerLinks.kurumsal.map((link) => (
                <li key={link.name}>
                  <Link 
                    href={link.href}
                    className="text-white/80 hover:text-white transition-colors"
                  >
                    {link.name}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          <div>
            <h4 className="font-display text-lg font-semibold mb-4">Destek</h4>
            <ul className="space-y-3">
              {footerLinks.destek.map((link) => (
                <li key={link.name}>
                  <Link 
                    href={link.href}
                    className="text-white/80 hover:text-white transition-colors"
                  >
                    {link.name}
                  </Link>
                </li>
              ))}
            </ul>
          </div>
        </div>
      </div>

      {/* Bottom Section */}
      <div className="border-t border-white/10">
        <div className="container-main py-6">
          <div className="flex flex-col md:flex-row items-center justify-between gap-4">
            <p className="text-white/60 text-sm">
              © {new Date().getFullYear()} Metabilinç Akademi. Tüm hakları saklıdır.
            </p>
            <div className="flex items-center gap-4">
              {socialLinks.map((social) => (
                <a
                  key={social.name}
                  href={social.href}
                  className="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors"
                  aria-label={social.name}
                >
                  <social.icon className="w-5 h-5" />
                </a>
              ))}
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
}
