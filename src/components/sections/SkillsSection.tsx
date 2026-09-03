import { motion } from "framer-motion";
import { Reveal } from "@/components/ui/reveal";

const skills = [
  { name: "PHP · Laravel", value: 94, note: "Primary stack", accent: true },
  { name: "APIs & Backend", value: 88, note: "Daily work", accent: false },
  { name: "PostgreSQL · MySQL", value: 79, note: "Data layer", accent: false },
  { name: "Business Analysis", value: 66, note: "Growing focus", accent: false },
];

export function SkillsSection() {
  return (
    <section data-theme="skills" id="skills" className="relative overflow-hidden bg-bg-base py-28 text-fg-primary md:py-40">
      <div aria-hidden className="absolute -right-24 top-32 size-80 rounded-full bg-accent-secondary/25 blur-3xl" />
      <div aria-hidden className="absolute -left-32 bottom-20 size-96 rounded-full bg-accent-primary/20 blur-3xl" />
      <div className="container-shell">
        <Reveal className="mx-auto max-w-2xl text-center"><p className="section-kicker">Toolkit · 03</p><h2 className="mt-4 font-display text-6xl tracking-tight md:text-8xl">The stack behind<br /><em className="text-accent-primary">the work.</em></h2><p className="mt-5 text-fg-muted">Core tools and disciplines reflected across the projects in this portfolio.</p></Reveal>
        <div className="mx-auto mt-24 grid h-[410px] max-w-4xl grid-cols-4 items-end gap-2 md:gap-4">
          {skills.map((skill, index) => (
            <Reveal key={skill.name} delay={index * .1} className="flex h-full flex-col justify-end">
              <div className="mb-3 min-h-10 text-center text-[10px] font-semibold uppercase tracking-wider text-fg-muted md:text-xs">{skill.note}</div>
              <div className="candy-bg soft-shadow relative h-[330px] overflow-hidden rounded-[2rem] border border-border-subtle">
                <motion.div initial={{ height: 0 }} whileInView={{ height: `${skill.value}%` }} viewport={{ once: true, amount: .25 }} transition={{ duration: 1.25, delay: .15 + index * .12, type: "spring", damping: 18 }} className={`absolute inset-x-0 bottom-0 rounded-[2rem] text-accent-on ${skill.accent ? "bg-accent-primary" : "bg-accent-secondary"}`}>
                  <span className="absolute inset-x-2 top-3 rounded-full bg-bg-elevated/35 py-2 text-center font-display text-lg md:text-2xl">{skill.value}</span>
                </motion.div>
              </div>
              <p className="mt-4 text-center text-xs font-semibold text-fg-primary md:text-sm">{skill.name}</p>
            </Reveal>
          ))}
        </div>
      </div>
    </section>
  );
}
