import { motion, useScroll, useTransform } from "framer-motion";
import { useRef } from "react";

type Item = { src: string; alt: string };

export function ZoomParallax({ items }: { items: Item[] }) {
  const container = useRef<HTMLDivElement>(null);
  const { scrollYProgress } = useScroll({ target: container, offset: ["start start", "end end"] });
  const scales = [
    useTransform(scrollYProgress, [0, 1], [1, 3.8]),
    useTransform(scrollYProgress, [0, 1], [1, 5]),
    useTransform(scrollYProgress, [0, 1], [1, 6]),
    useTransform(scrollYProgress, [0, 1], [1, 5]),
    useTransform(scrollYProgress, [0, 1], [1, 6]),
    useTransform(scrollYProgress, [0, 1], [1, 8]),
    useTransform(scrollYProgress, [0, 1], [1, 9]),
  ];

  const positions = ["", "-translate-y-[31vh] translate-x-[5vw] w-[34vw] h-[28vh]", "-translate-x-[27vw] -translate-y-[8vh] w-[20vw] h-[42vh]", "translate-x-[28vw] w-[24vw] h-[25vh]", "translate-x-[5vw] translate-y-[29vh] w-[20vw] h-[24vh]", "-translate-x-[24vw] translate-y-[29vh] w-[28vw] h-[24vh]", "translate-x-[27vw] translate-y-[25vh] w-[15vw] h-[16vh]"];

  return (
    <>
      <div ref={container} className="relative hidden h-[280vh] md:block">
        <div className="sticky top-0 h-screen overflow-hidden">
          {items.slice(0, 7).map((item, index) => (
            <motion.div key={`${item.src}-${index}`} style={{ scale: scales[index] }} className="absolute inset-0 flex items-center justify-center">
              <div className={`relative h-[28vh] w-[30vw] overflow-hidden rounded-2xl border border-white/10 bg-bg-elevated shadow-2xl ${positions[index]}`}>
                <img src={item.src} alt={item.alt} className="h-full w-full object-cover" />
              </div>
            </motion.div>
          ))}
        </div>
      </div>
      <div className="grid gap-4 px-4 pb-16 md:hidden">
        {items.slice(0, 6).map((item) => <img key={item.src} src={item.src} alt={item.alt} className="aspect-video w-full rounded-2xl border border-border-subtle object-cover" />)}
      </div>
    </>
  );
}
