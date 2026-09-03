import { AnimatePresence, motion } from "framer-motion";
import { useState } from "react";
import { Reveal } from "@/components/ui/reveal";

const capabilities = [
  { title: "backend development", subtitle: "Reliable server-side logic and operational workflows", image: "/images/projects/vms-showcase.png" },
  { title: "API & integration", subtitle: "Clear interfaces across products, teams, and data", image: "/images/projects/ckl-connect-showcase.png" },
  { title: "data layer design", subtitle: "SQL-first thinking for dependable business systems", image: "/images/projects/fms-showcase.png" },
  { title: "business analysis", subtitle: "Turning requirements into buildable system decisions", image: "/images/projects/re-actions-showcase.png" },
  { title: "product collaboration", subtitle: "Bridging stakeholders and development teams", image: "/images/projects/wearshare-showcase.png" },
];

export function ServicesSection() {
  const [active, setActive] = useState(0);
  return (
    <section data-theme="services" id="expertise" className="bg-bg-base py-28 text-fg-primary md:py-40">
      <div className="container-shell">
        <Reveal className="grid gap-6 border-b border-border-subtle pb-12 md:grid-cols-2 md:items-end">
          <div><p className="section-kicker">What I bring · 02</p><h2 className="mt-4 font-display text-6xl leading-[.9] tracking-tight md:text-8xl">Technical depth,<br /><em className="text-accent-primary">business context.</em></h2></div>
          <p className="max-w-lg text-fg-muted md:justify-self-end">A backend foundation with a growing focus on business analysis and project management—useful where technical systems must make sense to the people running them.</p>
        </Reveal>

        <div className="mt-16 grid gap-10 lg:grid-cols-[1fr_.8fr] lg:items-center">
          <div>
            {capabilities.map((item, index) => (
              <button key={item.title} type="button" onMouseEnter={() => setActive(index)} onFocus={() => setActive(index)} onClick={() => setActive(index)} className="group flex w-full items-center justify-between border-b border-border-subtle py-5 text-left">
                <span><span className={`font-display text-4xl tracking-tight transition md:text-6xl ${active === index ? "text-accent-primary" : "text-fg-primary/30 group-hover:text-fg-primary"}`}>{item.title}</span><span className={`mt-2 block text-xs text-fg-muted transition ${active === index ? "opacity-100" : "opacity-0"}`}>{item.subtitle}</span></span>
                <span className="text-sm text-fg-muted">0{index + 1}</span>
              </button>
            ))}
          </div>
          <div className="relative aspect-[4/5] overflow-hidden rounded-[1.5rem] border border-border-subtle bg-bg-elevated">
            <AnimatePresence mode="wait">
              <motion.img key={capabilities[active].image} src={capabilities[active].image} alt={capabilities[active].title} initial={{ opacity: 0, scale: 1.08, clipPath: "inset(100% 0 0 0)" }} animate={{ opacity: 1, scale: 1, clipPath: "inset(0 0 0 0)" }} exit={{ opacity: 0 }} transition={{ duration: .65 }} className="absolute inset-0 h-full w-full object-cover" />
            </AnimatePresence>
            <div className="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent" />
            <p className="absolute bottom-6 left-6 right-6 font-display text-3xl">{capabilities[active].subtitle}</p>
          </div>
        </div>
      </div>
    </section>
  );
}
