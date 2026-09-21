import { ArrowUpRight } from "lucide-react";
import { projects } from "@/data/portfolio";
import { Reveal } from "@/components/ui/reveal";
import { ZoomParallax } from "@/components/ui/zoom-parallax";

const parallaxItems = [
  ...projects.map((project) => ({ src: project.image, alt: `${project.title} showcase` })),
  { src: "/images/najla-intro.png", alt: "Najla Putri Afifah" },
];

export function ProjectsSection() {
  return (
    <section data-theme="projects" id="projects" className="relative overflow-hidden bg-bg-base text-fg-primary">
      <div aria-hidden className="absolute -left-32 top-56 size-96 rounded-full bg-accent-secondary/20 blur-3xl" />
      <div aria-hidden className="absolute -right-40 top-[38%] size-[30rem] rounded-full bg-accent-primary/20 blur-3xl" />
      <div className="container-shell relative z-10 pt-28 text-center md:pt-36">
        <Reveal>
          <p className="section-kicker">Selected work · 01</p>
          <h2 className="display-title mt-5">Systems with<br /><em className="text-accent-primary">real-world weight.</em></h2>
          <p className="mx-auto mt-7 max-w-xl text-fg-muted">From logistics operations to public services and mobile products. Scroll through the work, then open each case study below.</p>
        </Reveal>
      </div>

      <ZoomParallax items={parallaxItems} />

      <div className="container-shell relative z-20 grid gap-5 pb-32 md:-mt-[14vh] md:grid-cols-2 lg:pb-40">
        {projects.map((project, index) => (
          <Reveal key={project.id} delay={(index % 2) * .08}>
            <article id={`project-${project.id}`} className="project-card soft-shadow group overflow-hidden rounded-[1.75rem] border border-border-subtle bg-bg-elevated transition duration-500 hover:-translate-y-1 hover:border-border-strong">
              <div className="aspect-[16/10] overflow-hidden border-b border-border-subtle">
                <img src={project.image} alt={`${project.title} interface`} loading="lazy" className="project-image h-full w-full object-cover" />
              </div>
              <div className="p-5 md:p-7">
                <div className="flex items-start justify-between gap-4">
                  <div className="min-w-0">
                    <p className="section-kicker">{project.eyebrow}</p>
                    <h3 className="mt-2.5 font-display text-[1.65rem] leading-[1.15] tracking-tight md:text-[1.9rem]">{project.title}</h3>
                  </div>
                  <span className="shrink-0 font-display text-xl text-fg-muted/35 md:text-2xl">0{index + 1}</span>
                </div>
                <p className="mt-4 text-sm leading-6 text-fg-muted md:text-[0.95rem] md:leading-7">{project.summary}</p>
                <div className="mt-4 flex flex-wrap gap-2">{project.tags.map((tag) => <span key={tag} className="rounded-full border border-border-subtle bg-accent-primary/10 px-3 py-1.5 text-[11px] font-semibold text-fg-muted">{tag}</span>)}</div>
                <details className="mt-5 border-t border-border-subtle pt-4">
                  <summary className="cursor-pointer list-none text-sm font-semibold text-fg-primary marker:hidden">Case study details <span className="float-right text-accent-primary">+</span></summary>
                  <div className="mt-4 grid gap-4 text-sm text-fg-muted">
                    <p><span className="text-fg-primary">{project.role}</span> · {project.period}</p>
                    <ul className="grid gap-2">{project.contributions.map((item) => <li key={item} className="flex gap-2 leading-6"><span className="text-accent-primary">—</span>{item}</li>)}</ul>
                  </div>
                </details>
                {project.link && <a href={project.link.href} target="_blank" rel="noreferrer" className="mt-5 inline-flex items-center gap-2 text-sm font-bold text-accent-primary hover:underline">{project.link.label} <ArrowUpRight size={15} /></a>}
              </div>
            </article>
          </Reveal>
        ))}
      </div>
    </section>
  );
}
