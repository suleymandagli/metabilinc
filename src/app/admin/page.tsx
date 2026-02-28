"use client";

import { useState, useEffect } from "react";
import { motion } from "framer-motion";
import Link from "next/link";
import { 
  BookOpen, Users, DollarSign, Mail, Settings, Plus, 
  Search, Edit, Trash2, Eye, MoreVertical, TrendingUp,
  ArrowUpRight, ArrowDownRight, Clock, CheckCircle, XCircle,
  BarChart3, FileText, Bell, Loader2, Save, X
} from "lucide-react";
import { formatPrice } from "@/lib/utils";

// Types
interface Course {
  id: number;
  title: string;
  slug: string;
  description?: string;
  shortDescription?: string;
  price: number;
  discountedPrice?: number;
  thumbnail?: string;
  category?: string;
  isFree: number;
  isFeatured: number;
  status: string;
  enrolledCount?: number;
  createdAt: string;
}

interface Order {
  id: number;
  courseId: number;
  courseTitle: string;
  amount: number;
  status: string;
  customerName: string;
  customerEmail: string;
  createdAt: string;
}

interface Lead {
  id: number;
  name: string;
  email: string;
  phone?: string;
  source?: string;
  courseTitle?: string;
  status: string;
  createdAt: string;
}

interface Stats {
  totalRevenue: number;
  totalStudents: number;
  totalCourses: number;
  newLeads: number;
}

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

// Course Form Modal
function CourseModal({ course, onClose, onSave }: { course?: Course | null; onClose: () => void; onSave: () => void }) {
  const [formData, setFormData] = useState({
    title: course?.title || "",
    slug: course?.slug || "",
    description: course?.description || "",
    shortDescription: course?.shortDescription || "",
    price: course?.price || 0,
    discountedPrice: course?.discountedPrice || 0,
    category: course?.category || "aile",
    status: course?.status || "draft",
    isFree: course?.isFree || 0,
    isFeatured: course?.isFeatured || 0,
  });
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    
    try {
      const url = course ? `/api/admin/courses/${course.id}` : "/api/admin/courses";
      const method = course ? "PUT" : "POST";
      
      const res = await fetch(url, {
        method,
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData),
      });
      
      if (res.ok) {
        onSave();
        onClose();
      }
    } catch (error) {
      console.error("Error saving course:", error);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
      <div className="bg-surface rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div className="p-6 border-b border-border flex items-center justify-between">
          <h2 className="text-xl font-bold">{course ? "Kurs Düzenle" : "Yeni Kurs Ekle"}</h2>
          <button onClick={onClose} className="p-2 hover:bg-secondary rounded-lg">
            <X className="w-5 h-5" />
          </button>
        </div>
        <form onSubmit={handleSubmit} className="p-6 space-y-4">
          <div>
            <label className="label">Kurs Adı</label>
            <input
              type="text"
              className="input"
              value={formData.title}
              onChange={(e) => setFormData({ ...formData, title: e.target.value, slug: e.target.value.toLowerCase().replace(/\s+/g, '-') })}
              required
            />
          </div>
          <div>
            <label className="label">Kısa Açıklama</label>
            <textarea
              className="input"
              rows={2}
              value={formData.shortDescription}
              onChange={(e) => setFormData({ ...formData, shortDescription: e.target.value })}
            />
          </div>
          <div>
            <label className="label">Açıklama</label>
            <textarea
              className="input"
              rows={4}
              value={formData.description}
              onChange={(e) => setFormData({ ...formData, description: e.target.value })}
            />
          </div>
          <div className="grid grid-cols-2 gap-4">
            <div>
              <label className="label">Fiyat (TL)</label>
              <input
                type="number"
                className="input"
                value={formData.price}
                onChange={(e) => setFormData({ ...formData, price: parseFloat(e.target.value) || 0 })}
              />
            </div>
            <div>
              <label className="label">İndirimli Fiyat (TL)</label>
              <input
                type="number"
                className="input"
                value={formData.discountedPrice}
                onChange={(e) => setFormData({ ...formData, discountedPrice: parseFloat(e.target.value) || 0 })}
              />
            </div>
          </div>
          <div className="grid grid-cols-2 gap-4">
            <div>
              <label className="label">Kategori</label>
              <select
                className="input"
                value={formData.category}
                onChange={(e) => setFormData({ ...formData, category: e.target.value })}
              >
                <option value="aile">Aile</option>
                <option value="evlilik">Evlilik</option>
                <option value="genel">Genel</option>
              </select>
            </div>
            <div>
              <label className="label">Durum</label>
              <select
                className="input"
                value={formData.status}
                onChange={(e) => setFormData({ ...formData, status: e.target.value })}
              >
                <option value="draft">Taslak</option>
                <option value="published">Yayında</option>
                <option value="archived">Arşiv</option>
              </select>
            </div>
          </div>
          <div className="flex gap-4">
            <label className="flex items-center gap-2">
              <input
                type="checkbox"
                checked={formData.isFree === 1}
                onChange={(e) => setFormData({ ...formData, isFree: e.target.checked ? 1 : 0 })}
              />
              <span>Ücretsiz Kurs</span>
            </label>
            <label className="flex items-center gap-2">
              <input
                type="checkbox"
                checked={formData.isFeatured === 1}
                onChange={(e) => setFormData({ ...formData, isFeatured: e.target.checked ? 1 : 0 })}
              />
              <span>Öne Çıkan</span>
            </label>
          </div>
          <div className="flex justify-end gap-4 pt-4">
            <button type="button" onClick={onClose} className="btn btn-secondary">İptal</button>
            <button type="submit" disabled={loading} className="btn btn-primary">
              {loading ? <Loader2 className="w-5 h-5 animate-spin" /> : <Save className="w-5 h-5 mr-2" />}
              Kaydet
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}

