"use client";

import { useState } from "react";
import { motion } from "framer-motion";
import Link from "next/link";
import { 
  BookOpen, Users, DollarSign, Mail, Settings, Plus, 
  Search, Edit, Trash2, Eye, MoreVertical, TrendingUp,
  ArrowUpRight, ArrowDownRight, Clock, CheckCircle, XCircle,
  BarChart3, FileText, Bell
} from "lucide-react";
import { formatPrice } from "@/lib/utils";

// Sample admin data
const stats = {
  totalRevenue: 125678,
  revenueChange: 12.5,
  totalStudents: 5234,
  studentsChange: 8.2,
  totalCourses: 24,
  coursesChange: 2,
  newLeads: 156,
  leadsChange: -5.3,
};

const courses = [
  { id: 1, title: "Bilinçli Aile Okulu", students: 5234, revenue: 5218768, status: "published", category: "aile" },
  { id: 2, title: "Bilinci Evlilik Akademisi", students: 3156, revenue: 2358492, status: "published", category: "evlilik" },
  { id: 3, title: "Çocuklarla Etkili İletişim", students: 12500, revenue: 0, status: "published", category: "aile" },
  { id: 4, title: "Ergenlik Döneminde İletişim", students: 2156, revenue: 532872, status: "draft", category: "aile" },
];

const recentOrders = [
  { id: "MB-123456", course: "Bilinçli Aile Okulu", student: "Zeynep K.", amount: 997, status: "completed", date: "2 dk önce" },
  { id: "MB-123457", course: "Bilinci Evlilik Akademisi", student: "Mehmet A.", amount: 747, status: "completed", date: "15 dk önce" },
  { id: "MB-123458", course: "Ergenlik Döneminde İletişim", student: "Ayşe Y.", amount: 247, status: "pending", date: "1 saat önce" },
  { id: "MB-123459", course: "Bilinçli Aile Okulu", student: "Ahmet M.", amount: 997, status: "failed", date: "2 saat önce" },
];

const recentLeads = [
  { id: 1, name: "Zeynep K.", email: "zeynep@example.com", source: "Ücretsiz E-kitap", course: "Bilinçli Aile Okulu", date: "5 dk önce" },
  { id: 2, name: "Mehmet A.", email: "mehmet@example.com", source: "Mini Kurs", course: "Bilinci Evlilik Akademisi", date: "30 dk önce" },
  { id: 3, name: "Ayşe Y.", email: "ayse@example.com", source: "Webinar", course: "Çocuklarla Etkili İletişim", date: "1 saat önce" },
];

const tabs = [
  { id: "overview", name: "Genel Bakış", icon: BarChart3 },
  { id: "courses", name: "Kurslar", icon: BookOpen },
  { id: "orders", name: "Siparişler", icon: DollarSign },
  { id: "leads", name: "Leadler", icon: Users },
  { id: "settings", name: "Ayarlar", icon: Settings },
];

function StatCard({ icon: Icon, label, value, change, positive }: { icon: any; label: string; value: string | number; change?: number; positive?: boolean }) {
  return (
    <div className="bg-surface rounded-2xl p-6 border border-border/50">
      <div className="flex items-center justify-between mb-4">
        <div className="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
          <Icon className="w-6 h-6 text-primary" />
        </div>
        {change !== undefined && (
          <div className={`flex items-center gap-1 text-sm font-medium ${positive ? "text-success" : "text-error"}`}>
            {positive ? <ArrowUpRight className="w-4 h-4" /> : <ArrowDownRight className="w-4 h-4" />}
            {change}%
          </div>
        )}
      </div>
      <div className="text-2xl font-bold mb-1">{value}</div>
      <div className="text-sm text-text-muted">{label}</div>
    </div>
  );
}

