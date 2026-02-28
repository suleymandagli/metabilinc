import { NextResponse } from 'next/server';
import { db } from '@/db';
import { courses } from '@/db/schema';
import { eq } from 'drizzle-orm';

export async function GET(
  request: Request,
  { params }: { params: Promise<{ id: string }> }
) {
  try {
    const { id } = await params;
    const course = await db.select().from(courses).where(eq(courses.id, parseInt(id))).limit(1);
    
    if (course.length === 0) {
      return NextResponse.json({ error: 'Kurs bulunamadı' }, { status: 404 });
    }
    
    return NextResponse.json(course[0]);
  } catch (error) {
    console.error('Error fetching course:', error);
    return NextResponse.json({ error: 'Kurs yüklenirken hata oluştu' }, { status: 500 });
  }
}

export async function PUT(
  request: Request,
  { params }: { params: Promise<{ id: string }> }
) {
  try {
    const { id } = await params;
    const body = await request.json();
    
    const updatedCourse = await db
      .update(courses)
      .set({
        ...body,
        updatedAt: new Date().toISOString(),
      })
      .where(eq(courses.id, parseInt(id)))
      .returning();
    
    if (updatedCourse.length === 0) {
      return NextResponse.json({ error: 'Kurs bulunamadı' }, { status: 404 });
    }
    
    return NextResponse.json(updatedCourse[0]);
  } catch (error) {
    console.error('Error updating course:', error);
    return NextResponse.json({ error: 'Kurs güncellenirken hata oluştu' }, { status: 500 });
  }
}

export async function DELETE(
  request: Request,
  { params }: { params: Promise<{ id: string }> }
) {
  try {
    const { id } = await params;
    
    const deletedCourse = await db
      .delete(courses)
      .where(eq(courses.id, parseInt(id)))
      .returning();
    
    if (deletedCourse.length === 0) {
      return NextResponse.json({ error: 'Kurs bulunamadı' }, { status: 404 });
    }
    
    return NextResponse.json({ success: true });
  } catch (error) {
    console.error('Error deleting course:', error);
    return NextResponse.json({ error: 'Kurs silinirken hata oluştu' }, { status: 500 });
  }
}
