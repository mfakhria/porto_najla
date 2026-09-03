import { AnimatePresence, motion } from "framer-motion";

export function Loader({ visible }: { visible: boolean }) {
  return (
    <AnimatePresence>
      {visible && (
        <motion.div
          data-theme="loader"
          initial={{ opacity: 1 }}
          exit={{ opacity: 0, filter: "blur(12px)" }}
          transition={{ duration: 0.65 }}
          className="fixed inset-0 z-[100] flex items-center justify-center bg-bg-base px-6 text-fg-primary"
        >
          <div className="text-center">
            <motion.p initial={{ opacity: 0 }} animate={{ opacity: 1 }} className="mb-5 text-xs font-semibold uppercase tracking-[.28em] text-accent-primary">
              Portfolio · 2026
            </motion.p>
            <motion.h1
              initial={{ opacity: 0, y: 20, filter: "blur(12px)" }}
              animate={{ opacity: 1, y: 0, filter: "blur(0px)" }}
              transition={{ duration: 0.8 }}
              className="font-display text-6xl tracking-[-.05em] sm:text-8xl"
            >
              Hello, I’m Najla.
            </motion.h1>
            <div className="mx-auto mt-8 h-px w-56 overflow-hidden bg-white/10">
              <motion.div className="h-full bg-accent-primary" initial={{ x: "-100%" }} animate={{ x: 0 }} transition={{ duration: 2.35, ease: "easeInOut" }} />
            </div>
            <motion.p initial={{ opacity: 0 }} animate={{ opacity: 0.65 }} transition={{ delay: .5 }} className="mt-5 text-sm text-fg-muted">
              Building reliable digital systems.
            </motion.p>
          </div>
        </motion.div>
      )}
    </AnimatePresence>
  );
}
