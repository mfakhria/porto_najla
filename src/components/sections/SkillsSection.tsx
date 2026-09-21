import NumberFlow from "@number-flow/react";
import { motion, useInView, useMotionTemplate, useMotionValue } from "framer-motion";
import { useRef, type MouseEvent } from "react";
import { Reveal } from "@/components/ui/reveal";

const skills = [
  { name: "PHP · Laravel", value: 96, note: "OMS · VMS · FMS", accent: true },
  { name: "APIs · Auth", value: 91, note: "JWT · Sanctum · SSO", accent: false },
  { name: "Redis · Queues", value: 86, note: "Bulk · Reverb · Jobs", accent: false },
  { name: "SQL · Cloud", value: 82, note: "S3 · FCM · Integrations", accent: false },
];

function CountUp({ value }: { value: number }) {
  const ref = useRef<HTMLSpanElement>(null);
  const inView = useInView(ref, { once: true, amount: 0.7 });

  return (
    <span ref={ref}>
      <NumberFlow value={inView ? value : 0} />
    </span>
  );
}

export function SkillsSection() {
  const stage = useRef<HTMLElement>(null);
  const mouseX = useMotionValue(50);
  const mouseY = useMotionValue(38);
  const spotlight = useMotionTemplate`radial-gradient(520px circle at ${mouseX}% ${mouseY}%, color-mix(in srgb, var(--sem-accent-primary) 38%, transparent), transparent 58%)`;

  const moveSpotlight = (event: MouseEvent<HTMLElement>) => {
    const node = stage.current;
    if (!node) return;
    const rect = node.getBoundingClientRect();
    mouseX.set(((event.clientX - rect.left) / rect.width) * 100);
    mouseY.set(((event.clientY - rect.top) / rect.height) * 100);
  };

  return (
    <section
      ref={stage}
      data-theme="skills"
      id="skills"
      onMouseMove={moveSpotlight}
      className="relative overflow-hidden bg-bg-base py-28 text-fg-primary md:py-40"
    >
      <motion.div aria-hidden style={{ background: spotlight }} className="pointer-events-none absolute inset-0" />
      <div aria-hidden className="absolute -right-24 top-32 size-72 rounded-full bg-accent-secondary/20 blur-3xl" />
      <div aria-hidden className="absolute -left-28 bottom-16 size-80 rounded-full bg-accent-primary/16 blur-3xl" />

      <div className="container-shell relative z-10">
        <Reveal className="mx-auto max-w-2xl text-center">
          <p className="section-kicker">Toolkit · 03</p>
          <h2 className="mt-4 font-display text-6xl tracking-tight md:text-8xl">
            The stack behind<br />
            <em className="text-accent-primary">the work.</em>
          </h2>
          <p className="mt-5 text-fg-muted">
            What powers Digilog, Vendor, and Fleet day to day—from Laravel APIs to queues, auth, and cross-system integrations.
          </p>
        </Reveal>

        <div className="mx-auto mt-16 grid max-w-4xl grid-cols-2 items-end gap-3 sm:mt-20 md:mt-24 md:h-[410px] md:grid-cols-4 md:gap-5">
          {skills.map((skill, index) => (
            <Reveal key={skill.name} delay={index * 0.08} className="flex h-full flex-col justify-end">
              <div className="mb-3 min-h-9 text-center text-[10px] font-semibold uppercase tracking-wider text-fg-muted md:text-xs">
                {skill.note}
              </div>

              <motion.div
                whileHover={{ y: -6 }}
                transition={{ type: "spring", stiffness: 320, damping: 24 }}
                className="soft-shadow relative h-[220px] overflow-hidden rounded-[1.35rem] border border-border-subtle sm:h-[260px] md:h-[320px] md:rounded-[1.75rem]"
              >
                <div className="candy-bg absolute inset-0" />

                <motion.div
                  initial={{ height: 0 }}
                  whileInView={{ height: `${skill.value}%` }}
                  viewport={{ once: true, amount: 0.35 }}
                  transition={{ type: "spring", stiffness: 62, damping: 15, mass: 0.72, delay: 0.16 + index * 0.12 }}
                  className={`absolute inset-x-0 bottom-0 rounded-[1.75rem] ${
                    skill.accent ? "bg-accent-primary" : "bg-accent-secondary"
                  }`}
                >
                  <motion.span
                    initial={{ opacity: 0, y: 10 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    transition={{ delay: 0.55 + index * 0.12, duration: 0.4, ease: [0.22, 1, 0.36, 1] }}
                    className="absolute inset-x-2 top-3 rounded-full bg-bg-elevated/45 py-2 text-center font-display text-lg text-fg-primary md:text-2xl"
                  >
                    <CountUp value={skill.value} />
                  </motion.span>
                </motion.div>
              </motion.div>

              <p className="mt-4 text-center text-xs font-semibold text-fg-primary md:text-sm">{skill.name}</p>
            </Reveal>
          ))}
        </div>
      </div>
    </section>
  );
}