export default function AdminPage() {
  const [activeTab, setActiveTab] = useState("overview");
  const [searchQuery, setSearchQuery] = useState("");
  const [loading, setLoading] = useState(true);
  
  // Data states
  const [stats, setStats] = useState<Stats>({ totalRevenue: 0, totalStudents: 0, totalCourses: 0, newLeads: 0 });
  const [courses, setCourses] = useState<Course[]>([]);
  const [orders, setOrders] = useState<Order[]>([]);
  const [leads, setLeads] = useState<Lead[]>([]);
  
  // Modal states
  const [showCourseModal, setShowCourseModal] = useState(false);
  const [editingCourse, setEditingCourse] = useState<Course | null>(null);

  // Fetch data on mount and tab change
  useEffect(() => {
    fetchData();
  }, [activeTab]);

  const fetchData = async () => {
    setLoading(true);
    try {
      if (activeTab === "overview") {
        const [statsRes] = await Promise.all([
          fetch("/api/admin/stats"),
        ]);
        const statsData = await statsRes.json();
        setStats(statsData);
      } else if (activeTab === "courses") {
        const [coursesRes] = await Promise.all([
          fetch("/api/admin/courses"),
        ]);
        const coursesData = await coursesRes.json();
        setCourses(coursesData);
      } else if (activeTab === "orders") {
        const [ordersRes] = await Promise.all([
          fetch("/api/admin/orders"),
        ]);
        const ordersData = await ordersRes.json();
        setOrders(ordersData);
      } else if (activeTab === "leads") {
        const [leadsRes] = await Promise.all([
          fetch("/api/admin/leads"),
        ]);
        const leadsData = await leadsRes.json();
        setLeads(leadsData);
      }
    } catch (error) {
      console.error("Error fetching data:", error);
    } finally {
      setLoading(false);
    }
  };

  const handleEditCourse = (course: Course) => {
    setEditingCourse(course);
    setShowCourseModal(true);
  };

  const handleDeleteCourse = async (courseId: number) => {
    if (!confirm("Bu kursu silmek istediğinizden emin misiniz?")) return;
    
    try {
      const res = await fetch(`/api/admin/courses/${courseId}`, { method: "DELETE" });
      if (res.ok) {
        fetchData();
      }
    } catch (error) {
      console.error("Error deleting course:", error);
    }
  };

  const handleSaveCourse = () => {
    fetchData();
  };

  // Filter courses based on search
  const filteredCourses = courses.filter(course => 
    course.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
    course.category?.toLowerCase().includes(searchQuery.toLowerCase())
  );

  // Format date helper
  const formatDate = (dateStr: string) => {
    const date = new Date(dateStr);
    const now = new Date();
    const diff = now.getTime() - date.getTime();
    const minutes = Math.floor(diff / 60000);
    const hours = Math.floor(diff / 3600000);
    const days = Math.floor(diff / 86400000);
    
    if (minutes < 60) return `${minutes} dk önce`;
    if (hours < 24) return `${hours} saat önce`;
    if (days < 30) return `${days} gün önce`;
    return date.toLocaleDateString("tr-TR");
  };

  if (loading && activeTab !== "settings") {
    return (
      <div className="min-h-screen bg-secondary-light pt-24 pb-20 flex items-center justify-center">
        <Loader2 className="w-8 h-8 animate-spin text-primary" />
      </div>
    );
  }

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
              <button 
                onClick={() => { setEditingCourse(null); setShowCourseModal(true); }}
                className="btn btn-primary"
              >
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
                    positive={true} 
                  />
                  <StatCard 
                    icon={Users} 
                    label="Toplam Öğrenci" 
                    value={stats.totalStudents.toLocaleString()} 
                    positive={true} 
                  />
                  <StatCard 
                    icon={BookOpen} 
                    label="Aktif Kurs" 
                    value={stats.totalCourses} 
                    positive={true} 
                  />
                  <StatCard 
                    icon={Mail} 
                    label="Leadler" 
                    value={stats.newLeads} 
                    positive={true} 
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
                  {orders.length > 0 ? (
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
                          {orders.slice(0, 5).map((order) => (
                            <tr key={order.id} className="border-t border-border">
                              <td className="p-4 font-mono text-sm">MB-{order.id.toString().padStart(6, '0')}</td>
                              <td className="p-4">{order.courseTitle || "Kurs"}</td>
                              <td className="p-4">{order.customerName || "Müşteri"}</td>
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
                              <td className="p-4 text-text-muted text-sm">{formatDate(order.createdAt)}</td>
                            </tr>
                          ))}
                        </tbody>
                      </table>
                    </div>
                  ) : (
                    <div className="p-8 text-center text-text-muted">
                      Henüz sipariş yok
                    </div>
                  )}
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
                  {leads.length > 0 ? (
                    <div className="divide-y divide-border">
                      {leads.slice(0, 5).map((lead) => (
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
                            <div className="text-sm">{lead.source || "Web"}</div>
                            <div className="text-xs text-text-muted">{formatDate(lead.createdAt)}</div>
                          </div>
                        </div>
                      ))}
                    </div>
                  ) : (
                    <div className="p-8 text-center text-text-muted">
                      Henüz lead yok
                    </div>
                  )}
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
                  </div>
                </div>

                {/* Course List */}
                <div className="bg-surface rounded-2xl border border-border/50 overflow-hidden">
                  {filteredCourses.length > 0 ? (
                    <div className="overflow-x-auto">
                      <table className="w-full">
                        <thead className="bg-secondary-light">
                          <tr>
                            <th className="text-left p-4 font-semibold">Kurs</th>
                            <th className="text-left p-4 font-semibold">Kategori</th>
                            <th className="text-left p-4 font-semibold">Fiyat</th>
                            <th className="text-left p-4 font-semibold">Durum</th>
                            <th className="text-left p-4 font-semibold">İşlemler</th>
                          </tr>
                        </thead>
                        <tbody>
                          {filteredCourses.map((course) => (
                            <tr key={course.id} className="border-t border-border">
                              <td className="p-4 font-semibold">{course.title}</td>
                              <td className="p-4">
                                <span className="px-3 py-1 rounded-full text-xs font-medium bg-secondary text-text">
                                  {course.category === "aile" ? "👨‍👩‍👧 Aile" : course.category === "evlilik" ? "💑 Evlilik" : "📚 Genel"}
                                </span>
                              </td>
                              <td className="p-4 font-semibold">
                                {course.isFree ? "Ücretsiz" : course.discountedPrice ? formatPrice(course.discountedPrice) : formatPrice(course.price)}
                              </td>
                              <td className="p-4">
                                <span className={`px-3 py-1 rounded-full text-xs font-medium ${
                                  course.status === "published" 
                                    ? "bg-success/10 text-success" 
                                    : course.status === "archived"
                                    ? "bg-error/10 text-error"
                                    : "bg-warning/10 text-warning"
                                }`}>
                                  {course.status === "published" ? "Yayında" : course.status === "archived" ? "Arşiv" : "Taslak"}
                                </span>
                              </td>
                              <td className="p-4">
                                <div className="flex items-center gap-2">
                                  <Link 
                                    href={`/kurs/${course.slug}`}
                                    className="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center hover:bg-primary hover:text-white transition-colors"
                                  >
                                    <Eye className="w-4 h-4" />
                                  </Link>
                                  <button 
                                    onClick={() => handleEditCourse(course)}
                                    className="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center hover:bg-primary hover:text-white transition-colors"
                                  >
                                    <Edit className="w-4 h-4" />
                                  </button>
                                  <button 
                                    onClick={() => handleDeleteCourse(course.id)}
                                    className="w-8 h-8 rounded-lg bg-error/10 flex items-center justify-center hover:bg-error hover:text-white transition-colors"
                                  >
                                    <Trash2 className="w-4 h-4" />
                                  </button>
                                </div>
                              </td>
                            </tr>
                          ))}
                        </tbody>
                      </table>
                    </div>
                  ) : (
                    <div className="p-8 text-center text-text-muted">
                      {searchQuery ? "Kurs bulunamadı" : "Henüz kurs eklenmemiş. Yeni kurs eklemek için yukarıdaki butonu kullanın."}
                    </div>
                  )}
                </div>
              </div>
            )}

            {activeTab === "orders" && (
              <div className="bg-surface rounded-2xl border border-border/50 overflow-hidden">
                <div className="p-6 border-b border-border">
                  <h2 className="font-display text-lg font-semibold">Tüm Siparişler</h2>
                </div>
                {orders.length > 0 ? (
                  <div className="overflow-x-auto">
                    <table className="w-full">
                      <thead className="bg-secondary-light">
                        <tr>
                          <th className="text-left p-4 font-semibold">Sipariş No</th>
                          <th className="text-left p-4 font-semibold">Kurs</th>
                          <th className="text-left p-4 font-semibold">Müşteri</th>
                          <th className="text-left p-4 font-semibold">Tutar</th>
                          <th className="text-left p-4 font-semibold">Durum</th>
                          <th className="text-left p-4 font-semibold">Tarih</th>
                        </tr>
                      </thead>
                      <tbody>
                        {orders.map((order) => (
                          <tr key={order.id} className="border-t border-border">
                            <td className="p-4 font-mono text-sm">MB-{order.id.toString().padStart(6, '0')}</td>
                            <td className="p-4">{order.courseTitle || "Kurs"}</td>
                            <td className="p-4">
                              <div>{order.customerName || "Müşteri"}</div>
                              <div className="text-xs text-text-muted">{order.customerEmail}</div>
                            </td>
                            <td className="p-4 font-semibold">{formatPrice(order.amount)}</td>
                            <td className="p-4">
                              <span className={`px-3 py-1 rounded-full text-xs font-medium ${
                                order.status === "completed" ? "bg-success/10 text-success" :
                                order.status === "pending" ? "bg-warning/10 text-warning" :
                                "bg-error/10 text-error"
                              }`}>
                                {order.status === "completed" ? "Tamamlandı" : 
                                 order.status === "pending" ? "Bekliyor" : 
                                 order.status === "refunded" ? "İade" : "Başarısız"}
                              </span>
                            </td>
                            <td className="p-4 text-text-muted text-sm">{formatDate(order.createdAt)}</td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                ) : (
                  <div className="p-8 text-center text-text-muted">
                    Henüz sipariş yok
                  </div>
                )}
              </div>
            )}

            {activeTab === "leads" && (
              <div className="space-y-6">
                {/* Lead Stats */}
                <div className="grid sm:grid-cols-3 gap-6">
                  <div className="bg-surface rounded-2xl p-6 border border-border/50">
                    <div className="text-3xl font-bold mb-2">{leads.length}</div>
                    <div className="text-text-muted">Toplam Lead</div>
                  </div>
                  <div className="bg-surface rounded-2xl p-6 border border-border/50">
                    <div className="text-3xl font-bold mb-2">{leads.filter(l => l.status === "new").length}</div>
                    <div className="text-text-muted">Yeni Leadler</div>
                  </div>
                  <div className="bg-surface rounded-2xl p-6 border border-border/50">
                    <div className="text-3xl font-bold mb-2">{leads.filter(l => l.status === "converted").length}</div>
                    <div className="text-text-muted">Dönüşüm</div>
                  </div>
                </div>

                {/* Lead List */}
                <div className="bg-surface rounded-2xl border border-border/50 overflow-hidden">
                  <div className="p-6 border-b border-border">
                    <h2 className="font-display text-lg font-semibold">Tüm Leadler</h2>
                  </div>
                  {leads.length > 0 ? (
                    <div className="divide-y divide-border">
                      {leads.map((lead) => (
                        <div key={lead.id} className="p-4 flex items-center justify-between hover:bg-secondary-light/50">
                          <div className="flex items-center gap-4">
                            <div className="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center">
                              <span className="text-lg">{lead.name[0]}</span>
                            </div>
                            <div>
                              <div className="font-semibold">{lead.name}</div>
                              <div className="text-sm text-text-muted">{lead.email}</div>
                              {lead.phone && <div className="text-xs text-text-muted">{lead.phone}</div>}
                            </div>
                          </div>
                          <div className="flex items-center gap-4">
                            <span className="text-sm">{lead.source || "Web"}</span>
                            <span className={`px-3 py-1 rounded-full text-xs font-medium ${
                              lead.status === "new" ? "bg-warning/10 text-warning" :
                              lead.status === "contacted" ? "bg-primary/10 text-primary" :
                              lead.status === "converted" ? "bg-success/10 text-success" :
                              "bg-error/10 text-error"
                            }`}>
                              {lead.status === "new" ? "Yeni" : 
                               lead.status === "contacted" ? "İletişim Kuruldu" : 
                               lead.status === "converted" ? "Dönüştü" : "Kayıp"}
                            </span>
                            <span className="text-sm text-text-muted">{formatDate(lead.createdAt)}</span>
                          </div>
                        </div>
                      ))}
                    </div>
                  ) : (
                    <div className="p-8 text-center text-text-muted">
                      Henüz lead yok
                    </div>
                  )}
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
                        <input type="text" defaultValue="Metabilinç Akademi" className="input max-w-md" />
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
                        <input type="text" placeholder="İyzico API Key girin" className="input max-w-md" />
                      </div>
                      <div>
                        <label className="label">İyzico Secret Key</label>
                        <input type="password" placeholder="İyzico Secret Key girin" className="input max-w-md" />
                      </div>
                      <div>
                        <label className="label">PayTR Merchant ID</label>
                        <input type="text" placeholder="PayTR Merchant ID girin" className="input max-w-md" />
                      </div>
                      <div>
                        <label className="label">PayTR Merchant Key</label>
                        <input type="password" placeholder="PayTR Merchant Key girin" className="input max-w-md" />
                      </div>
                    </div>
                  </div>

                  <div className="pt-8">
                    <button className="btn btn-primary">
                      <Save className="w-5 h-5 mr-2" />
                      Ayarları Kaydet
                    </button>
                  </div>
                </div>
              </div>
            )}
          </motion.div>
        </div>
      </div>

      {/* Course Modal */}
      {showCourseModal && (
        <CourseModal 
          course={editingCourse} 
          onClose={() => { setShowCourseModal(false); setEditingCourse(null); }} 
          onSave={handleSaveCourse}
        />
      )}
    </div>
  );
}
