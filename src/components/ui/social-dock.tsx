import { Github, Linkedin, Mail } from "lucide-react";
import { contact } from "@/data/portfolio";

const socials = [
  { label: "Email", href: `mailto:${contact.email}`, icon: Mail },
  { label: "LinkedIn", href: contact.linkedin, icon: Linkedin },
  { label: "GitHub", href: contact.github, icon: Github },
];

export function SocialDock() {
  return (
    <aside data-theme="nav" className="fixed bottom-6 left-1/2 z-50 hidden -translate-x-1/2 items-center gap-1 rounded-2xl border border-border-subtle bg-bg-elevated/80 p-1.5 shadow-2xl shadow-black/40 backdrop-blur-xl md:flex">
      {socials.map(({ label, href, icon: Icon }) => (
        <a key={label} href={href} target={href.startsWith("http") ? "_blank" : undefined} rel="noreferrer" aria-label={label} className="group relative grid size-10 place-items-center rounded-xl text-fg-muted transition hover:bg-accent-primary/10 hover:text-accent-primary">
          <Icon size={18} />
          <span className="pointer-events-none absolute -top-9 rounded-md bg-accent-primary px-2 py-1 text-[10px] font-bold text-accent-on opacity-0 transition group-hover:opacity-100">{label}</span>
        </a>
      ))}
    </aside>
  );
}
