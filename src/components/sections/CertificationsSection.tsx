import { ArrowUpRight } from "lucide-react";
import { certifications } from "@/data/portfolio";
import { Reveal } from "@/components/ui/reveal";

export function CertificationsSection() {
  return (
    <section data-theme="credentials" id="credentials" className="bg-bg-base py-28 text-fg-primary md:py-40">
      <div className="container-shell">
        <Reveal className="grid gap-6 md:grid-cols-2 md:items-end">
          <div><p className="section-kicker">Credentials · 05</p><h2 className="mt-4 font-display text-6xl leading-[.9] tracking-tight md:text-8xl">Learning,<br /><em className="text-accent-primary">verified.</em></h2></div>
          <p className="max-w-md text-fg-muted md:justify-self-end">Professional, language, and technical learning credentials—with direct verification links.</p>
        </Reveal>

        <div className="mt-16 grid gap-4 md:grid-cols-2">
          {certifications.map((certification, index) => (
            <Reveal key={certification.href} delay={(index % 2) * .06}>
              <a href={certification.href} target="_blank" rel="noreferrer" className={`group flex min-h-40 flex-col justify-between rounded-[1.35rem] border p-6 transition hover:-translate-y-1 ${index === 0 ? "border-accent-primary bg-accent-primary text-accent-on" : "border-border-subtle bg-bg-elevated hover:border-border-strong"}`}>
                <div className="flex items-start justify-between gap-4"><span className={`text-[10px] font-bold uppercase tracking-[.18em] ${index === 0 ? "text-black/60" : "text-accent-primary"}`}>{certification.group}</span><ArrowUpRight size={17} /></div>
                <h3 className="mt-8 max-w-md font-display text-3xl leading-none tracking-tight">{certification.title}</h3>
              </a>
            </Reveal>
          ))}
        </div>
        <Reveal className="mt-6 text-center"><a href="https://drive.google.com/file/d/13p5Ms8IfDX9RGWi0NACzFz4uKnZKOYD7/view?usp=sharing" target="_blank" rel="noreferrer" className="inline-flex items-center gap-2 text-sm font-bold text-accent-primary hover:underline">Open Bangkit certificate bundle <ArrowUpRight size={15} /></a></Reveal>
      </div>
    </section>
  );
}
