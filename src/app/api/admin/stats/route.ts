import { NextResponse } from 'next/server';
import { db } from '@/db';
import { orders, courses, enrollments, leads } from '@/db/schema';
import { eq, desc, sql, count, sum } from 'drizzle-orm';

export async function GET() {
  try {
    // Get total revenue from completed orders
    const revenueResult = await db
      .select({
        total: sum(orders.amount),
      })
      .from(orders)
      .where(eq(orders.status, 'completed'));
    
    const totalRevenue = revenueResult[0]?.total || 0;
    
    // Get total students (unique users in enrollments)
    const studentsResult = await db
      .select({
        count: sql<number>`COUNT(DISTINCT ${enrollments.userId})`,
      })
      .from(enrollments);
    
    const totalStudents = studentsResult[0]?.count || 0;
    
    // Get active courses count
    const coursesResult = await db
      .select({
        count: count(),
      })
      .from(courses)
      .where(eq(courses.status, 'published'));
    
    const totalCourses = coursesResult[0]?.count || 0;
    
    // Get new leads this week
    const leadsResult = await db
      .select({
        count: count(),
      })
      .from(leads);
    
    const newLeads = leadsResult[0]?.count || 0;
    
    return NextResponse.json({
      totalRevenue: Number(totalRevenue),
      totalStudents,
      totalCourses,
      newLeads,
    });
  } catch (error) {
    console.error('Error fetching stats:', error);
    return NextResponse.json({ error: 'İstatistikler yüklenirken hata oluştu' }, { status: 500 });
  }
}
