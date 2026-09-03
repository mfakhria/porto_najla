import { AnimatePresence, motion } from "framer-motion";
import { Menu, X } from "lucide-react";
import { useEffect, useState } from "react";
import { cn } from "@/lib/utils";

const links = [
  { label: "Home", href: "#home" },
  { label: "Work", href: "#projects" },
  { label: "Expertise", href: "#expertise" },
  { label: "Experience", href: "#experience" },
  { label: "Credentials", href: "#credentials" },
];

export function NavBar() {
  const [scrolled, setScrolled] = useState(false);
  const [open, setOpen] = useState(false);

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 48);
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  useEffect(() => {
    document.body.style.overflow = open ? "hidden" : "";
    return () => { document.body.style.overflow = ""; };
  }, [open]);

  return (
    <>
      <motion.header
        data-theme="nav"
        initial={{ y: -30, opacity: 0 }}
        animate={{ y: 0, opacity: 1 }}
        transition={{ delay: .25, duration: .65 }}
        className={cn(
          "fixed left-1/2 top-5 z-50 hidden -translate-x-1/2 items-center border border-border-subtle bg-bg-elevated/75 text-fg-primary shadow-2xl shadow-black/30 backdrop-blur-xl transition-all duration-500 md:flex",
          scrolled ? "gap-6 rounded-full px-5 py-2.5" : "gap-9 rounded-[1.35rem] px-7 py-3.5",
        )}
      >
        <a href="#home" className="font-display text-xl tracking-tight">Najla.</a>
        <span className="h-5 w-px bg-border-subtle" />
        <nav className="flex items-center gap-5">
          {links.map((link) => <a key={link.href} href={link.href} className="text-xs font-semibold text-fg-muted transition hover:text-accent-primary">{link.label}</a>)}
        </nav>
      </motion.header>

      <button
        type="button"
        onClick={() => setOpen((value) => !value)}
        className="fixed right-4 top-4 z-[70] grid size-12 place-items-center rounded-full bg-accent-primary text-accent-on shadow-xl md:hidden"
        aria-expanded={open}
        aria-label={open ? "Close navigation" : "Open navigation"}
      >
        {open ? <X size={22} /> : <Menu size={22} />}
      </button>

      <AnimatePresence>
        {open && (
          <motion.div
            data-theme="nav"
            initial={{ opacity: 0, clipPath: "circle(0% at calc(100% - 40px) 40px)" }}
            animate={{ opacity: 1, clipPath: "circle(150% at calc(100% - 40px) 40px)" }}
            exit={{ opacity: 0, clipPath: "circle(0% at calc(100% - 40px) 40px)" }}
            transition={{ duration: .55, ease: [0.22, 1, 0.36, 1] }}
            className="fixed inset-0 z-[60] flex flex-col justify-between bg-bg-base p-6 text-fg-primary md:hidden"
          >
            <a href="#home" onClick={() => setOpen(false)} className="font-display text-3xl">Najla.</a>
            <nav className="flex flex-col gap-3">
              {links.map((link, index) => (
                <motion.a key={link.href} href={link.href} onClick={() => setOpen(false)} initial={{ opacity: 0, y: 18 }} animate={{ opacity: 1, y: 0 }} transition={{ delay: .12 + index * .06 }} className="font-display text-6xl leading-none tracking-tight hover:text-accent-primary">
                  {link.label}
                </motion.a>
              ))}
            </nav>
            <a href="mailto:najlaputriafifah16@gmail.com" className="text-sm text-fg-muted">najlaputriafifah16@gmail.com</a>
          </motion.div>
        )}
      </AnimatePresence>
    </>
  );
}
