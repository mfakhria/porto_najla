import { motion, useScroll, useSpring, useTransform } from "framer-motion";
import { useRef } from "react";

type Item = { src: string; alt: string };

const positions = [
  "h-[18vh] w-[58vw] md:h-[28vh] md:w-[30vw]",
  "-translate-y-[22vh] h-[12vh] w-[42vw] md:-translate-y-[31vh] md:translate-x-[5vw] md:h-[28vh] md:w-[34vw]",
  "-translate-x-[28vw] -translate-y-[4vh] h-[26vh] w-[26vw] md:-translate-x-[27vw] md:-translate-y-[8vh] md:h-[42vh] md:w-[20vw]",
  "translate-x-[28vw] h-[14vh] w-[28vw] md:translate-x-[28vw] md:h-[25vh] md:w-[24vw]",
  "translate-y-[20vh] h-[12vh] w-[36vw] md:translate-x-[5vw] md:translate-y-[29vh] md:h-[24vh] md:w-[20vw]",
  "-translate-x-[26vw] translate-y-[18vh] h-[12vh] w-[32vw] md:-translate-x-[24vw] md:translate-y-[29vh] md:h-[24vh] md:w-[28vw]",
  "translate-x-[28vw] translate-y-[16vh] h-[10vh] w-[20vw] md:translate-x-[27vw] md:translate-y-[25vh] md:h-[16vh] md:w-[15vw]",
];

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
    useTransform(smoothProgress, [0, 1], [1, 2.55]),
    useTransform(smoothProgress, [0, 1], [1, 3.2]),
    useTransform(smoothProgress, [0, 1], [1, 3.6]),
    useTransform(smoothProgress, [0, 1], [1, 3.2]),
    useTransform(smoothProgress, [0, 1], [1, 3.6]),
    useTransform(smoothProgress, [0, 1], [1, 4.2]),
    useTransform(smoothProgress, [0, 1], [1, 4.6]),
  ];
  const stageOpacity = useTransform(smoothProgress, [0, 0.76, 0.92, 1], [1, 1, 0.48, 0]);
  const stageY = useTransform(smoothProgress, [0, 0.78, 1], [0, 0, -70]);

  return (
    <div ref={container} className="relative h-[155vh] md:h-[190vh]">
      <div className="sticky top-0 h-dvh overflow-hidden">
        <motion.div style={{ opacity: stageOpacity, y: stageY }} className="absolute inset-0 will-change-transform">
          {items.slice(0, 7).map((item, index) => (
            <motion.div
              key={`${item.src}-${index}`}
              style={{ scale: scales[index] }}
              className="absolute inset-0 flex items-center justify-center will-change-transform"
            >
              <div className={`soft-shadow relative overflow-hidden rounded-[1.15rem] border border-border-subtle bg-bg-elevated md:rounded-[1.5rem] ${positions[index]}`}>
                <img src={item.src} alt={item.alt} className="h-full w-full object-cover" />
              </div>
            </motion.div>
          ))}
        </motion.div>
        <div className="pointer-events-none absolute inset-x-0 bottom-0 h-[24vh] bg-gradient-to-t from-bg-base via-bg-base/55 to-transparent md:h-[30vh]" />
      </div>
    </div>
  );
}
