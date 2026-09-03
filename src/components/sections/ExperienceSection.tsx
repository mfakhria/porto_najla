import { ArrowDownRight } from "lucide-react";
import { experiences } from "@/data/portfolio";
import { Reveal } from "@/components/ui/reveal";

export function ExperienceSection() {
  return (
    <section data-theme="experience" id="experience" className="bg-bg-base py-28 text-fg-primary md:py-40">
      <div className="container-shell">
        <Reveal className="grid gap-8 md:grid-cols-[.8fr_1.2fr]">
          <div><p className="text-xs font-bold uppercase tracking-[.2em]">Professional experience · 04</p><h2 className="mt-5 font-display text-6xl leading-[.88] tracking-tight md:text-8xl">Three contexts.<br /><em>One direction.</em></h2></div>
          <p className="max-w-xl self-end text-lg leading-8 text-fg-muted md:justify-self-end">Industry, government, and an intensive academy cohort shaped a perspective that moves comfortably between backend systems, user needs, and business workflows.</p>
        </Reveal>

        <div className="mt-20 border-t border-border-subtle">
          {experiences.map((experience, index) => (
            <Reveal key={experience.organization} delay={index * .08}>
              <article className="group grid gap-6 border-b border-border-subtle py-8 transition md:grid-cols-[80px_1fr_1fr] md:items-start md:py-10">
                <span className="font-display text-3xl text-fg-muted">0{index + 1}</span>
                <div><p className="text-xs font-semibold uppercase tracking-[.14em] text-fg-muted">{experience.context}</p><h3 className="mt-2 font-display text-4xl leading-none md:text-5xl">{experience.organization}</h3><p className="mt-3 font-semibold">{experience.role}</p></div>
                <div><p className="mb-4 text-xs font-bold uppercase tracking-wider">{experience.period}</p><p className="leading-7 text-fg-muted">{experience.description}</p><ArrowDownRight className="mt-5 transition-transform group-hover:translate-x-1 group-hover:translate-y-1" size={22} /></div>
              </article>
            </Reveal>
          ))}
        </div>
      </div>
    </section>
  );
}
