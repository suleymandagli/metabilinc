import { drizzle } from 'drizzle-orm/better-sqlite3';
import Database from 'better-sqlite3';
import * as schema from './schema';

const sqlite = new Database('metabilinc.db');
export const db = drizzle(sqlite, { schema });

export type User = typeof schema.users.$inferSelect;
export type NewUser = typeof schema.users.$inferInsert;
export type Course = typeof schema.courses.$inferSelect;
export type NewCourse = typeof schema.courses.$inferInsert;
export type Module = typeof schema.modules.$inferSelect;
export type Lesson = typeof schema.lessons.$inferSelect;
export type Enrollment = typeof schema.enrollments.$inferSelect;
export type Lead = typeof schema.leads.$inferSelect;
export type Order = typeof schema.orders.$inferSelect;
export type Offer = typeof schema.offers.$inferSelect;
