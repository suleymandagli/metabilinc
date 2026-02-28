import type { Metadata } from "next";
import { Playfair_Display, Inter } from "next/font/google";
import "./globals.css";
import { Header } from "@/components/layout/Header";
import { Footer } from "@/components/layout/Footer";

const playfair = Playfair_Display({
  subsets: ["latin"],
  variable: "--font-display",
  display: "swap",
});

const inter = Inter({
  subsets: ["latin"],
  variable: "--font-body",
  display: "swap",
});

export const metadata: Metadata = {
  title: "Metabilinc | Bilinçli Aile ve Evlilik Eğitimleri",
  description: "Anne ve babalara yönelik profesyonel eğitim platformu. Bilinçli Aile Okulu ve Bilinçli Evlilik Akademisi ile daha sağlıklı ilişkiler kurun.",
  keywords: "aile eğitimi, evlilik kursu, anne baba eğitimi, çocuk gelişimi, iletişim becerileri, aile bilinci",
  openGraph: {
    title: "Metabilinc | Bilinçli Aile ve Evlilik Eğitimleri",
    description: "Anne ve babalara yönelik profesyonel eğitim platformu",
    type: "website",
    locale: "tr_TR",
  },
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="tr" className={`${playfair.variable} ${inter.variable}`}>
      <body className="min-h-screen flex flex-col">
        <Header />
        <main className="flex-1">
          {children}
        </main>
        <Footer />
      </body>
    </html>
  );
}
