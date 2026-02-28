"use client";

import { useState } from "react";
import { motion } from "framer-motion";
import Link from "next/link";
import Image from "next/image";
import { 
  User, BookOpen, Clock, Award, Play, Settings, 
  LogOut, CreditCard, Bell, Search, ChevronRight,
  CheckCircle, Circle, Star, Download, TrendingUp
} from "lucide-react";
import { formatPrice } from "@/lib/utils";

// Sample user data
const userData = {
  name: "Ahmet Yılmaz",
  email: "ahmet@example.com",
  avatar: "",
  enrolledCourses: [
    {
      id: 1,
      title: "Bilinçli Aile Okulu",
      slug: "bilincli-aile-okulu",
      progress: 65,
      totalLessons: 45,
      completedLessons: 29,
      lastAccessed: "2 gün önce",
      thumbnail: "",
      status: "active",
    },
    {
      id: 2,
      title: "Çocuklarla Etkili İletişim",
      slug: "cocuklarla-etkili-iletisim",
      progress: 100,
      totalLessons: 8,
      completedLessons: 8,
      lastAccessed: "1 hafta önce",
      thumbnail: "",
      status: "completed",
    },
  ],
  certificates: [
    {
      id: 1,
      courseName: "Çocuklarla Etkili İletişim",
      date: "15 Ocak 2024",
      downloadUrl: "#",
    },
  ],
  orders: [
    {
      id: "MB-123456",
      course: "Bilinçli Aile Okulu",
      amount: 997,
      date: "10 Ocak 2024",
      status: "completed",
    },
    {
      id: "MB-123457",
      course: "Çocuklarla Etkili İletişim",
      amount: 0,
      date: "5 Ocak 2024",
      status: "completed",
    },
  ],
  stats: {
    totalCourses: 2,
    completedCourses: 1,
    totalHours: 42,
    certificates: 1,
  },
};

const tabs = [
  { id: "courses", name: "Kurslarım", icon: BookOpen },
  { id: "certificates", name: "Sertifikalarım", icon: Award },
  { id: "orders", name: "Siparişlerim", icon: CreditCard },
  { id: "profile", name: "Profilim", icon: User },
];

