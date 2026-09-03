import { motion, useScroll, useTransform } from "framer-motion";
import { ArrowDownRight, ArrowUpRight, MapPin } from "lucide-react";
import { useRef } from "react";

export function HeroSection() {
  const ref = useRef<HTMLElement>(null);
  const { scrollYProgress } = useScroll({ target: ref, offset: ["start start", "end start"] });
  const contentY = useTransform(scrollYProgress, [0, 1], [0, 150]);
  const contentOpacity = useTransform(scrollYProgress, [0, .82], [1, 0]);
  const radialScale = useTransform(scrollYProgress, [0, 1], [1, 1.3]);

  return (
    <section ref={ref} data-theme="hero" id="home" className="noise relative min-h-dvh overflow-hidden bg-bg-base pt-28 text-fg-primary">
      <div className="grid-field absolute inset-0" aria-hidden />
      <motion.div style={{ scale: radialScale }} className="pointer-events-none absolute left-1/2 top-[72%] h-[55vw] min-h-[520px] w-[120vw] -translate-x-1/2 rounded-[50%] bg-[radial-gradient(closest-side,#080908_76%,#e8ff3a_88%,transparent_100%)] opacity-90" />

      <motion.div style={{ y: contentY, opacity: contentOpacity }} className="container-shell relative z-10 grid min-h-[calc(100dvh-7rem)] grid-cols-[minmax(0,1fr)] items-center gap-12 pb-24 lg:grid-cols-[minmax(0,1.25fr)_minmax(0,.75fr)]">
        <div className="min-w-0">
          <motion.div initial={{ opacity: 0, y: 14 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: .6 }} className="mb-8 flex flex-col items-start gap-3 text-[11px] font-semibold uppercase tracking-[.14em] text-fg-muted sm:flex-row sm:flex-wrap sm:items-center sm:text-xs sm:tracking-[.16em]">
            <span className="rounded-full border border-border-subtle bg-white/[.03] px-4 py-2">Backend Developer</span>
            <span className="flex items-center gap-1.5"><MapPin size={13} className="text-accent-primary" /> Tangerang, Indonesia</span>
          </motion.div>

          <motion.h1 initial={{ opacity: 0, y: 35, filter: "blur(10px)" }} animate={{ opacity: 1, y: 0, filter: "blur(0px)" }} transition={{ duration: .9, delay: .12, ease: [0.22, 1, 0.36, 1] }} className="font-display text-[clamp(3.1rem,10vw,8.8rem)] leading-[.82] tracking-[-.055em]">
            Building systems<br />that <em className="font-normal text-accent-primary">work.</em>
          </motion.h1>

          <motion.div initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: .7, delay: .38 }} className="mt-10 grid max-w-3xl gap-8 md:grid-cols-[1fr_auto] md:items-end">
            <p className="max-w-2xl text-base leading-7 text-fg-muted md:text-lg">
              I’m Najla Putri Afifah, a software engineering graduate with 1+ year of experience building dependable backend and web systems—connecting technical decisions with real business needs.
            </p>
            <a href="#projects" className="inline-flex w-fit items-center gap-2 rounded-full bg-accent-primary px-6 py-3.5 text-sm font-bold text-accent-on transition hover:-translate-y-1">
              Explore work <ArrowDownRight size={17} />
            </a>
          </motion.div>

          <motion.div initial={{ opacity: 0 }} animate={{ opacity: 1 }} transition={{ delay: .65 }} className="mt-12 flex flex-wrap gap-x-9 gap-y-4 border-t border-border-subtle pt-6">
            {[["13+", "Projects"], ["3", "Professional roles"], ["12", "Credentials"]].map(([value, label]) => (
              <div key={label}><strong className="font-display text-3xl font-normal text-fg-primary">{value}</strong><span className="ml-2 text-xs uppercase tracking-widest text-fg-muted">{label}</span></div>
            ))}
          </motion.div>
        </div>

        <motion.aside initial={{ opacity: 0, x: 35 }} animate={{ opacity: 1, x: 0 }} transition={{ duration: .85, delay: .3 }} className="relative mx-auto hidden w-full max-w-[390px] lg:block">
          <div className="absolute -inset-4 rotate-3 rounded-[2rem] border border-accent-primary/25" />
          <div className="relative aspect-[.76] overflow-hidden rounded-[1.65rem] border border-white/15 bg-bg-elevated">
            <img src="/images/najla-portrait.png" alt="Najla Putri Afifah" className="h-full w-full object-cover object-top grayscale-[15%]" />
            <div className="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black via-black/50 to-transparent p-6 pt-24">
              <p className="font-display text-3xl">Najla Putri Afifah</p>
              <a href="mailto:najlaputriafifah16@gmail.com" className="mt-2 inline-flex items-center gap-1 text-xs text-accent-primary">Available for meaningful work <ArrowUpRight size={13} /></a>
            </div>
          </div>
        </motion.aside>
      </motion.div>
    </section>
  );
}
