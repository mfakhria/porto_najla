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
    <section data-theme="projects" id="projects" className="relative bg-bg-base text-fg-primary">
      <div className="container-shell relative z-10 pt-28 text-center md:pt-36">
        <Reveal>
          <p className="section-kicker">Selected work · 01</p>
          <h2 className="display-title mt-5">Systems with<br /><em className="text-accent-primary">real-world weight.</em></h2>
          <p className="mx-auto mt-7 max-w-xl text-fg-muted">From logistics operations to public services and mobile products. Scroll through the work, then open each case study below.</p>
        </Reveal>
      </div>

      <ZoomParallax items={parallaxItems} />

      <div className="container-shell grid gap-5 pb-32 md:grid-cols-2 lg:pb-40">
        {projects.map((project, index) => (
          <Reveal key={project.id} delay={(index % 2) * .08}>
            <article id={`project-${project.id}`} className="project-card group overflow-hidden rounded-[1.5rem] border border-border-subtle bg-bg-elevated">
              <div className="aspect-[16/10] overflow-hidden border-b border-border-subtle">
                <img src={project.image} alt={`${project.title} interface`} loading="lazy" className="project-image h-full w-full object-cover" />
              </div>
              <div className="p-6 md:p-8">
                <div className="flex items-start justify-between gap-5">
                  <div><p className="section-kicker">{project.eyebrow}</p><h3 className="mt-3 font-display text-4xl tracking-tight">{project.title}</h3></div>
                  <span className="font-display text-2xl text-fg-muted/40">0{index + 1}</span>
                </div>
                <p className="mt-5 leading-7 text-fg-muted">{project.summary}</p>
                <div className="mt-5 flex flex-wrap gap-2">{project.tags.map((tag) => <span key={tag} className="rounded-full border border-border-subtle px-3 py-1.5 text-[11px] font-semibold text-fg-muted">{tag}</span>)}</div>
                <details className="mt-6 border-t border-border-subtle pt-5">
                  <summary className="cursor-pointer list-none text-sm font-semibold text-fg-primary marker:hidden">Case study details <span className="float-right text-accent-primary">+</span></summary>
                  <div className="mt-5 grid gap-5 text-sm text-fg-muted">
                    <p><span className="text-fg-primary">{project.role}</span> · {project.period}</p>
                    <ul className="grid gap-2">{project.contributions.map((item) => <li key={item} className="flex gap-2"><span className="text-accent-primary">—</span>{item}</li>)}</ul>
                  </div>
                </details>
                {project.link && <a href={project.link.href} target="_blank" rel="noreferrer" className="mt-6 inline-flex items-center gap-2 text-sm font-bold text-accent-primary hover:underline">{project.link.label} <ArrowUpRight size={15} /></a>}
              </div>
            </article>
          </Reveal>
        ))}
      </div>
    </section>
  );
}
