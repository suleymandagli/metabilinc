import { sqliteTable, text, integer, real } from 'drizzle-orm/sqlite-core';
import { relations } from 'drizzle-orm';

// Users table
export const users = sqliteTable('users', {
  id: integer('id').primaryKey({ autoIncrement: true }),
  name: text('name').notNull(),
  email: text('email').notNull().unique(),
  phone: text('phone'),
  password: text('password'),
  role: text('role').default('user'), // user, admin
  createdAt: text('created_at').default(new Date().toISOString()),
  updatedAt: text('updated_at').default(new Date().toISOString()),
});

// Courses table
export const courses = sqliteTable('courses', {
  id: integer('id').primaryKey({ autoIncrement: true }),
  title: text('title').notNull(),
  slug: text('slug').notNull().unique(),
  description: text('description'),
  shortDescription: text('short_description'),
  price: real('price').default(0),
  discountedPrice: real('discounted_price'),
  thumbnail: text('thumbnail'),
  banner: text('banner'),
  category: text('category'), // aile, evlilik, genel
  isFree: integer('is_free').default(0),
  isFeatured: integer('is_featured').default(0),
  isMiniCourse: integer('is_mini_course').default(0),
  parentCourseId: integer('parent_course_id'), // For mini courses
  instructor: text('instructor'),
  duration: text('duration'), // "8 hafta", "20 saat"
  level: text('level'), // başlangıç, orta, ileri
  enrolledCount: integer('enrolled_count').default(0),
  rating: real('rating').default(0),
  reviewCount: integer('review_count').default(0),
  syllabus: text('syllabus'), // JSON string
  learningOutcomes: text('learning_outcomes'), // JSON string
  requirements: text('requirements'), // JSON string
  faqs: text('faqs'), // JSON string
  status: text('status').default('draft'), // draft, published, archived
  createdAt: text('created_at').default(new Date().toISOString()),
  updatedAt: text('updated_at').default(new Date().toISOString()),
});

// Modules table (for course curriculum)
export const modules = sqliteTable('modules', {
  id: integer('id').primaryKey({ autoIncrement: true }),
  courseId: integer('course_id').notNull(),
  title: text('title').notNull(),
  description: text('description'),
  order: integer('order').default(0),
  createdAt: text('created_at').default(new Date().toISOString()),
});

// Lessons table
export const lessons = sqliteTable('lessons', {
  id: integer('id').primaryKey({ autoIncrement: true }),
  moduleId: integer('module_id').notNull(),
  title: text('title').notNull(),
  description: text('description'),
  videoUrl: text('video_url'),
  duration: text('duration'),
  order: integer('order').default(0),
  isFree: integer('is_free').default(0),
  createdAt: text('created_at').default(new Date().toISOString()),
});

// Enrollments table
export const enrollments = sqliteTable('enrollments', {
  id: integer('id').primaryKey({ autoIncrement: true }),
  userId: integer('user_id').notNull(),
  courseId: integer('course_id').notNull(),
  progress: real('progress').default(0),
  status: text('status').default('active'), // active, completed, cancelled
  enrolledAt: text('enrolled_at').default(new Date().toISOString()),
  completedAt: text('completed_at'),
});

// Lesson progress table
export const lessonProgress = sqliteTable('lesson_progress', {
  id: integer('id').primaryKey({ autoIncrement: true }),
  userId: integer('user_id').notNull(),
  lessonId: integer('lesson_id').notNull(),
  isCompleted: integer('is_completed').default(0),
  completedAt: text('completed_at'),
});

// Leads table (for email capture)
export const leads = sqliteTable('leads', {
  id: integer('id').primaryKey({ autoIncrement: true }),
  name: text('name').notNull(),
  email: text('email').notNull(),
  phone: text('phone'),
  source: text('source'), // mini-course, ebook, webinar
  courseId: integer('course_id'),
  status: text('status').default('new'), // new, contacted, converted, lost
  notes: text('notes'),
  createdAt: text('created_at').default(new Date().toISOString()),
});

// Orders table
export const orders = sqliteTable('orders', {
  id: integer('id').primaryKey({ autoIncrement: true }),
  userId: integer('user_id'),
  courseId: integer('course_id').notNull(),
  amount: real('amount').notNull(),
  currency: text('currency').default('TRY'),
  status: text('status').default('pending'), // pending, completed, failed, refunded
  paymentMethod: text('payment_method'), // iyzico, paytr
  paymentId: text('payment_id'),
  customerName: text('customer_name'),
  customerEmail: text('customer_email'),
  customerPhone: text('customer_phone'),
  createdAt: text('created_at').default(new Date().toISOString()),
  completedAt: text('completed_at'),
});

// Reviews table
export const reviews = sqliteTable('reviews', {
  id: integer('id').primaryKey({ autoIncrement: true }),
  userId: integer('user_id').notNull(),
  courseId: integer('course_id').notNull(),
  rating: integer('rating').notNull(),
  comment: text('comment'),
  status: text('status').default('pending'), // pending, approved, rejected
  createdAt: text('created_at').default(new Date().toISOString()),
});

// Upsell/Downsell offers
export const offers = sqliteTable('offers', {
  id: integer('id').primaryKey({ autoIncrement: true }),
  courseId: integer('course_id').notNull(), // Main course
  title: text('title').notNull(),
  description: text('description'),
  price: real('price').notNull(),
  type: text('type').notNull(), // upsell, downsell
  order: integer('order').default(0),
  isActive: integer('is_active').default(1),
  createdAt: text('created_at').default(new Date().toISOString()),
});

// Relations
export const coursesRelations = relations(courses, ({ many, one }) => ({
  modules: many(modules),
  enrollments: many(enrollments),
  orders: many(orders),
  reviews: many(reviews),
  offers: many(offers),
  parentCourse: one(courses, {
    fields: [courses.parentCourseId],
    references: [courses.id],
  }),
}));

export const modulesRelations = relations(modules, ({ one, many }) => ({
  course: one(courses, {
    fields: [modules.courseId],
    references: [courses.id],
  }),
  lessons: many(lessons),
}));

export const lessonsRelations = relations(lessons, ({ one }) => ({
  module: one(modules, {
    fields: [lessons.moduleId],
    references: [modules.id],
  }),
}));

export const enrollmentsRelations = relations(enrollments, ({ one }) => ({
  user: one(users, {
    fields: [enrollments.userId],
    references: [users.id],
  }),
  course: one(courses, {
    fields: [enrollments.courseId],
    references: [courses.id],
  }),
}));

export const leadsRelations = relations(leads, ({ one }) => ({
  course: one(courses, {
    fields: [leads.courseId],
    references: [courses.id],
  }),
}));

export const ordersRelations = relations(orders, ({ one }) => ({
  user: one(users, {
    fields: [orders.userId],
    references: [users.id],
  }),
  course: one(courses, {
    fields: [orders.courseId],
    references: [courses.id],
  }),
}));

export const reviewsRelations = relations(reviews, ({ one }) => ({
  user: one(users, {
    fields: [reviews.userId],
    references: [users.id],
  }),
  course: one(courses, {
    fields: [reviews.courseId],
    references: [courses.id],
  }),
}));

export const offersRelations = relations(offers, ({ one }) => ({
  course: one(courses, {
    fields: [offers.courseId],
    references: [courses.id],
  }),
}));
