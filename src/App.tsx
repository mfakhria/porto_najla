import { useEffect, useState } from "react";
import { CertificationsSection } from "@/components/sections/CertificationsSection";
import { ExperienceSection } from "@/components/sections/ExperienceSection";
import { Footer } from "@/components/sections/Footer";
import { HeroSection } from "@/components/sections/HeroSection";
import { ProjectsSection } from "@/components/sections/ProjectsSection";
import { ServicesSection } from "@/components/sections/ServicesSection";
import { SkillsSection } from "@/components/sections/SkillsSection";
import { Loader } from "@/components/ui/loader";
import { NavBar } from "@/components/ui/nav-bar";
import { SocialDock } from "@/components/ui/social-dock";

function App() {
  const [loading, setLoading] = useState(
    () => !new URLSearchParams(window.location.search).has("skip-loader"),
  );

  useEffect(() => {
    const timer = window.setTimeout(() => setLoading(false), 3000);
    return () => window.clearTimeout(timer);
  }, []);

  return (
    <>
      <Loader visible={loading} />
      <NavBar />
      <main>
        <HeroSection />
        <div className="overflow-hidden border-y border-white/10 bg-accent-primary py-3 text-accent-on">
          <div className="marquee-track flex gap-10 whitespace-nowrap text-xs font-bold uppercase tracking-[.18em]">
            {[0, 1].map((copy) => <span key={copy}>Backend Development · API Development · Requirement Analysis · System Optimization · Business Analysis · Project Collaboration · Backend Development · API Development · Requirement Analysis · System Optimization · Business Analysis · Project Collaboration ·</span>)}
          </div>
        </div>
        <ProjectsSection />
        <ServicesSection />
        <SkillsSection />
        <ExperienceSection />
        <CertificationsSection />
      </main>
      <Footer />
      <SocialDock />
    </>
  );
}

export default App;
