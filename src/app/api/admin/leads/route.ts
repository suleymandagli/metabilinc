import { NextResponse } from 'next/server';
import { db } from '@/db';
import { leads, courses } from '@/db/schema';
import { eq, desc } from 'drizzle-orm';

export async function GET() {
  try {
    const allLeads = await db.select({
      id: leads.id,
      name: leads.name,
      email: leads.email,
      phone: leads.phone,
      source: leads.source,
      courseId: leads.courseId,
      status: leads.status,
      notes: leads.notes,
      createdAt: leads.createdAt,
      courseTitle: courses.title,
    })
    .from(leads)
    .leftJoin(courses, eq(leads.courseId, courses.id))
    .orderBy(desc(leads.createdAt));
    
    return NextResponse.json(allLeads);
  } catch (error) {
    console.error('Error fetching leads:', error);
    return NextResponse.json({ error: 'Leadler yüklenirken hata oluştu' }, { status: 500 });
  }
}
