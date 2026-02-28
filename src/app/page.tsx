import { HeroSection } from "@/components/sections/HeroSection";
import { FeaturedCourses } from "@/components/sections/FeaturedCourses";
import { Testimonials } from "@/components/sections/Testimonials";
import { FreeLeadCapture } from "@/components/sections/FreeLeadCapture";

export default function HomePage() {
  return (
    <>
      <HeroSection />
      <FeaturedCourses />
      <Testimonials />
      <FreeLeadCapture />
    </>
  );
}
