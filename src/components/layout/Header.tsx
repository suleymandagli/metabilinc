"use client";

import { useState } from "react";
import Link from "next/link";
import { motion, AnimatePresence } from "framer-motion";
import { Menu, X, ChevronDown, User, BookOpen } from "lucide-react";

const navigation = [
  { name: "Ana Sayfa", href: "/" },
  { 
    name: "Kurslar", 
    href: "/kurslar",
    children: [
      { name: "Tüm Kurslar", href: "/kurslar" },
      { name: "Bilinçli Aile Okulu", href: "/kurs/bilincli-aile-okulu" },
      { name: "Bilinci Evlilik Akademisi", href: "/kurs/bilincli-evlilik-akademisi" },
    ]
  },
  { name: "Hakkımızda", href: "/hakkimizda" },
  { name: "İletişim", href: "/iletisim" },
];

export function Header() {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [dropdownOpen, setDropdownOpen] = useState<string | null>(null);

  return (
    <header className="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-border/50">
      <nav className="container-main">
        <div className="flex items-center justify-between h-20">
          {/* Logo */}
          <Link href="/" className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-xl gradient-bg flex items-center justify-center">
              <BookOpen className="w-5 h-5 text-white" />
            </div>
            <span className="font-display text-xl font-bold text-primary">
              Metabilinc
            </span>
          </Link>

          {/* Desktop Navigation */}
          <div className="hidden lg:flex items-center gap-8">
            {navigation.map((item) => (
              <div key={item.name} className="relative">
                {item.children ? (
                  <div 
                    className="flex items-center gap-1 cursor-pointer"
                    onMouseEnter={() => setDropdownOpen(item.name)}
                    onMouseLeave={() => setDropdownOpen(null)}
                  >
                    <Link 
                      href={item.href} 
                      className="text-text hover:text-primary transition-colors font-medium"
                    >
                      {item.name}
                    </Link>
                    <ChevronDown className={`w-4 h-4 transition-transform ${dropdownOpen === item.name ? 'rotate-180' : ''}`} />
                    
                    <AnimatePresence>
                      {dropdownOpen === item.name && (
                        <motion.div
                          initial={{ opacity: 0, y: 10 }}
                          animate={{ opacity: 1, y: 0 }}
                          exit={{ opacity: 0, y: 10 }}
                          className="absolute top-full left-0 mt-2 w-56 bg-surface rounded-xl shadow-xl border border-border/50 overflow-hidden"
                        >
                          {item.children.map((child) => (
                            <Link
                              key={child.name}
                              href={child.href}
                              className="block px-4 py-3 text-text hover:bg-secondary hover:text-primary transition-colors"
                            >
                              {child.name}
                            </Link>
                          ))}
                        </motion.div>
                      )}
                    </AnimatePresence>
                  </div>
                ) : (
                  <Link 
                    href={item.href}
                    className="text-text hover:text-primary transition-colors font-medium"
                  >
                    {item.name}
                  </Link>
                )}
              </div>
            ))}
          </div>

          {/* CTA Buttons */}
          <div className="hidden lg:flex items-center gap-4">
            <Link 
              href="/dashboard"
              className="flex items-center gap-2 text-text hover:text-primary transition-colors font-medium"
            >
              <User className="w-4 h-4" />
              Giriş Yap
            </Link>
            <Link href="/kurslar" className="btn btn-primary">
              Kursları Keşfet
            </Link>
          </div>

          {/* Mobile Menu Button */}
          <button
            className="lg:hidden p-2"
            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
          >
            {mobileMenuOpen ? (
              <X className="w-6 h-6" />
            ) : (
              <Menu className="w-6 h-6" />
            )}
          </button>
        </div>

        {/* Mobile Menu */}
        <AnimatePresence>
          {mobileMenuOpen && (
            <motion.div
              initial={{ opacity: 0, height: 0 }}
              animate={{ opacity: 1, height: "auto" }}
              exit={{ opacity: 0, height: 0 }}
              className="lg:hidden border-t border-border/50 py-4"
            >
              <div className="flex flex-col gap-4">
                {navigation.map((item) => (
                  <div key={item.name}>
                    <Link
                      href={item.href}
                      className="block py-2 text-text hover:text-primary font-medium"
                      onClick={() => setMobileMenuOpen(false)}
                    >
                      {item.name}
                    </Link>
                    {item.children && (
                      <div className="ml-4 mt-2 space-y-2 border-l-2 border-border pl-4">
                        {item.children.map((child) => (
                          <Link
                            key={child.name}
                            href={child.href}
                            className="block py-2 text-text-muted hover:text-primary"
                            onClick={() => setMobileMenuOpen(false)}
                          >
                            {child.name}
                          </Link>
                        ))}
                      </div>
                    )}
                  </div>
                ))}
                <div className="pt-4 flex flex-col gap-3">
                  <Link 
                    href="/dashboard"
                    className="btn btn-outline w-full"
                  >
                    Giriş Yap
                  </Link>
                  <Link 
                    href="/kurslar"
                    className="btn btn-primary w-full"
                  >
                    Kursları Keşfet
                  </Link>
                </div>
              </div>
            </motion.div>
          )}
        </AnimatePresence>
      </nav>
    </header>
  );
}