export default function AdminPage() {
  const [activeTab, setActiveTab] = useState("overview");
  const [searchQuery, setSearchQuery] = useState("");

  // Remove the inline StatCard definition

  return (
    <div className="min-h-screen bg-secondary-light pt-24 pb-20">
      <div className="container-main">
        {/* Header */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          className="mb-8"
        >
          <div className="flex items-center justify-between">
            <div>
              <h1 className="text-3xl font-display font-bold mb-2">Admin Panel</h1>
              <p className="text-text-muted">Platformunuzu yönetin</p>
            </div>
            <div className="flex items-center gap-4">
              <button className="w-10 h-10 rounded-xl bg-surface border border-border/50 flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                <Bell className="w-5 h-5" />
              </button>
              <button className="btn btn-primary">
                <Plus className="w-5 h-5 mr-2" />
                Yeni Kurs Ekle
              </button>
            </div>
          </div>
        </motion.div>

        <div className="grid lg:grid-cols-5 gap-8">
          {/* Sidebar */}
          <motion.div
            initial={{ opacity: 0, x: -20 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ delay: 0.1 }}
            className="lg:col-span-1"
          >
            <div className="bg-surface rounded-2xl border border-border/50 overflow-hidden sticky top-28">
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
            </div>
          </motion.div>

          {/* Main Content */}
          <motion.div
            initial={{ opacity: 0, x: 20 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ delay: 0.2 }}
            className="lg:col-span-4"
          >
            {activeTab === "overview" && (
              <div className="space-y-8">
                {/* Stats */}
                <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                  <StatCard 
                    icon={DollarSign} 
                    label="Toplam Gelir" 
                    value={formatPrice(stats.totalRevenue)} 
                    change={stats.revenueChange} 
                    positive={true} 
                  />
                  <StatCard 
                    icon={Users} 
                    label="Toplam Öğrenci" 
                    value={stats.totalStudents.toLocaleString()} 
                    change={stats.studentsChange} 
                    positive={true} 
                  />
                  <StatCard 
                    icon={BookOpen} 
                    label="Aktif Kurs" 
                    value={stats.totalCourses} 
                    change={stats.coursesChange} 
                    positive={true} 
                  />
                  <StatCard 
                    icon={Mail} 
                    label="Yeni Leadler" 
                    value={stats.newLeads} 
                    change={stats.leadsChange} 
                    positive={false} 
                  />
                </div>

                {/* Recent Orders */}
                <div className="bg-surface rounded-2xl border border-border/50 overflow-hidden">
                  <div className="p-6 border-b border-border">
                    <div className="flex items-center justify-between">
                      <h2 className="font-display text-lg font-semibold">Son Siparişler</h2>
                      <button 
                        onClick={() => setActiveTab("orders")}
                        className="text-primary hover:underline text-sm"
                      >
                        Tümünü gör
                      </button>
                    </div>
                  </div>
                  <div className="overflow-x-auto">
                    <table className="w-full">
                      <thead className="bg-secondary-light">
                        <tr>
                          <th className="text-left p-4 font-semibold">Sipariş No</th>
                          <th className="text-left p-4 font-semibold">Kurs</th>
                          <th className="text-left p-4 font-semibold">Öğrenci</th>
                          <th className="text-left p-4 font-semibold">Tutar</th>
                          <th className="text-left p-4 font-semibold">Durum</th>
                          <th className="text-left p-4 font-semibold">Tarih</th>
                        </tr>
                      </thead>
                      <tbody>
                        {recentOrders.map((order) => (
                          <tr key={order.id} className="border-t border-border">
                            <td className="p-4 font-mono text-sm">{order.id}</td>
                            <td className="p-4">{order.course}</td>
                            <td className="p-4">{order.student}</td>
                            <td className="p-4 font-semibold">{formatPrice(order.amount)}</td>
                            <td className="p-4">
                              <span className={`px-3 py-1 rounded-full text-xs font-medium ${
                                order.status === "completed" ? "bg-success/10 text-success" :
                                order.status === "pending" ? "bg-warning/10 text-warning" :
                                "bg-error/10 text-error"
                              }`}>
                                {order.status === "completed" ? "Tamamlandı" : 
                                 order.status === "pending" ? "Bekliyor" : "Başarısız"}
                              </span>
                            </td>
                            <td className="p-4 text-text-muted text-sm">{order.date}</td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                </div>

                {/* Recent Leads */}
                <div className="bg-surface rounded-2xl border border-border/50 overflow-hidden">
                  <div className="p-6 border-b border-border">
                    <div className="flex items-center justify-between">
                      <h2 className="font-display text-lg font-semibold">Son Leadler</h2>
                      <button 
                        onClick={() => setActiveTab("leads")}
                        className="text-primary hover:underline text-sm"
                      >
                        Tümünü gör
                      </button>
                    </div>
                  </div>
                  <div className="divide-y divide-border">
                    {recentLeads.map((lead) => (
                      <div key={lead.id} className="p-4 flex items-center justify-between hover:bg-secondary-light/50">
                        <div className="flex items-center gap-4">
                          <div className="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center">
                            <span className="text-lg">{lead.name[0]}</span>
                          </div>
                          <div>
                            <div className="font-semibold">{lead.name}</div>
                            <div className="text-sm text-text-muted">{lead.email}</div>
                          </div>
                        </div>
                        <div className="text-right">
                          <div className="text-sm">{lead.source}</div>
                          <div className="text-xs text-text-muted">{lead.date}</div>
                        </div>
                      </div>
                    ))}
                  </div>
                </div>
              </div>
            )}

            {activeTab === "courses" && (
              <div className="space-y-6">
                {/* Search & Filter */}
                <div className="bg-surface rounded-2xl p-4 border border-border/50">
                  <div className="flex flex-col sm:flex-row gap-4">
                    <div className="flex-1 relative">
                      <Search className="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-text-muted" />
                      <input
                        type="text"
                        placeholder="Kurs ara..."
                        value={searchQuery}
                        onChange={(e) => setSearchQuery(e.target.value)}
                        className="input pl-12"
                      />
                    </div>
                    <select className="input w-auto">
                      <option value="all">Tümü</option>
                      <option value="published">Yayında</option>
                      <option value="draft">Taslak</option>
                    </select>
                    <select className="input w-auto">
                      <option value="all">Tüm Kategoriler</option>
                      <option value="aile">Aile</option>
                      <option value="evlilik">Evlilik</option>
                    </select>
                  </div>
                </div>

                {/* Course List */}
                <div className="bg-surface rounded-2xl border border-border/50 overflow-hidden">
                  <div className="overflow-x-auto">
                    <table className="w-full">
                      <thead className="bg-secondary-light">
                        <tr>
                          <th className="text-left p-4 font-semibold">Kurs</th>
                          <th className="text-left p-4 font-semibold">Kategori</th>
                          <th className="text-left p-4 font-semibold">Öğrenci</th>
                          <th className="text-left p-4 font-semibold">Gelir</th>
                          <th className="text-left p-4 font-semibold">Durum</th>
                          <th className="text-left p-4 font-semibold">İşlemler</th>
                        </tr>
                      </thead>
                      <tbody>
                        {courses.map((course) => (
                          <tr key={course.id} className="border-t border-border">
                            <td className="p-4 font-semibold">{course.title}</td>
                            <td className="p-4">
                              <span className="px-3 py-1 rounded-full text-xs font-medium bg-secondary text-text">
                                {course.category === "aile" ? "👨‍👩‍👧 Aile" : "💑 Evlilik"}
                              </span>
                            </td>
                            <td className="p-4">{course.students.toLocaleString()}</td>
                            <td className="p-4 font-semibold">{formatPrice(course.revenue)}</td>
                            <td className="p-4">
                              <span className={`px-3 py-1 rounded-full text-xs font-medium ${
                                course.status === "published" 
                                  ? "bg-success/10 text-success" 
                                  : "bg-warning/10 text-warning"
                              }`}>
                                {course.status === "published" ? "Yayında" : "Taslak"}
                              </span>
                            </td>
                            <td className="p-4">
                              <div className="flex items-center gap-2">
                                <button className="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                                  <Eye className="w-4 h-4" />
                                </button>
                                <button className="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                                  <Edit className="w-4 h-4" />
                                </button>
                                <button className="w-8 h-8 rounded-lg bg-error/10 flex items-center justify-center hover:bg-error hover:text-white transition-colors">
                                  <Trash2 className="w-4 h-4" />
                                </button>
                              </div>
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            )}

            {activeTab === "orders" && (
              <div className="bg-surface rounded-2xl border border-border/50 overflow-hidden">
                <div className="p-6 border-b border-border">
                  <h2 className="font-display text-lg font-semibold">Tüm Siparişler</h2>
                </div>
                <div className="overflow-x-auto">
                  <table className="w-full">
                    <thead className="bg-secondary-light">
                      <tr>
                        <th className="text-left p-4 font-semibold">Sipariş No</th>
                        <th className="text-left p-4 font-semibold">Kurs</th>
                        <th className="text-left p-4 font-semibold">Öğrenci</th>
                        <th className="text-left p-4 font-semibold">Tutar</th>
                        <th className="text-left p-4 font-semibold">Durum</th>
                        <th className="text-left p-4 font-semibold">Tarih</th>
                      </tr>
                    </thead>
                    <tbody>
                      {recentOrders.map((order) => (
                        <tr key={order.id} className="border-t border-border">
                          <td className="p-4 font-mono text-sm">{order.id}</td>
                          <td className="p-4">{order.course}</td>
                          <td className="p-4">{order.student}</td>
                          <td className="p-4 font-semibold">{formatPrice(order.amount)}</td>
                          <td className="p-4">
                            <span className={`px-3 py-1 rounded-full text-xs font-medium ${
                              order.status === "completed" ? "bg-success/10 text-success" :
                              order.status === "pending" ? "bg-warning/10 text-warning" :
                              "bg-error/10 text-error"
                            }`}>
                              {order.status === "completed" ? "Tamamlandı" : 
                               order.status === "pending" ? "Bekliyor" : "Başarısız"}
                            </span>
                          </td>
                          <td className="p-4 text-text-muted text-sm">{order.date}</td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                </div>
              </div>
            )}

            {activeTab === "leads" && (
              <div className="space-y-6">
                {/* Lead Stats */}
                <div className="grid sm:grid-cols-3 gap-6">
                  <div className="bg-surface rounded-2xl p-6 border border-border/50">
                    <div className="text-3xl font-bold mb-2">{stats.newLeads}</div>
                    <div className="text-text-muted">Bu Hafta</div>
                  </div>
                  <div className="bg-surface rounded-2xl p-6 border border-border/50">
                    <div className="text-3xl font-bold mb-2">534</div>
                    <div className="text-text-muted">Bu Ay</div>
                  </div>
                  <div className="bg-surface rounded-2xl p-6 border border-border/50">
                    <div className="text-3xl font-bold mb-2">12.500</div>
                    <div className="text-text-muted">Toplam</div>
                  </div>
                </div>

                {/* Lead List */}
                <div className="bg-surface rounded-2xl border border-border/50 overflow-hidden">
                  <div className="p-6 border-b border-border">
                    <h2 className="font-display text-lg font-semibold">Tüm Leadler</h2>
                  </div>
                  <div className="divide-y divide-border">
                    {[...Array(10)].map((_, i) => (
                      <div key={i} className="p-4 flex items-center justify-between hover:bg-secondary-light/50">
                        <div className="flex items-center gap-4">
                          <div className="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center">
                            <span className="text-lg">👤</span>
                          </div>
                          <div>
                            <div className="font-semibold">Lead {i + 1}</div>
                            <div className="text-sm text-text-muted">lead{i}@example.com</div>
                          </div>
                        </div>
                        <div className="flex items-center gap-4">
                          <span className="text-sm text-text-muted">{["Ücretsiz E-kitap", "Mini Kurs", "Webinar"][i % 3]}</span>
                          <span className="text-sm text-text-muted">{i + 1} gün önce</span>
                          <button className="btn btn-primary py-1 px-3 text-sm">
                            <Mail className="w-4 h-4 mr-1" />
                            İletişim
                          </button>
                        </div>
                      </div>
                    ))}
                  </div>
                </div>
              </div>
            )}

            {activeTab === "settings" && (
              <div className="bg-surface rounded-2xl border border-border/50 p-8">
                <h2 className="font-display text-2xl font-bold mb-8">Ayarlar</h2>
                
                <div className="space-y-8">
                  {/* Site Settings */}
                  <div>
                    <h3 className="font-semibold text-lg mb-4">Site Ayarları</h3>
                    <div className="space-y-4">
                      <div>
                        <label className="label">Site Adı</label>
                        <input type="text" defaultValue="Metabilinc" className="input max-w-md" />
                      </div>
                      <div>
                        <label className="label">Site Açıklaması</label>
                        <textarea className="input max-w-md" rows={3} defaultValue="Aile ve evlilik eğitiminde lider platform" />
                      </div>
                    </div>
                  </div>

                  {/* Payment Settings */}
                  <div className="pt-8 border-t border-border">
                    <h3 className="font-semibold text-lg mb-4">Ödeme Ayarları</h3>
                    <div className="space-y-4">
                      <div>
                        <label className="label">İyzico API Key</label>
                        <input type="text" placeholder="Enter Iyzico API Key" className="input max-w-md" />
                      </div>
                      <div>
                        <label className="label">İyzico Secret Key</label>
                        <input type="password" placeholder="Enter Iyzico Secret Key" className="input max-w-md" />
                      </div>
                      <div>
                        <label className="label">PayTR Merchant ID</label>
                        <input type="text" placeholder="Enter PayTR Merchant ID" className="input max-w-md" />
                      </div>
                      <div>
                        <label className="label">PayTR Merchant Key</label>
                        <input type="password" placeholder="Enter PayTR Merchant Key" className="input max-w-md" />
                      </div>
                    </div>
                  </div>

                  <div className="pt-8">
                    <button className="btn btn-primary">
                      Ayarları Kaydet
                    </button>
                  </div>
                </div>
              </div>
            )}
          </motion.div>
        </div>
      </div>
    </div>
  );
}
