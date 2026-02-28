import { NextResponse } from 'next/server';
import { db } from '@/db';
import { orders, courses } from '@/db/schema';
import { eq, desc, sql } from 'drizzle-orm';

export async function GET() {
  try {
    const allOrders = await db.select({
      id: orders.id,
      courseId: orders.courseId,
      amount: orders.amount,
      currency: orders.currency,
      status: orders.status,
      paymentMethod: orders.paymentMethod,
      customerName: orders.customerName,
      customerEmail: orders.customerEmail,
      createdAt: orders.createdAt,
      completedAt: orders.completedAt,
      courseTitle: courses.title,
    })
    .from(orders)
    .leftJoin(courses, eq(orders.courseId, courses.id))
    .orderBy(desc(orders.createdAt));
    
    return NextResponse.json(allOrders);
  } catch (error) {
    console.error('Error fetching orders:', error);
    return NextResponse.json({ error: 'Siparişler yüklenirken hata oluştu' }, { status: 500 });
  }
}
