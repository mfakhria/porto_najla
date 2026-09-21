import { ArrowUpRight } from "lucide-react";
import { certifications } from "@/data/portfolio";
import { Reveal } from "@/components/ui/reveal";

export function CertificationsSection() {
  const featured = certifications.slice(0, 2);
  const rest = certifications.slice(2);

  return (
    <section data-theme="credentials" id="credentials" className="relative overflow-hidden bg-bg-base py-28 text-fg-primary md:py-40">
      <div aria-hidden className="absolute left-1/4 top-10 size-80 rounded-full bg-accent-secondary/20 blur-3xl" />
      <div className="container-shell relative">
        <Reveal className="grid gap-6 md:grid-cols-2 md:items-end">
          <div>
            <p className="section-kicker">Credentials · 05</p>
            <h2 className="mt-4 font-display text-6xl leading-[.9] tracking-tight md:text-8xl">
              Learning,<br />
              <em className="text-accent-primary">verified.</em>
            </h2>
          </div>
          <p className="max-w-md text-fg-muted md:justify-self-end">
            Professional, language, and technical learning credentials—with direct verification links.
          </p>
        </Reveal>

        <div className="mt-14 grid gap-4 md:grid-cols-2">
          {featured.map((certification, index) => (
            <Reveal key={certification.href} delay={index * 0.06}>
              <a
                href={certification.href}
                target="_blank"
                rel="noreferrer"
                className={`soft-shadow group flex min-h-36 flex-col justify-between rounded-[1.5rem] border p-6 transition duration-300 hover:-translate-y-1 ${
                  index === 0
                    ? "border-accent-primary bg-accent-primary text-accent-on"
                    : "border-border-subtle bg-bg-elevated hover:border-border-strong"
                }`}
              >
                <div className="flex items-start justify-between gap-4">
                  <span
                    className={`text-[10px] font-bold uppercase tracking-[.18em] ${
                      index === 0 ? "text-accent-on/65" : "text-accent-primary"
                    }`}
                  >
                    {certification.group}
                  </span>
                  <ArrowUpRight size={17} />
                </div>
                <h3 className="mt-6 max-w-md font-display text-[1.85rem] leading-[1.1] tracking-tight md:text-[2.1rem]">
                  {certification.title}
                </h3>
              </a>
            </Reveal>
          ))}
        </div>

        <Reveal delay={0.1}>
          <div className="mt-8 border-t border-border-subtle pt-6">
            <p className="text-[11px] font-bold uppercase tracking-[0.18em] text-fg-muted">Bangkit Academy</p>
            <div className="mt-4 grid gap-2 sm:grid-cols-2">
              {rest.map((certification) => (
                <a
                  key={certification.href}
                  href={certification.href}
                  target="_blank"
                  rel="noreferrer"
                  className="group flex items-center justify-between gap-4 rounded-2xl border border-border-subtle bg-bg-elevated/70 px-4 py-3.5 transition hover:border-border-strong hover:bg-bg-elevated"
                >
                  <span className="min-w-0">
                    <span className="block truncate text-sm font-medium text-fg-primary group-hover:text-accent-primary">
                      {certification.title}
                    </span>
                  </span>
                  <ArrowUpRight size={15} className="shrink-0 text-fg-muted transition group-hover:text-accent-primary" />
                </a>
              ))}
            </div>
          </div>
        </Reveal>

        <Reveal className="mt-6 text-center">
          <a
            href="https://drive.google.com/file/d/13p5Ms8IfDX9RGWi0NACzFz4uKnZKOYD7/view?usp=sharing"
            target="_blank"
            rel="noreferrer"
            className="inline-flex items-center gap-2 text-sm font-bold text-accent-primary hover:underline"
          >
            Open Bangkit certificate bundle <ArrowUpRight size={15} />
          </a>
        </Reveal>
      </div>
    </section>
  );
}
