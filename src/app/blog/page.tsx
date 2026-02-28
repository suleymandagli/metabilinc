import Link from "next/link";
import { Metadata } from "next";

export const metadata: Metadata = {
  title: "Blog | Metabilinc",
  description: "Anne ve baba eğitimleri hakkında blog yazıları, ipuçları ve makaleler.",
};

const blogPosts = [
  {
    slug: "cocuklarda-ogrenme-motivasyonu",
    title: "Çocuklarda Öğrenme Motivasyonunu Artırma",
    excerpt: "Çocuğunuzun öğrenme motivasyonunu nasıl artırabileceğinizi keşfedin. Etkili stratejiler ve ipuçları...",
    date: "15 Şubat 2026",
    category: "Eğitim",
    readTime: "5 dk okuma",
  },
  {
    slug: "aile-iletisimi",
    title: "Etkili Aile İletişimi Nasıl Kurulur?",
    excerpt: "Aile içi iletişimi güçlendirmek için kanıtlanmış teknikler ve stratejiler.",
    date: "10 Şubat 2026",
    category: "İletişim",
    readTime: "7 dk okuma",
  },
  {
    slug: "ergenlik-donemi",
    title: "Ergenlik Dönemini Anlamak",
    excerpt: "Ergenlik dönemindeki çocuğunuzla sağlıklı bir ilişki kurmanın yolları.",
    date: "5 Şubat 2026",
    category: "Gelişim",
    readTime: "8 dk okuma",
  },
  {
    slug: "teknoloji-ve-cocuklar",
    title: "Çocuklarda Teknoloji Kullanımı",
    excerpt: "Dijital çağda çocuğunuzun teknoloji kullanımını nasıl yönetebilirsiniz?",
    date: "1 Şubat 2026",
    category: "Teknoloji",
    readTime: "6 dk okuma",
  },
  {
    slug: "sorumluluk-egitimi",
    title: "Çocuklara Sorumluluk Öğretme",
    excerpt: "Çocuklarınıza yaşına uygun sorumluluklar vermek ve öz disiplin geliştirmelerini sağlamak.",
    date: "28 Ocak 2026",
    category: "Eğitim",
    readTime: "5 dk okuma",
  },
  {
    slug: "basari-icin-aile-destegi",
    title: "Çocuğunuzun Başarısı İçin Aile Desteği",
    excerpt: "Çocuğunuzun akademik ve kişisel başarısında ailenin rolü ve etkili destek yöntemleri.",
    date: "25 Ocak 2026",
    category: "Başarı",
    readTime: "6 dk okuma",
  },
];

export default function BlogPage() {
  return (
    <div className="container-main py-16">
      {/* Hero Section */}
      <div className="text-center mb-16">
        <span className="inline-block px-4 py-2 bg-orange-100 text-orange-600 rounded-full text-sm font-medium mb-4">
          Blog
        </span>
        <h1 className="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
          Anne Baba <span className="text-orange-500">Blog</span>
        </h1>
        <p className="text-lg text-gray-600 max-w-2xl mx-auto">
          Çocuk yetiştirme, eğitim ve aile içi iletişim hakkında uzman makaleleri ve güncel yazılar.
        </p>
      </div>

      {/* Blog Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        {blogPosts.map((post) => (
          <Link
            key={post.slug}
            href={`/blog/${post.slug}`}
            className="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100"
          >
            {/* Image Placeholder */}
            <div className="h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center group-hover:from-orange-100 group-hover:to-orange-200 transition-colors">
              <svg
                className="w-16 h-16 text-gray-400 group-hover:text-orange-400 transition-colors"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={1.5}
                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"
                />
              </svg>
            </div>

            {/* Content */}
            <div className="p-6">
              <div className="flex items-center justify-between mb-3">
                <span className="text-sm text-orange-500 font-medium">
                  {post.category}
                </span>
                <span className="text-sm text-gray-400">{post.readTime}</span>
              </div>
              <h2 className="text-xl font-bold text-gray-900 mb-2 group-hover:text-orange-500 transition-colors">
                {post.title}
              </h2>
              <p className="text-gray-600 text-sm mb-4">{post.excerpt}</p>
              <div className="flex items-center text-gray-500 text-sm">
                <svg
                  className="w-4 h-4 mr-2"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                  />
                </svg>
                {post.date}
              </div>
            </div>
          </Link>
        ))}
      </div>

      {/* Newsletter CTA */}
      <div className="mt-16 bg-gray-900 rounded-3xl p-8 md:p-12 text-center">
        <h2 className="text-2xl md:text-3xl font-bold text-white mb-4">
          Güncel Yazılardan Haberdar Olun
        </h2>
        <p className="text-gray-400 mb-6 max-w-xl mx-auto">
          Blog yazılarımızdan haberdar olmak için e-posta listemize kaydolun.
        </p>
        <form className="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
          <input
            type="email"
            placeholder="E-posta adresiniz"
            className="flex-1 px-6 py-3 rounded-full bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500"
          />
          <button
            type="submit"
            className="px-8 py-3 bg-orange-500 text-white font-medium rounded-full hover:bg-orange-600 transition-colors"
          >
            Abone Ol
          </button>
        </form>
      </div>
    </div>
  );
}