export default function DashboardPage() {
  const [activeTab, setActiveTab] = useState("courses");

  return (
    <div className="min-h-screen bg-background pt-24 pb-20">
      <div className="container-main">
        {/* Header */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          className="mb-8"
        >
          <h1 className="text-3xl font-display font-bold mb-2">
            Hoş Geldiniz, {userData.name} 👋
          </h1>
          <p className="text-text-muted">
            Eğitim yolculuğunuzda neredeysiniz?
          </p>
        </motion.div>

        {/* Stats */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.1 }}
          className="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8"
        >
          {[
            { icon: BookOpen, label: "Toplam Kurs", value: userData.stats.totalCourses, color: "bg-primary/10 text-primary" },
            { icon: CheckCircle, label: "Tamamlanan", value: userData.stats.completedCourses, color: "bg-success/10 text-success" },
            { icon: Clock, label: "İşlenen Saat", value: userData.stats.totalHours, color: "bg-accent/10 text-accent" },
            { icon: Award, label: "Sertifika", value: userData.stats.certificates, color: "bg-purple-100 text-purple-600" },
          ].map((stat, index) => (
            <div key={index} className="bg-surface rounded-2xl p-6 border border-border/50">
              <div className={`w-12 h-12 rounded-xl ${stat.color} flex items-center justify-center mb-4`}>
                <stat.icon className="w-6 h-6" />
              </div>
              <div className="text-3xl font-bold mb-1">{stat.value}</div>
              <div className="text-sm text-text-muted">{stat.label}</div>
            </div>
          ))}
        </motion.div>

        <div className="grid lg:grid-cols-4 gap-8">
          {/* Sidebar */}
          <motion.div
            initial={{ opacity: 0, x: -20 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ delay: 0.2 }}
            className="lg:col-span-1"
          >
            <div className="bg-surface rounded-2xl border border-border/50 overflow-hidden sticky top-28">
              {/* User Info */}
              <div className="p-6 border-b border-border">
                <div className="flex items-center gap-4">
                  <div className="w-14 h-14 rounded-full bg-primary/20 flex items-center justify-center">
                    <span className="text-2xl">👤</span>
                  </div>
                  <div>
                    <div className="font-semibold">{userData.name}</div>
                    <div className="text-sm text-text-muted">{userData.email}</div>
                  </div>
                </div>
              </div>

              {/* Navigation */}
              <nav className="p-4">
                {tabs.map((tab) => (
                  <button
                    key={tab.id}
                    onClick={() => setActiveTab(tab.id)}
                    className={`w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all ${
                      activeTab === tab.id
                        ? "bg-primary text-white"
                        : "text-text-muted hover:bg-secondary hover:text-text"
                    }`}
                  >
                    <tab.icon className="w-5 h-5" />
                    <span>{tab.name}</span>
                  </button>
                ))}
              </nav>

              {/* Logout */}
              <div className="p-4 border-t border-border">
                <button className="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-error hover:bg-error/10 transition-all">
                  <LogOut className="w-5 h-5" />
                  <span>Çıkış Yap</span>
                </button>
              </div>
            </div>
          </motion.div>

          {/* Main Content */}
          <motion.div
            initial={{ opacity: 0, x: 20 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ delay: 0.3 }}
            className="lg:col-span-3"
          >
            {activeTab === "courses" && (
              <div>
                <div className="flex items-center justify-between mb-6">
                  <h2 className="text-2xl font-display font-bold">Kurslarım</h2>
                  <Link href="/kurslar" className="text-primary hover:underline">
                    Yeni kurs keşfet
                  </Link>
                </div>

                <div className="space-y-6">
                  {userData.enrolledCourses.map((course) => (
                    <div key={course.id} className="bg-surface rounded-2xl border border-border/50 overflow-hidden">
                      <div className="flex flex-col md:flex-row">
                        {/* Thumbnail */}
                        <div className="md:w-48 h-40 bg-secondary relative">
                          {course.thumbnail ? (
                            <div className="relative w-full h-full">
                              <Image src={course.thumbnail} alt={course.title} fill className="object-cover" />
                            </div>
                          ) : (
                            <div className="absolute inset-0 flex items-center justify-center">
                              <BookOpen className="w-12 h-12 text-primary/30" />
                            </div>
                          )}
                          {course.status === "completed" && (
                            <div className="absolute top-3 right-3 bg-success text-white px-3 py-1 rounded-full text-xs font-bold">
                              Tamamlandı
                            </div>
                          )}
                        </div>

                        {/* Content */}
                        <div className="flex-1 p-6">
                          <div className="flex items-start justify-between mb-4">
                            <div>
                              <h3 className="font-display text-lg font-semibold mb-1">{course.title}</h3>
                              <div className="flex items-center gap-4 text-sm text-text-muted">
                                <span className="flex items-center gap-1">
                                  <Clock className="w-4 h-4" />
                                  {course.lastAccessed}
                                </span>
                                <span>{course.completedLessons}/{course.totalLessons} ders</span>
                              </div>
                            </div>
                            <div className="text-right">
                              <div className="text-2xl font-bold text-primary">{course.progress}%</div>
                            </div>
                          </div>

                          {/* Progress Bar */}
                          <div className="w-full h-2 bg-secondary rounded-full mb-4 overflow-hidden">
                            <div 
                              className={`h-full rounded-full transition-all ${course.status === "completed" ? "bg-success" : "gradient-bg"}`}
                              style={{ width: `${course.progress}%` }}
                            />
                          </div>

                          <Link 
                            href={`/kurs/${course.slug}`}
                            className="btn btn-primary py-2 px-4 text-sm"
                          >
                            {course.status === "completed" ? "Tekrar İzle" : "Devam Et"}
                            <Play className="w-4 h-4 ml-2" />
                          </Link>
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            )}

            {activeTab === "certificates" && (
              <div>
                <h2 className="text-2xl font-display font-bold mb-6">Sertifikalarım</h2>
                
                {userData.certificates.length > 0 ? (
                  <div className="space-y-4">
                    {userData.certificates.map((cert) => (
                      <div key={cert.id} className="bg-surface rounded-2xl border border-border/50 p-6 flex items-center justify-between">
                        <div className="flex items-center gap-4">
                          <div className="w-14 h-14 rounded-xl bg-accent/10 flex items-center justify-center">
                            <Award className="w-7 h-7 text-accent" />
                          </div>
                          <div>
                            <h3 className="font-semibold">{cert.courseName}</h3>
                            <p className="text-sm text-text-muted">Veriliş Tarihi: {cert.date}</p>
                          </div>
                        </div>
                        <button className="btn btn-outline">
                          <Download className="w-4 h-4 mr-2" />
                          İndir
                        </button>
                      </div>
                    ))}
                  </div>
                ) : (
                  <div className="text-center py-12">
                    <div className="w-20 h-20 rounded-full bg-secondary flex items-center justify-center mx-auto mb-4">
                      <Award className="w-10 h-10 text-text-muted" />
                    </div>
                    <h3 className="font-semibold mb-2">Henüz sertifikanız yok</h3>
                    <p className="text-text-muted mb-4">Bir kursu tamamlayarak sertifika kazanabilirsiniz.</p>
                    <Link href="/kurslar" className="btn btn-primary">
                      Kursları Keşfet
                    </Link>
                  </div>
                )}
              </div>
            )}

            {activeTab === "orders" && (
              <div>
                <h2 className="text-2xl font-display font-bold mb-6">Siparişlerim</h2>
                
                <div className="bg-surface rounded-2xl border border-border/50 overflow-hidden">
                  <div className="overflow-x-auto">
                    <table className="w-full">
                      <thead className="bg-secondary-light">
                        <tr>
                          <th className="text-left p-4 font-semibold">Sipariş No</th>
                          <th className="text-left p-4 font-semibold">Kurs</th>
                          <th className="text-left p-4 font-semibold">Tutar</th>
                          <th className="text-left p-4 font-semibold">Tarih</th>
                          <th className="text-left p-4 font-semibold">Durum</th>
                        </tr>
                      </thead>
                      <tbody>
                        {userData.orders.map((order) => (
                          <tr key={order.id} className="border-t border-border">
                            <td className="p-4 font-mono text-sm">{order.id}</td>
                            <td className="p-4">{order.course}</td>
                            <td className="p-4 font-semibold">{formatPrice(order.amount)}</td>
                            <td className="p-4 text-text-muted">{order.date}</td>
                            <td className="p-4">
                              <span className="bg-success/10 text-success px-3 py-1 rounded-full text-sm font-medium">
                                Tamamlandı
                              </span>
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            )}

            {activeTab === "profile" && (
              <div>
                <h2 className="text-2xl font-display font-bold mb-6">Profil Bilgilerim</h2>
                
                <form className="bg-surface rounded-2xl border border-border/50 p-6 space-y-6">
                  <div className="grid sm:grid-cols-2 gap-6">
                    <div>
                      <label className="label">Ad Soyad</label>
                      <input
                        type="text"
                        defaultValue={userData.name}
                        className="input"
                      />
                    </div>
                    <div>
                      <label className="label">E-posta</label>
                      <input
                        type="email"
                        defaultValue={userData.email}
                        className="input"
                      />
                    </div>
                  </div>
                  
                  <div>
                    <label className="label">Telefon</label>
                    <input
                      type="tel"
                      placeholder="+90 5XX XXX XX XX"
                      className="input"
                    />
                  </div>

                  <div className="pt-4">
                    <button type="submit" className="btn btn-primary">
                      Bilgilerimi Güncelle
                    </button>
                  </div>
                </form>
              </div>
            )}
          </motion.div>
        </div>
      </div>
    </div>
  );
}
