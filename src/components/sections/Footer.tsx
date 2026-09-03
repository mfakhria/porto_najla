import { ArrowUpRight, Github, Linkedin, Mail } from "lucide-react";
import { contact } from "@/data/portfolio";

export function Footer() {
  return (
    <footer data-theme="projects" id="contact" className="relative overflow-hidden border-t border-border-subtle bg-bg-base pt-28 pb-8 text-fg-primary md:pt-40">
      <div className="pointer-events-none absolute left-1/3 top-0 h-[420px] w-[60vw] -translate-x-1/2 rounded-full bg-accent-primary/35 blur-[130px]" />
      <div className="pointer-events-none absolute right-0 bottom-0 h-[360px] w-[44vw] rounded-full bg-accent-secondary/35 blur-[120px]" />
      <div className="container-shell relative">
        <p className="section-kicker text-center">Contact · 06</p>
        <h2 className="mx-auto mt-6 max-w-5xl text-center font-display text-[clamp(4rem,10vw,9rem)] leading-[.8] tracking-[-.05em]">Let’s build something<br /><em className="text-accent-primary">that matters.</em></h2>
        <a href={`mailto:${contact.email}`} className="mx-auto mt-12 flex w-fit items-center gap-2 rounded-full bg-accent-primary px-7 py-4 text-sm font-bold text-accent-on transition hover:-translate-y-1">Start a conversation <ArrowUpRight size={17} /></a>

        <div className="mt-28 grid gap-10 border-t border-border-subtle pt-8 md:grid-cols-[1fr_auto] md:items-end">
          <div><a href="#home" className="font-display text-4xl">Najla.</a><p className="mt-3 max-w-sm text-sm leading-6 text-fg-muted">Backend developer connecting dependable engineering with business value.</p></div>
          <div className="flex flex-wrap gap-3">
            <a href={`mailto:${contact.email}`} aria-label="Email" className="grid size-11 place-items-center rounded-full border border-border-subtle text-fg-muted hover:border-accent-primary hover:text-accent-primary"><Mail size={18} /></a>
            <a href={contact.linkedin} target="_blank" rel="noreferrer" aria-label="LinkedIn" className="grid size-11 place-items-center rounded-full border border-border-subtle text-fg-muted hover:border-accent-primary hover:text-accent-primary"><Linkedin size={18} /></a>
            <a href={contact.github} target="_blank" rel="noreferrer" aria-label="GitHub" className="grid size-11 place-items-center rounded-full border border-border-subtle text-fg-muted hover:border-accent-primary hover:text-accent-primary"><Github size={18} /></a>
          </div>
        </div>
        <div className="mt-10 flex flex-col gap-3 border-t border-border-subtle pt-5 text-[11px] uppercase tracking-widest text-fg-muted sm:flex-row sm:justify-between"><span>© {new Date().getFullYear()} Najla Putri Afifah</span><span>Tangerang · Indonesia</span></div>
      </div>
    </footer>
  );
}
