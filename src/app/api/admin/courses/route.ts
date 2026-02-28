import { NextResponse } from 'next/server';
import { db } from '@/db';
import { courses } from '@/db/schema';
import { eq, desc } from 'drizzle-orm';

export async function GET() {
  try {
    const allCourses = await db.select().from(courses).orderBy(desc(courses.createdAt));
    return NextResponse.json(allCourses);
  } catch (error) {
    console.error('Error fetching courses:', error);
    return NextResponse.json({ error: 'Kurslar yüklenirken hata oluştu' }, { status: 500 });
  }
}

export async function POST(request: Request) {
  try {
    const body = await request.json();
    
    const newCourse = await db.insert(courses).values({
      title: body.title,
      slug: body.slug,
      description: body.description,
      shortDescription: body.shortDescription,
      price: body.price || 0,
      discountedPrice: body.discountedPrice,
      thumbnail: body.thumbnail,
      banner: body.banner,
      category: body.category,
      isFree: body.isFree ? 1 : 0,
      isFeatured: body.isFeatured ? 1 : 0,
      isMiniCourse: body.isMiniCourse ? 1 : 0,
      instructor: body.instructor,
      duration: body.duration,
      level: body.level,
      status: body.status || 'draft',
    }).returning();
    
    return NextResponse.json(newCourse[0], { status: 201 });
  } catch (error) {
    console.error('Error creating course:', error);
    return NextResponse.json({ error: 'Kurs oluşturulurken hata oluştu' }, { status: 500 });
  }
}
