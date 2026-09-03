import { motion, useScroll, useSpring, useTransform } from "framer-motion";
import { useRef } from "react";

type Item = { src: string; alt: string };

export function ZoomParallax({ items }: { items: Item[] }) {
  const container = useRef<HTMLDivElement>(null);
  const { scrollYProgress } = useScroll({ target: container, offset: ["start start", "end end"] });
  const smoothProgress = useSpring(scrollYProgress, {
    stiffness: 72,
    damping: 24,
    mass: 0.28,
    restDelta: 0.001,
  });
  const scales = [
    useTransform(smoothProgress, [0, 1], [1, 3.15]),
    useTransform(smoothProgress, [0, 1], [1, 4]),
    useTransform(smoothProgress, [0, 1], [1, 4.7]),
    useTransform(smoothProgress, [0, 1], [1, 4]),
    useTransform(smoothProgress, [0, 1], [1, 4.7]),
    useTransform(smoothProgress, [0, 1], [1, 5.6]),
    useTransform(smoothProgress, [0, 1], [1, 6.1]),
  ];
  const stageOpacity = useTransform(smoothProgress, [0, 0.76, 0.92, 1], [1, 1, 0.48, 0]);
  const stageY = useTransform(smoothProgress, [0, 0.78, 1], [0, 0, -70]);

  const positions = ["", "-translate-y-[31vh] translate-x-[5vw] w-[34vw] h-[28vh]", "-translate-x-[27vw] -translate-y-[8vh] w-[20vw] h-[42vh]", "translate-x-[28vw] w-[24vw] h-[25vh]", "translate-x-[5vw] translate-y-[29vh] w-[20vw] h-[24vh]", "-translate-x-[24vw] translate-y-[29vh] w-[28vw] h-[24vh]", "translate-x-[27vw] translate-y-[25vh] w-[15vw] h-[16vh]"];

  return (
    <>
      <div ref={container} className="relative hidden h-[190vh] md:block">
        <div className="sticky top-0 h-screen overflow-hidden">
          <motion.div style={{ opacity: stageOpacity, y: stageY }} className="absolute inset-0 will-change-transform">
            {items.slice(0, 7).map((item, index) => (
              <motion.div key={`${item.src}-${index}`} style={{ scale: scales[index] }} className="absolute inset-0 flex items-center justify-center will-change-transform">
                <div className={`soft-shadow relative h-[28vh] w-[30vw] overflow-hidden rounded-[1.5rem] border border-border-subtle bg-bg-elevated ${positions[index]}`}>
                  <img src={item.src} alt={item.alt} className="h-full w-full object-cover" />
                </div>
              </motion.div>
            ))}
          </motion.div>
          <div className="pointer-events-none absolute inset-x-0 bottom-0 h-[30vh] bg-gradient-to-t from-bg-base via-bg-base/55 to-transparent" />
        </div>
      </div>
      <div className="grid gap-4 px-4 pb-16 md:hidden">
        {items.slice(0, 6).map((item) => <img key={item.src} src={item.src} alt={item.alt} className="aspect-video w-full rounded-2xl border border-border-subtle object-cover" />)}
      </div>
    </>
  );
}
