# Portfolio Landing Page — Build Spec

**Stack:** Vite 8 + React 19 + TypeScript + Tailwind CSS **v4** + shadcn-style folder structure
**Vibe:** Dark theme, lime accent (`#e8ff3a`), bold display serif (Instrument Serif), cinematic scroll-driven motion
**Arsitektur:**
- 3-layer token system (primitive `--sem-*` → semantic `--color-*` exposed via Tailwind v4 `@theme` → component classes like `bg-bg-base`)
- `data-theme="..."` attribute per section overrides semantic tokens (loader/hero/projects/skills/testimonials/nav)
- Tailwind v4 dipakai via plugin `@tailwindcss/vite` — **TIDAK ada** `tailwind.config.js` dan **TIDAK ada** `postcss.config.js`. Semua token hidup di `src/index.css` dalam blok `@theme {}` dan selector `[data-theme="..."]`.

Page flow (top → bottom):
1. **Loader** (3 detik, fixed inset-0, fade-out)
2. **NavBar** (fixed, pill yang menyusut saat scroll) + **MobileNav** (fullscreen drawer di <md)
3. **HeroSection** (parallax radial + grid bg + headline serif + CTA)
4. **ProjectsSection** (heading "Featured Work" + ZoomParallax 7 gambar, 300vh scroll-zoom)
5. **ServicesSection** (heading "Our Services" + HoverSlider: 5 service text + image preview yang sync)
6. **SkillsSection** (BarChart 4 skill: React, TypeScript, Node.js, Tailwind CSS — palet 2 warna lime/gray)
7. **TestimonialsSection** (3 card grid, mix `user` + `quote` types)
8. **Footer** (FooterGlow: brand + 3 link column + glow blur yang menyatu ke section atasnya)
9. **SocialDock** (fixed bottom-center, hidden di mobile)

---

## 📋 Table of Contents

1. [Setup Project dari Nol](#1-setup-project-dari-nol)
2. [Struktur Folder](#2-struktur-folder)
3. [Config Files](#3-config-files)
4. [Design Tokens & Theme (`src/index.css`)](#4-design-tokens--theme)
5. [Utility (`src/lib/utils.ts`)](#5-utility)
6. [UI Primitives (`src/components/ui/`)](#6-ui-primitives)
7. [Section Components (`src/components/sections/`)](#7-section-components)
8. [App Root](#8-app-root)
9. [Theme Summary](#9-theme-summary)
10. [Checklist Akhir](#10-checklist-akhir)

---

## 1. Setup Project dari Nol

### 1.1 Create Vite project

```bash
npm create vite@latest landing-page -- --template react-ts
cd landing-page
npm install
```

### 1.2 Install Tailwind v4

```bash
npm install tailwindcss @tailwindcss/vite
```

⚠️ **Tailwind v4** dipasang sebagai Vite plugin — **JANGAN** jalankan `npx tailwindcss init`, jangan buat `tailwind.config.js`, jangan buat `postcss.config.js`. Token & utilities semuanya di-declare via blok `@theme {}` dalam `src/index.css`.

### 1.3 Install runtime dependencies

```bash
npm install framer-motion clsx tailwind-merge lucide-react \
  @radix-ui/react-slot @radix-ui/react-avatar \
  class-variance-authority @number-flow/react
```

### 1.4 Install dev dependencies

```bash
npm install -D @types/node
```

### 1.5 Final `package.json` (versi yang dipakai)

```json
{
  "name": "landing-page",
  "private": true,
  "version": "0.0.0",
  "type": "module",
  "scripts": {
    "dev": "vite",
    "build": "tsc -b && vite build",
    "lint": "eslint .",
    "preview": "vite preview"
  },
  "dependencies": {
    "@number-flow/react": "^0.6.0",
    "@radix-ui/react-avatar": "^1.1.11",
    "@radix-ui/react-slot": "^1.2.4",
    "@tailwindcss/vite": "^4.2.4",
    "class-variance-authority": "^0.7.1",
    "clsx": "^2.1.1",
    "framer-motion": "^12.38.0",
    "lucide-react": "^1.9.0",
    "react": "^19.2.5",
    "react-dom": "^19.2.5",
    "tailwind-merge": "^3.5.0",
    "tailwindcss": "^4.2.4"
  },
  "devDependencies": {
    "@eslint/js": "^9.39.4",
    "@types/node": "^24.12.2",
    "@types/react": "^19.2.14",
    "@types/react-dom": "^19.2.3",
    "@vitejs/plugin-react": "^6.0.1",
    "eslint": "^9.39.4",
    "eslint-plugin-react-hooks": "^7.1.1",
    "eslint-plugin-react-refresh": "^0.5.2",
    "globals": "^17.5.0",
    "typescript": "~6.0.2",
    "typescript-eslint": "^8.58.2",
    "vite": "^8.0.9"
  }
}
```

### 1.6 Kenapa folder `src/components/ui/`?

Konvensi shadcn: `ui/` = primitive/reusable (Button, Card, Avatar, dll) tanpa business logic. `sections/` = komposisi section halaman (Hero, Projects, dst). Pembagian ini menghindari circular dep dan membuat `data-theme` override per section bekerja konsisten.

---

## 2. Struktur Folder

```
landing-page/
├── index.html
├── package.json
├── tsconfig.json
├── tsconfig.app.json
├── tsconfig.node.json
├── vite.config.ts
├── eslint.config.js
└── src/
    ├── main.tsx
    ├── App.tsx
    ├── index.css                  ← satu-satunya file styling (Tailwind v4 + tokens + themes)
    ├── lib/
    │   └── utils.ts               ← `cn()` helper (clsx + twMerge)
    ├── components/
    │   ├── ui/                    ← primitives + composed atoms
    │   │   ├── animated-slideshow.tsx
    │   │   ├── avatar.tsx
    │   │   ├── blur-fade.tsx
    │   │   ├── button.tsx
    │   │   ├── card.tsx
    │   │   ├── footer-glow.tsx
    │   │   ├── hero-1.tsx
    │   │   ├── menu-toggle-icon.tsx
    │   │   ├── mobile-nav.tsx
    │   │   ├── nav-bar.tsx
    │   │   ├── skills-chart.tsx
    │   │   ├── social-dock.tsx
    │   │   ├── social-icons.tsx
    │   │   ├── testimonial.tsx
    │   │   └── zoom-parallax.tsx
    │   └── sections/              ← page composition
    │       ├── Footer.tsx
    │       ├── HeroSection.tsx
    │       ├── Loader.tsx
    │       ├── ProjectsSection.tsx
    │       ├── ServicesSection.tsx
    │       ├── SkillsSection.tsx
    │       └── TestimonialsSection.tsx
    └── assets/                    ← (kosong / opsional)
```

---

## 3. Config Files

### 3.1 `index.html`

```html
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>landing-page</title>
  </head>
  <body>
    <div id="root"></div>
    <script type="module" src="/src/main.tsx"></script>
  </body>
</html>
```

### 3.2 `vite.config.ts`

```ts
import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";
import tailwindcss from "@tailwindcss/vite";
import path from "path";

export default defineConfig({
  plugins: [react(), tailwindcss()],
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "./src"),
    },
  },
});
```

### 3.3 `tsconfig.json`

```json
{
  "files": [],
  "references": [
    { "path": "./tsconfig.app.json" },
    { "path": "./tsconfig.node.json" }
  ]
}
```

### 3.4 `tsconfig.app.json`

```json
{
  "compilerOptions": {
    "tsBuildInfoFile": "./node_modules/.tmp/tsconfig.app.tsbuildinfo",
    "target": "es2023",
    "lib": ["ES2023", "DOM"],
    "module": "esnext",
    "types": ["vite/client"],
    "skipLibCheck": true,

    /* Bundler mode */
    "moduleResolution": "bundler",
    "allowImportingTsExtensions": true,
    "verbatimModuleSyntax": true,
    "moduleDetection": "force",
    "noEmit": true,
    "jsx": "react-jsx",

    "paths": {
      "@/*": ["./src/*"]
    },

    /* Linting */
    "noUnusedLocals": true,
    "noUnusedParameters": true,
    "erasableSyntaxOnly": true,
    "noFallthroughCasesInSwitch": true
  },
  "include": ["src"]
}
```

### 3.5 `tsconfig.node.json`

```json
{
  "compilerOptions": {
    "tsBuildInfoFile": "./node_modules/.tmp/tsconfig.node.tsbuildinfo",
    "target": "es2023",
    "lib": ["ES2023"],
    "module": "esnext",
    "types": ["node"],
    "skipLibCheck": true,

    /* Bundler mode */
    "moduleResolution": "bundler",
    "allowImportingTsExtensions": true,
    "verbatimModuleSyntax": true,
    "moduleDetection": "force",
    "noEmit": true,

    /* Linting */
    "noUnusedLocals": true,
    "noUnusedParameters": true,
    "erasableSyntaxOnly": true,
    "noFallthroughCasesInSwitch": true
  },
  "include": ["vite.config.ts"]
}
```

### 3.6 `src/main.tsx`

```tsx
import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import App from './App.tsx'

createRoot(document.getElementById('root')!).render(
  <StrictMode>
    <App />
  </StrictMode>,
)
```

---

## 4. Design Tokens & Theme

**File: `src/index.css`** — satu-satunya file styling. Berisi: import Tailwind v4, font import, blok `@theme {}` (Tailwind v4 token declaration), semantic primitives `--sem-*`, lalu override per `data-theme`.

```css
@import url("https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600;700&display=swap");
@import "tailwindcss";

@theme {
  --font-display: "Instrument Serif", serif;
  --font-body: "Inter", sans-serif;

  --radius-sm: 0.25rem;
  --radius-md: 0.75rem;
  --radius-lg: 1.5rem;

  --spacing-15: 3.75rem;
  --spacing-112: 28rem;

  --color-bg-base: var(--sem-bg-base);
  --color-bg-elevated: var(--sem-bg-elevated);
  --color-bg-contrast: var(--sem-bg-contrast);
  --color-fg-primary: var(--sem-fg-primary);
  --color-fg-muted: var(--sem-fg-muted);
  --color-fg-inverted: var(--sem-fg-inverted);
  --color-accent-primary: var(--sem-accent-primary);
  --color-accent-on: var(--sem-accent-on);
  --color-border-subtle: var(--sem-border-subtle);
  --color-border-strong: var(--sem-border-strong);

  --animate-fade-in: fade-in 1s ease-out forwards;
  --animate-fade-up: fade-up 1s ease-out forwards;
  --animate-wave: wave 2s infinite;

  @keyframes fade-in {
    0% {
      opacity: 0;
      transform: translateY(20px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes fade-up {
    0% {
      opacity: 0;
      transform: translateY(40px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes wave {
    0% { transform: rotate(0deg); }
    10% { transform: rotate(14deg); }
    20% { transform: rotate(-8deg); }
    30% { transform: rotate(14deg); }
    40% { transform: rotate(-4deg); }
    50% { transform: rotate(10deg); }
    60% { transform: rotate(0deg); }
    100% { transform: rotate(0deg); }
  }
}

/* ============================== */
/* SEMANTIC TOKENS — per data-theme override */
/* ============================== */

:root {
  --sem-bg-base: #0a0a0a;
  --sem-bg-elevated: #1a1a1a;
  --sem-bg-contrast: #fafaf7;
  --sem-fg-primary: #fafaf7;
  --sem-fg-muted: #a3a3a3;
  --sem-fg-inverted: #0a0a0a;
  --sem-accent-primary: #e8ff3a;
  --sem-accent-on: #0a0a0a;
  --sem-border-subtle: rgba(255, 255, 255, 0.1);
  --sem-border-strong: #fafaf7;
  --candy-bg-color: #1a1a1a;
}

.light {
  --sem-bg-base: #fafaf7;
  --sem-bg-elevated: #ffffff;
  --sem-bg-contrast: #0a0a0a;
  --sem-fg-primary: #0a0a0a;
  --sem-fg-muted: #525252;
  --sem-fg-inverted: #fafaf7;
  --sem-accent-primary: #e8ff3a;
  --sem-accent-on: #0a0a0a;
  --sem-border-subtle: #e5e5e5;
  --sem-border-strong: #0a0a0a;
  --candy-bg-color: #f5f5f5;
}

[data-theme="loader"] {
  --sem-bg-base: #0a0a0a;
  --sem-bg-elevated: #1a1a1a;
  --sem-fg-primary: #fafaf7;
  --sem-fg-muted: #a3a3a3;
  --sem-accent-primary: #e8ff3a;
  --sem-accent-on: #0a0a0a;
  --sem-border-subtle: rgba(255, 255, 255, 0.1);
}

[data-theme="hero"] {
  --sem-bg-base: #0a0a0a;
  --sem-bg-elevated: #1a1a1a;
  --sem-fg-primary: #fafaf7;
  --sem-fg-muted: #a3a3a3;
  --sem-accent-primary: #e8ff3a;
  --sem-accent-on: #0a0a0a;
  --sem-border-subtle: rgba(255, 255, 255, 0.1);
}

[data-theme="projects"] {
  --sem-bg-base: #0a0a0a;
  --sem-bg-elevated: #1a1a1a;
  --sem-fg-primary: #fafaf7;
  --sem-fg-muted: #a3a3a3;
  --sem-accent-primary: #e8ff3a;
  --sem-accent-on: #0a0a0a;
  --sem-border-subtle: rgba(255, 255, 255, 0.1);
}

[data-theme="skills"] {
  --sem-bg-base: #0a0a0a;
  --sem-bg-elevated: #1a1a1a;
  --sem-fg-primary: #fafaf7;
  --sem-fg-muted: #a3a3a3;
  --sem-accent-primary: #e8ff3a;
  --sem-accent-on: #0a0a0a;
  --sem-border-subtle: rgba(255, 255, 255, 0.1);
  --candy-bg-color: #1a1a1a;
}

[data-theme="testimonials"] {
  --sem-bg-base: #111111;
  --sem-bg-elevated: #1f1f1f;
  --sem-fg-primary: #fafaf7;
  --sem-fg-muted: #a3a3a3;
  --sem-accent-primary: #e8ff3a;
  --sem-accent-on: #0a0a0a;
  --sem-border-subtle: rgba(255, 255, 255, 0.1);
}

[data-theme="nav"] {
  --sem-bg-base: #0a0a0a;
  --sem-bg-elevated: #1a1a1a;
  --sem-fg-primary: #fafaf7;
  --sem-fg-muted: #a3a3a3;
  --sem-accent-primary: #e8ff3a;
  --sem-accent-on: #0a0a0a;
  --sem-border-subtle: rgba(255, 255, 255, 0.1);
}

/* ============================== */
/* BASE                            */
/* ============================== */

html {
  scroll-behavior: smooth;
}

html,
body,
#root {
  height: 100%;
}

body {
  font-family: "Inter", sans-serif;
  background: var(--sem-bg-base);
  color: var(--sem-fg-primary);
  -webkit-font-smoothing: antialiased;
  margin: 0;
}
```

**Cara baca:**
- Class Tailwind seperti `bg-bg-base`, `text-fg-primary`, `bg-accent-primary`, `border-border-subtle` otomatis di-generate dari `--color-*` di blok `@theme`. Tidak perlu config JS.
- `font-display` (Instrument Serif) dipakai untuk semua heading. `font-body` default body.
- `--candy-bg-color` adalah token khusus dipakai oleh `.candy-bg` pattern di SkillsChart (linear-gradient diagonal stripe).

---

## 5. Utility

**File: `src/lib/utils.ts`**

```ts
import { clsx, type ClassValue } from "clsx";
import { twMerge } from "tailwind-merge";

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs));
}
```

---

## 6. UI Primitives

### 6.1 `src/components/ui/button.tsx`

```tsx
import * as React from "react";
import { Slot } from "@radix-ui/react-slot";
import { cva, type VariantProps } from "class-variance-authority";
import { cn } from "@/lib/utils";

const buttonVariants = cva(
  "inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50",
  {
    variants: {
      variant: {
        default: "bg-accent-primary text-accent-on hover:bg-accent-primary/90",
        destructive: "bg-destructive text-destructive-foreground hover:bg-destructive/90",
        outline: "border border-input bg-background hover:bg-accent hover:text-accent-foreground",
        secondary: "bg-secondary text-secondary-foreground hover:bg-secondary/80",
        ghost: "hover:bg-accent hover:text-accent-foreground",
        link: "text-primary underline-offset-4 hover:underline",
      },
      size: {
        default: "h-10 px-4 py-2",
        sm: "h-9 rounded-md px-3",
        lg: "h-11 rounded-md px-8",
        icon: "h-10 w-10",
      },
    },
    defaultVariants: {
      variant: "default",
      size: "default",
    },
  }
);

export interface ButtonProps
  extends React.ButtonHTMLAttributes<HTMLButtonElement>,
    VariantProps<typeof buttonVariants> {
  asChild?: boolean;
}

const Button = React.forwardRef<HTMLButtonElement, ButtonProps>(
  ({ className, variant, size, asChild = false, ...props }, ref) => {
    const Comp = asChild ? Slot : "button";
    return (
      <Comp
        className={cn(buttonVariants({ variant, size, className }))}
        ref={ref}
        {...props}
      />
    );
  }
);
Button.displayName = "Button";

export { Button, buttonVariants };
```

### 6.2 `src/components/ui/avatar.tsx`

```tsx
import * as React from "react";
import * as AvatarPrimitive from "@radix-ui/react-avatar";
import { cn } from "@/lib/utils";

const Avatar = React.forwardRef<
  React.ElementRef<typeof AvatarPrimitive.Root>,
  React.ComponentPropsWithoutRef<typeof AvatarPrimitive.Root>
>(({ className, ...props }, ref) => (
  <AvatarPrimitive.Root
    ref={ref}
    className={cn(
      "relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full",
      className
    )}
    {...props}
  />
));
Avatar.displayName = AvatarPrimitive.Root.displayName;

const AvatarImage = React.forwardRef<
  React.ElementRef<typeof AvatarPrimitive.Image>,
  React.ComponentPropsWithoutRef<typeof AvatarPrimitive.Image>
>(({ className, ...props }, ref) => (
  <AvatarPrimitive.Image
    ref={ref}
    className={cn("aspect-square h-full w-full", className)}
    {...props}
  />
));
AvatarImage.displayName = AvatarPrimitive.Image.displayName;

const AvatarFallback = React.forwardRef<
  React.ElementRef<typeof AvatarPrimitive.Fallback>,
  React.ComponentPropsWithoutRef<typeof AvatarPrimitive.Fallback>
>(({ className, ...props }, ref) => (
  <AvatarPrimitive.Fallback
    ref={ref}
    className={cn(
      "flex h-full w-full items-center justify-center rounded-full bg-muted",
      className
    )}
    {...props}
  />
));
AvatarFallback.displayName = AvatarPrimitive.Fallback.displayName;

export { Avatar, AvatarImage, AvatarFallback };
```

### 6.3 `src/components/ui/card.tsx`

```tsx
import * as React from "react";
import { cn } from "@/lib/utils";

const Card = React.forwardRef<HTMLDivElement, React.HTMLAttributes<HTMLDivElement>>(
  ({ className, ...props }, ref) => (
    <div
      ref={ref}
      className={cn("rounded-lg border bg-card text-card-foreground shadow-sm", className)}
      {...props}
    />
  )
);
Card.displayName = "Card";

const CardHeader = React.forwardRef<HTMLDivElement, React.HTMLAttributes<HTMLDivElement>>(
  ({ className, ...props }, ref) => (
    <div ref={ref} className={cn("flex flex-col space-y-1.5 p-6", className)} {...props} />
  )
);
CardHeader.displayName = "CardHeader";

const CardTitle = React.forwardRef<HTMLParagraphElement, React.HTMLAttributes<HTMLHeadingElement>>(
  ({ className, ...props }, ref) => (
    <h3
      ref={ref}
      className={cn("text-2xl font-semibold leading-none tracking-tight", className)}
      {...props}
    />
  )
);
CardTitle.displayName = "CardTitle";

const CardDescription = React.forwardRef<
  HTMLParagraphElement,
  React.HTMLAttributes<HTMLParagraphElement>
>(({ className, ...props }, ref) => (
  <p ref={ref} className={cn("text-sm text-muted-foreground", className)} {...props} />
));
CardDescription.displayName = "CardDescription";

const CardContent = React.forwardRef<HTMLDivElement, React.HTMLAttributes<HTMLDivElement>>(
  ({ className, ...props }, ref) => (
    <div ref={ref} className={cn("p-6 pt-0", className)} {...props} />
  )
);
CardContent.displayName = "CardContent";

const CardFooter = React.forwardRef<HTMLDivElement, React.HTMLAttributes<HTMLDivElement>>(
  ({ className, ...props }, ref) => (
    <div ref={ref} className={cn("flex items-center p-6 pt-0", className)} {...props} />
  )
);
CardFooter.displayName = "CardFooter";

export { Card, CardHeader, CardFooter, CardTitle, CardDescription, CardContent };
```

### 6.4 `src/components/ui/blur-fade.tsx`

```tsx
import { useRef } from "react";
import {
  AnimatePresence,
  motion,
  useInView,
  type UseInViewOptions,
  type Variants,
} from "framer-motion";

type MarginType = UseInViewOptions["margin"];

interface BlurFadeProps {
  children: React.ReactNode;
  className?: string;
  variant?: {
    hidden: { y: number };
    visible: { y: number };
  };
  duration?: number;
  delay?: number;
  yOffset?: number;
  inView?: boolean;
  inViewMargin?: MarginType;
  blur?: string;
}

export function BlurFade({
  children,
  className,
  variant,
  duration = 0.4,
  delay = 0,
  yOffset = 6,
  inView = false,
  inViewMargin = "-50px",
  blur = "6px",
}: BlurFadeProps) {
  const ref = useRef(null);
  const inViewResult = useInView(ref, { margin: inViewMargin });
  const isInView = !inView || inViewResult;

  const defaultVariants: Variants = {
    hidden: { y: yOffset, opacity: 0, filter: `blur(${blur})` },
    visible: { y: -yOffset, opacity: 1, filter: `blur(0px)` },
  };

  const combinedVariants = variant || defaultVariants;

  return (
    <AnimatePresence>
      <motion.div
        ref={ref}
        initial="hidden"
        animate={isInView ? "visible" : "hidden"}
        exit="hidden"
        variants={combinedVariants}
        transition={{
          delay: 0.04 + delay,
          duration,
          ease: "easeOut",
        }}
        className={className}
      >
        {children}
      </motion.div>
    </AnimatePresence>
  );
}
```

### 6.5 `src/components/ui/menu-toggle-icon.tsx`

```tsx
import React from "react";
import { cn } from "@/lib/utils";

type MenuToggleProps = React.ComponentProps<"svg"> & {
  open: boolean;
  duration?: number;
};

export function MenuToggleIcon({
  open,
  className,
  fill = "none",
  stroke = "currentColor",
  strokeWidth = 2.5,
  strokeLinecap = "round",
  strokeLinejoin = "round",
  duration = 500,
  ...props
}: MenuToggleProps) {
  return (
    <svg
      strokeWidth={strokeWidth}
      fill={fill}
      stroke={stroke}
      viewBox="0 0 32 32"
      strokeLinecap={strokeLinecap}
      strokeLinejoin={strokeLinejoin}
      className={cn(
        "transition-transform ease-in-out",
        open && "-rotate-45",
        className
      )}
      style={{ transitionDuration: `${duration}ms` }}
      {...props}
    >
      <path
        className={cn(
          "transition-all ease-in-out",
          open
            ? "[stroke-dasharray:20_300] [stroke-dashoffset:-32.42px]"
            : "[stroke-dasharray:12_63]"
        )}
        style={{ transitionDuration: `${duration}ms` }}
        d="M27 10 13 10C10.8 10 9 8.2 9 6 9 3.5 10.8 2 13 2 15.2 2 17 3.8 17 6L17 26C17 28.2 18.8 30 21 30 23.2 30 25 28.2 25 26 25 23.8 23.2 22 21 22L7 22"
      />
      <path d="M7 16 27 16" />
    </svg>
  );
}
```

### 6.6 `src/components/ui/social-icons.tsx`

```tsx
import { useState, type ReactNode } from "react";
import { cn } from "@/lib/utils";

export interface SocialItem {
  name: string;
  href: string;
  icon: ReactNode;
}

interface SocialIconsProps {
  items?: SocialItem[];
  tooltipPosition?: "top" | "bottom";
  className?: string;
}

const defaultSocials: SocialItem[] = [
  {
    name: "GitHub",
    href: "https://github.com",
    icon: (
      <svg viewBox="0 0 24 24" fill="currentColor" className="size-[18px]">
        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
      </svg>
    ),
  },
  {
    name: "X",
    href: "https://x.com",
    icon: (
      <svg viewBox="0 0 24 24" fill="currentColor" className="size-[18px]">
        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
      </svg>
    ),
  },
  {
    name: "LinkedIn",
    href: "https://linkedin.com",
    icon: (
      <svg viewBox="0 0 24 24" fill="currentColor" className="size-[18px]">
        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
      </svg>
    ),
  },
  {
    name: "Dribbble",
    href: "https://dribbble.com",
    icon: (
      <svg viewBox="0 0 24 24" fill="currentColor" className="size-[18px]">
        <path d="M12 24C5.385 24 0 18.615 0 12S5.385 0 12 0s12 5.385 12 12-5.385 12-12 12zm10.12-10.358c-.35-.11-3.17-.953-6.384-.438 1.34 3.684 1.887 6.684 1.992 7.308 2.3-1.555 3.936-4.02 4.395-6.87zm-6.115 7.808c-.153-.9-.75-4.032-2.19-7.77l-.066.02c-5.79 2.015-7.86 6.025-8.04 6.4 1.73 1.358 3.92 2.166 6.29 2.166 1.42 0 2.77-.29 4-.814zm-11.62-2.58c.232-.4 3.045-5.055 8.332-6.765.135-.045.27-.084.405-.12-.26-.585-.54-1.167-.832-1.74C7.17 11.775 2.206 11.71 1.756 11.7l-.004.312c0 2.633.998 5.037 2.634 6.855zm-2.42-8.955c.46.008 4.683.026 9.477-1.248-1.698-3.018-3.53-5.558-3.8-5.928-2.868 1.35-5.01 3.99-5.676 7.17zM9.6 2.052c.282.38 2.145 2.914 3.822 6 3.645-1.365 5.19-3.44 5.373-3.702-1.81-1.61-4.19-2.586-6.795-2.586-.825 0-1.63.1-2.4.285zm10.335 3.483c-.218.29-1.935 2.493-5.724 4.04.24.49.47.985.68 1.486.08.18.15.36.22.53 3.41-.43 6.8.26 7.14.33-.02-2.42-.88-4.64-2.31-6.38z" />
      </svg>
    ),
  },
];

export function SocialIcons({
  items = defaultSocials,
  tooltipPosition = "top",
  className,
}: SocialIconsProps) {
  const [hoveredIndex, setHoveredIndex] = useState<number | null>(null);

  return (
    <div
      className={cn(
        "relative flex items-center gap-0.5 px-1.5 py-1.5 rounded-2xl bg-bg-elevated/70 backdrop-blur-xl border border-border-subtle shadow-[0_8px_32px_rgba(0,0,0,0.4)]",
        className
      )}
    >
      <div className="absolute inset-0 rounded-2xl bg-gradient-to-b from-white/4 to-transparent pointer-events-none" />

      {items.map((social, index) => (
        <a
          key={social.name}
          href={social.href}
          target="_blank"
          rel="noopener noreferrer"
          className="group relative flex items-center justify-center size-10 rounded-xl transition-colors duration-200"
          onMouseEnter={() => setHoveredIndex(index)}
          onMouseLeave={() => setHoveredIndex(null)}
          aria-label={social.name}
        >
          <span
            className={cn(
              "absolute inset-1 rounded-lg bg-accent-primary/15 ring-1 ring-accent-primary/30 transition-all duration-300 ease-out",
              hoveredIndex === index ? "opacity-100 scale-100" : "opacity-0 scale-90"
            )}
          />

          <span
            className={cn(
              "relative z-10 transition-all duration-300 ease-out",
              hoveredIndex === index
                ? "text-accent-primary scale-110"
                : "text-fg-muted"
            )}
          >
            {social.icon}
          </span>

          <span
            className={cn(
              "absolute bottom-1.5 left-1/2 -translate-x-1/2 h-[2px] rounded-full bg-accent-primary transition-all duration-300 ease-out",
              hoveredIndex === index ? "w-3 opacity-100" : "w-0 opacity-0"
            )}
          />

          <span
            className={cn(
              "absolute left-1/2 -translate-x-1/2 px-2.5 py-1 rounded-lg bg-accent-primary text-accent-on text-[11px] font-semibold whitespace-nowrap transition-all duration-300 ease-out",
              tooltipPosition === "top" ? "-top-10" : "-bottom-10",
              hoveredIndex === index
                ? "opacity-100 translate-y-0"
                : tooltipPosition === "top"
                ? "opacity-0 translate-y-1 pointer-events-none"
                : "opacity-0 -translate-y-1 pointer-events-none"
            )}
          >
            {social.name}
            <span
              className={cn(
                "absolute left-1/2 -translate-x-1/2 size-2 rotate-45 bg-accent-primary",
                tooltipPosition === "top" ? "-bottom-1" : "-top-1"
              )}
            />
          </span>
        </a>
      ))}
    </div>
  );
}
```

### 6.7 `src/components/ui/social-dock.tsx`

```tsx
import { SocialIcons } from "@/components/ui/social-icons";

export function SocialDock() {
  return (
    <div
      data-theme="nav"
      className="hidden md:block fixed bottom-6 left-1/2 -translate-x-1/2 z-40"
    >
      <SocialIcons tooltipPosition="top" />
    </div>
  );
}
```

### 6.8 `src/components/ui/mobile-nav.tsx`

```tsx
import { useEffect, useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { MenuToggleIcon } from "@/components/ui/menu-toggle-icon";
import { SocialIcons } from "@/components/ui/social-icons";

interface NavLink {
  label: string;
  href: string;
}

interface MobileNavProps {
  links: NavLink[];
  brand?: string;
}

export function MobileNav({ links, brand = "Portfolio" }: MobileNavProps) {
  const [open, setOpen] = useState(false);

  useEffect(() => {
    document.body.style.overflow = open ? "hidden" : "";
    return () => {
      document.body.style.overflow = "";
    };
  }, [open]);

  const handleLinkClick = () => setOpen(false);

  return (
    <>
      <button
        onClick={() => setOpen(!open)}
        className="md:hidden fixed top-4 right-4 z-[60] size-12 flex items-center justify-center rounded-full bg-bg-contrast text-fg-inverted shadow-lg"
        aria-label={open ? "Close menu" : "Open menu"}
        aria-expanded={open}
      >
        <MenuToggleIcon open={open} className="size-7" duration={400} />
      </button>

      <AnimatePresence>
        {open && (
          <motion.div
            data-theme="nav"
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            transition={{ duration: 0.3 }}
            className="md:hidden fixed inset-0 z-50 bg-bg-base text-fg-primary flex flex-col items-center justify-center gap-8 px-6"
          >
            <div className="absolute top-4 left-4 font-display text-2xl tracking-tight">
              {brand}
            </div>

            <nav className="flex flex-col items-center gap-6">
              {links.map((link, i) => (
                <motion.a
                  key={link.href}
                  href={link.href}
                  onClick={handleLinkClick}
                  initial={{ opacity: 0, y: -20 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ delay: 0.1 + i * 0.08 }}
                  className="font-display text-5xl tracking-tighter hover:text-accent-primary transition-colors"
                >
                  {link.label}
                </motion.a>
              ))}
            </nav>

            <motion.div
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: 0.4 }}
              className="mt-8"
            >
              <SocialIcons tooltipPosition="top" />
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>
    </>
  );
}
```

### 6.9 `src/components/ui/nav-bar.tsx`

```tsx
import { useEffect, useState } from "react";
import { motion } from "framer-motion";
import { cn } from "@/lib/utils";
import { MobileNav } from "@/components/ui/mobile-nav";

const links = [
  { label: "Home", href: "#hero" },
  { label: "Projects", href: "#projects" },
  { label: "Skills", href: "#skills" },
  { label: "Testimonials", href: "#testimonials" },
];

export function NavBar({ brand = "Portfolio" }: { brand?: string }) {
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 40);
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  return (
    <>
      <motion.header
        data-theme="nav"
        initial={{ y: -40, opacity: 0 }}
        animate={{ y: 0, opacity: 1 }}
        transition={{ duration: 0.6, ease: "easeOut", delay: 0.2 }}
        className={cn(
          "hidden md:flex fixed left-1/2 -translate-x-1/2 z-50 items-center gap-8",
          "bg-bg-elevated/70 backdrop-blur-xl border border-border-subtle",
          "shadow-[0_8px_32px_rgba(0,0,0,0.4)]",
          "transition-all duration-500 ease-out",
          scrolled
            ? "top-4 rounded-full px-5 py-2.5"
            : "top-6 rounded-full px-7 py-3"
        )}
      >
        <a
          href="#hero"
          className="font-display text-xl tracking-tight text-fg-primary"
        >
          {brand}
        </a>

        <span className="h-5 w-px bg-border-subtle" aria-hidden />

        <nav className="flex items-center gap-6">
          {links.map((link) => (
            <a
              key={link.href}
              href={link.href}
              className="text-sm font-medium text-fg-muted hover:text-accent-primary transition-colors"
            >
              {link.label}
            </a>
          ))}
        </nav>
      </motion.header>

      <MobileNav links={links} brand={brand} />
    </>
  );
}
```

### 6.10 `src/components/ui/hero-1.tsx`

```tsx
import { useRef } from "react";
import { motion, useScroll, useTransform } from "framer-motion";
import { ChevronRight } from "lucide-react";
import { Button } from "@/components/ui/button";

interface HeroProps {
  eyebrow?: string;
  title: string;
  subtitle: string;
  ctaLabel?: string;
  ctaHref?: string;
}

export function Hero({
  eyebrow = "Innovate Without Limits",
  title,
  subtitle,
  ctaLabel = "Explore Now",
  ctaHref = "#",
}: HeroProps) {
  const ref = useRef<HTMLElement>(null);
  const { scrollYProgress } = useScroll({
    target: ref,
    offset: ["start start", "end start"],
  });

  const radialY = useTransform(scrollYProgress, [0, 1], ["0%", "-30%"]);
  const radialScale = useTransform(scrollYProgress, [0, 1], [1, 1.25]);
  const contentY = useTransform(scrollYProgress, [0, 1], ["0%", "20%"]);
  const contentOpacity = useTransform(scrollYProgress, [0, 0.8], [1, 0]);

  return (
    <section
      ref={ref}
      id="hero"
      className="relative mx-auto w-full pt-40 pb-40 px-6 text-center md:px-8
      min-h-dvh overflow-hidden bg-bg-base"
    >
      {/* Grid BG */}
      <div
        className="absolute -z-10 inset-0 opacity-80 h-[600px] w-full
        bg-[size:6rem_5rem]
        [mask-image:radial-gradient(ellipse_80%_50%_at_50%_0%,#000_70%,transparent_110%)]"
        style={{
          backgroundImage:
            "linear-gradient(to right, var(--color-border-subtle) 1px, transparent 1px), linear-gradient(to bottom, var(--color-border-subtle) 1px, transparent 1px)",
        }}
      />

      {/* Radial Accent — parallax pulled up on scroll */}
      <motion.div
        id="hero-radial"
        aria-hidden
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        transition={{ duration: 1, ease: "easeOut" }}
        style={{
          y: radialY,
          scale: radialScale,
          background:
            "radial-gradient(closest-side, var(--color-bg-base) 82%, var(--color-accent-primary))",
        }}
        className="absolute left-1/2 top-[calc(100%-90px)] lg:top-[calc(100%-150px)]
        h-[500px] w-[700px] md:h-[500px] md:w-[1100px] lg:h-[750px] lg:w-[140%]
        -translate-x-1/2 rounded-[100%] pointer-events-none"
      />

      {/* Content — parallax fade & drift as user scrolls */}
      <motion.div
        style={{ y: contentY, opacity: contentOpacity }}
        className="relative z-10"
      >
        {/* Eyebrow */}
        {eyebrow && (
          <motion.a
            href="#"
            className="group"
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6, ease: "easeOut" }}
          >
            <span
              className="text-sm text-fg-muted font-body mx-auto px-5 py-2
              bg-linear-to-tr from-zinc-300/5 via-gray-400/5 to-transparent
              border-2 border-border-subtle
              rounded-3xl w-fit tracking-tight uppercase flex items-center justify-center"
            >
              {eyebrow}
              <ChevronRight className="inline w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" />
            </span>
          </motion.a>
        )}

        {/* Title */}
        <motion.h1
          initial={{ opacity: 0, y: 30, filter: "blur(8px)" }}
          animate={{ opacity: 1, y: 0, filter: "blur(0px)" }}
          transition={{ duration: 0.9, ease: "easeOut", delay: 0.15 }}
          className="text-balance bg-clip-text py-6 text-5xl font-display
          leading-none tracking-tighter text-transparent
          sm:text-6xl md:text-7xl lg:text-8xl"
          style={{
            backgroundImage:
              "linear-gradient(to bottom right, var(--color-fg-primary) 30%, rgba(255,255,255,0.4))",
          }}
        >
          {title}
        </motion.h1>

        {/* Subtitle */}
        <motion.p
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.7, ease: "easeOut", delay: 0.35 }}
          className="mb-12 text-balance text-lg tracking-tight text-fg-muted md:text-xl"
        >
          {subtitle}
        </motion.p>

        {/* CTA */}
        {ctaLabel && (
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6, ease: "easeOut", delay: 0.5 }}
            className="flex justify-center"
          >
            <Button
              asChild
              className="mt-[-20px] w-fit md:w-52 z-20 tracking-tighter text-center text-lg h-12 px-6"
            >
              <a href={ctaHref}>{ctaLabel}</a>
            </Button>
          </motion.div>
        )}
      </motion.div>
    </section>
  );
}
```

### 6.11 `src/components/ui/zoom-parallax.tsx`

```tsx
import { useScroll, useTransform, motion } from "framer-motion";
import { useRef } from "react";

interface ParallaxImage {
  src: string;
  alt?: string;
}

interface ZoomParallaxProps {
  images: ParallaxImage[];
}

export function ZoomParallax({ images }: ZoomParallaxProps) {
  const container = useRef<HTMLDivElement | null>(null);
  const { scrollYProgress } = useScroll({
    target: container,
    offset: ["start start", "end end"],
  });

  const scale4 = useTransform(scrollYProgress, [0, 1], [1, 4]);
  const scale5 = useTransform(scrollYProgress, [0, 1], [1, 5]);
  const scale6 = useTransform(scrollYProgress, [0, 1], [1, 6]);
  const scale8 = useTransform(scrollYProgress, [0, 1], [1, 8]);
  const scale9 = useTransform(scrollYProgress, [0, 1], [1, 9]);

  const scales = [scale4, scale5, scale6, scale5, scale6, scale8, scale9];

  return (
    <div ref={container} className="relative h-[300vh]">
      <div className="sticky top-0 h-screen overflow-hidden">
        {images.map(({ src, alt }, index) => {
          const scale = scales[index % scales.length];

          return (
            <motion.div
              key={index}
              style={{ scale }}
              className={`absolute top-0 flex h-full w-full items-center justify-center ${
                index === 1
                  ? "[&>div]:!-top-[30vh] [&>div]:!left-[5vw] [&>div]:!h-[30vh] [&>div]:!w-[35vw]"
                  : ""
              } ${
                index === 2
                  ? "[&>div]:!-top-[10vh] [&>div]:!-left-[25vw] [&>div]:!h-[45vh] [&>div]:!w-[20vw]"
                  : ""
              } ${
                index === 3
                  ? "[&>div]:!left-[27.5vw] [&>div]:!h-[25vh] [&>div]:!w-[25vw]"
                  : ""
              } ${
                index === 4
                  ? "[&>div]:!top-[27.5vh] [&>div]:!left-[5vw] [&>div]:!h-[25vh] [&>div]:!w-[20vw]"
                  : ""
              } ${
                index === 5
                  ? "[&>div]:!top-[27.5vh] [&>div]:!-left-[22.5vw] [&>div]:!h-[25vh] [&>div]:!w-[30vw]"
                  : ""
              } ${
                index === 6
                  ? "[&>div]:!top-[22.5vh] [&>div]:!left-[25vw] [&>div]:!h-[15vh] [&>div]:!w-[15vw]"
                  : ""
              }`}
            >
              <div className="relative h-[25vh] w-[25vw] overflow-hidden rounded-lg">
                <img
                  src={src}
                  alt={alt || `Parallax image ${index + 1}`}
                  className="h-full w-full object-cover"
                />
              </div>
            </motion.div>
          );
        })}
      </div>
    </div>
  );
}
```

### 6.12 `src/components/ui/animated-slideshow.tsx`

```tsx
import * as React from "react";
import { type HTMLMotionProps, MotionConfig, motion } from "framer-motion";
import { cn } from "@/lib/utils";

interface TextStaggerHoverProps {
  text: string;
  index: number;
}

interface HoverSliderImageProps {
  index: number;
  imageUrl: string;
}

interface HoverSliderContextValue {
  activeSlide: number;
  changeSlide: (index: number) => void;
}

function splitText(text: string) {
  const words = text.split(" ").map((word) => word.concat(" "));
  const characters = words.flatMap((word) => word.split(""));
  return { words, characters };
}

const HoverSliderContext = React.createContext<HoverSliderContextValue | undefined>(
  undefined,
);

function useHoverSliderContext() {
  const context = React.useContext(HoverSliderContext);
  if (context === undefined) {
    throw new Error("useHoverSliderContext must be used within a HoverSlider");
  }
  return context;
}

export const HoverSlider = React.forwardRef<
  HTMLDivElement,
  React.HTMLAttributes<HTMLDivElement>
>(({ children, className, ...props }, ref) => {
  const [activeSlide, setActiveSlide] = React.useState<number>(0);
  const changeSlide = React.useCallback((index: number) => setActiveSlide(index), []);
  return (
    <HoverSliderContext.Provider value={{ activeSlide, changeSlide }}>
      <div ref={ref} className={className} {...props}>
        {children}
      </div>
    </HoverSliderContext.Provider>
  );
});
HoverSlider.displayName = "HoverSlider";

export const TextStaggerHover = React.forwardRef<
  HTMLSpanElement,
  React.HTMLAttributes<HTMLSpanElement> & TextStaggerHoverProps
>(({ text, index, className, ...props }, ref) => {
  const { activeSlide, changeSlide } = useHoverSliderContext();
  const { characters } = splitText(text);
  const isActive = activeSlide === index;
  const handleMouse = () => changeSlide(index);
  return (
    <span
      className={cn("relative inline-block origin-bottom overflow-hidden", className)}
      ref={ref}
      onMouseEnter={handleMouse}
      {...props}
    >
      {characters.map((char, i) => (
        <span key={`${char}-${i}`} className="relative inline-block overflow-hidden">
          <MotionConfig
            transition={{
              delay: i * 0.025,
              duration: 0.3,
              ease: [0.25, 0.46, 0.45, 0.94],
            }}
          >
            <motion.span
              className="inline-block opacity-20"
              initial={{ y: "0%" }}
              animate={isActive ? { y: "-110%" } : { y: "0%" }}
            >
              {char}
              {char === " " && i < characters.length - 1 && <>&nbsp;</>}
            </motion.span>

            <motion.span
              className="absolute left-0 top-0 inline-block opacity-100"
              initial={{ y: "110%" }}
              animate={isActive ? { y: "0%" } : { y: "110%" }}
            >
              {char}
            </motion.span>
          </MotionConfig>
        </span>
      ))}
    </span>
  );
});
TextStaggerHover.displayName = "TextStaggerHover";

export const clipPathVariants = {
  visible: {
    clipPath: "polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)",
  },
  hidden: {
    clipPath: "polygon(0% 0%, 100% 0%, 100% 0%, 0% 0px)",
  },
};

export const HoverSliderImageWrap = React.forwardRef<
  HTMLDivElement,
  React.HTMLAttributes<HTMLDivElement>
>(({ className, ...props }, ref) => {
  return (
    <div
      ref={ref}
      className={cn(
        "grid overflow-hidden [&>*]:col-start-1 [&>*]:col-end-1 [&>*]:row-start-1 [&>*]:row-end-1 [&>*]:size-full",
        className,
      )}
      {...props}
    />
  );
});
HoverSliderImageWrap.displayName = "HoverSliderImageWrap";

export const HoverSliderImage = React.forwardRef<
  HTMLImageElement,
  HTMLMotionProps<"img"> & HoverSliderImageProps
>(({ index, imageUrl, className, ...props }, ref) => {
  const { activeSlide } = useHoverSliderContext();
  return (
    <motion.img
      className={cn("inline-block align-middle", className)}
      transition={{ ease: [0.33, 1, 0.68, 1], duration: 0.8 }}
      variants={clipPathVariants}
      animate={activeSlide === index ? "visible" : "hidden"}
      src={imageUrl}
      ref={ref}
      {...props}
    />
  );
});
HoverSliderImage.displayName = "HoverSliderImage";
```

### 6.13 `src/components/ui/skills-chart.tsx`

> Catatan palet: bar yang `highlight: true` pakai `bg-accent-primary` (lime); skill biasa pakai `bg-neutral-700` (gray). Tooltip "main stack" hanya muncul di highlighted bar.

```tsx
import NumberFlow from "@number-flow/react";
import { motion, useInView } from "framer-motion";
import { useRef } from "react";
import { cn } from "@/lib/utils";

const css = `
.candy-bg {
  background-color: color-mix(in srgb, var(--candy-bg-color) 50%, transparent);
  background-image: linear-gradient(
    135deg,
    var(--candy-bg-color) 25%,
    transparent 25.5%,
    transparent 50%,
    var(--candy-bg-color) 50.5%,
    var(--candy-bg-color) 75%,
    transparent 75.5%,
    transparent
  );
  background-size: 10px 10px;
}`;

export interface Skill {
  name: string;
  value: number;
  logo: string;
  level?: 1 | 2 | 3 | 4;
  highlight?: boolean;
}

interface SkillsChartProps {
  title?: string;
  subtitle?: string;
  skills: Skill[];
}

export const SkillsChart = ({
  title = "Skills & Tools",
  subtitle = "The stack behind the work. Proficiency level across my daily drivers.",
  skills,
}: SkillsChartProps) => {
  const ref = useRef<HTMLDivElement>(null);
  const inView = useInView(ref, { amount: 0.3 });

  return (
    <section className="py-32">
      <style>{css}</style>
      <div className="container mx-auto">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ amount: 0.5 }}
          transition={{ duration: 0.7, ease: "easeOut" }}
          className="mx-auto max-w-2xl text-center"
        >
          <motion.h2
            initial={{ opacity: 0, y: 20, filter: "blur(8px)" }}
            whileInView={{ opacity: 1, y: 0, filter: "blur(0px)" }}
            viewport={{ amount: 0.5 }}
            transition={{ duration: 0.8, ease: "easeOut" }}
            className="w-full font-display text-5xl lg:text-6xl tracking-tighter"
          >
            {title}
          </motion.h2>
          <motion.p
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ amount: 0.5 }}
            transition={{ duration: 0.6, ease: "easeOut", delay: 0.2 }}
            className="my-4 tracking-tight text-fg-muted lg:px-15 lg:text-lg"
          >
            {subtitle}
          </motion.p>
        </motion.div>

        <div
          ref={ref}
          className="relative mx-auto mt-28 flex h-112 max-w-4xl items-center justify-center gap-2"
        >
          {skills.map((skill, index) => (
            <motion.div
              key={index}
              initial={{ opacity: 0, y: 40 }}
              animate={inView ? { opacity: 1, y: 0 } : { opacity: 0, y: 40 }}
              transition={{
                duration: 0.6,
                delay: index * 0.15,
                type: "spring",
                damping: 12,
              }}
              className="h-full w-full"
            >
              <BarChart
                value={skill.value}
                level={skill.level}
                label={skill.name}
                logo={skill.logo}
                highlight={skill.highlight}
                delay={index * 0.15}
                inView={inView}
              />
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
};

const BarChart = ({
  value,
  level,
  label,
  logo,
  highlight = false,
  delay = 0,
  inView = false,
}: {
  value: number;
  level?: 1 | 2 | 3 | 4;
  label: string;
  logo: string;
  highlight?: boolean;
  delay?: number;
  inView?: boolean;
}) => {
  // Two-tone palette: highlighted skills use accent-primary, others use neutral gray
  const getLevelLabel = (lvl?: number) => {
    switch (lvl) {
      case 4: return "Expert";
      case 3: return "Advanced";
      case 2: return "Intermediate";
      case 1: return "Learning";
      default:
        if (value >= 90) return "Expert";
        if (value >= 75) return "Advanced";
        if (value >= 50) return "Intermediate";
        return "Learning";
    }
  };

  const style = {
    label: getLevelLabel(level),
    color: highlight ? "bg-accent-primary" : "bg-neutral-700",
    text: highlight ? "text-accent-on" : "text-white",
  };
  const barClass = style.color;
  const textColor = style.text;

  return (
    <motion.div
      whileHover={{ scale: 1.04, y: -4 }}
      transition={{ type: "spring", stiffness: 300, damping: 20 }}
      className="group relative h-full w-full cursor-pointer"
    >
      {/* Proficiency Level Badge (Visible on hover) */}
      <motion.div
        className={cn(
          "absolute -top-10 left-1/2 -translate-x-1/2 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest z-40 opacity-0 group-hover:opacity-100 transition-opacity",
          style.color,
          style.text
        )}
      >
        {style.label}
      </motion.div>

      {/* Floating logo */}
      <motion.img
        src={`https://cdn.simpleicons.org/${logo}`}
        alt={label}
        className="absolute -top-20 left-1/2 -translate-x-1/2 size-10 z-30"
        initial={{ opacity: 0, scale: 0.5, y: -10 }}
        animate={
          inView ? { opacity: 1, scale: 1, y: 0 } : { opacity: 0, scale: 0.5, y: -10 }
        }
        transition={{ delay: delay + 0.4, type: "spring", damping: 10 }}
        whileHover={{ scale: 1.2, rotate: 8 }}
      />

      {/* Bar container */}
      <div className="candy-bg relative h-full w-full overflow-hidden rounded-[40px]">
        {/* Growing bar */}
        <motion.div
          initial={{ height: 0 }}
          animate={inView ? { height: `${value}%` } : { height: 0 }}
          transition={{
            duration: 1.2,
            type: "spring",
            damping: 18,
            stiffness: 80,
            delay: delay + 0.2,
          }}
          className={cn(
            "absolute bottom-0 mt-auto w-full rounded-[40px] p-3",
            barClass,
            textColor,
          )}
        >
          {/* Value pill with count-up */}
          <motion.div
            initial={{ opacity: 0, scale: 0.8 }}
            animate={
              inView ? { opacity: 1, scale: 1 } : { opacity: 0, scale: 0.8 }
            }
            transition={{ delay: delay + 0.9, type: "spring", damping: 15 }}
            className="relative flex h-15 w-full items-center justify-center gap-2 rounded-full bg-white/20 tracking-tighter"
          >
            <NumberFlow value={inView ? value : 0} suffix="%" />
          </motion.div>

          {/* Shimmer overlay on highlight bar */}
          {highlight && (
            <motion.div
              className="absolute inset-0 rounded-[40px] overflow-hidden pointer-events-none"
              initial={{ opacity: 0 }}
              animate={inView ? { opacity: 1 } : { opacity: 0 }}
              transition={{ delay: delay + 1.4, duration: 0.5 }}
            >
              <motion.div
                className="absolute inset-y-0 w-1/3 bg-linear-to-r from-transparent via-white/30 to-transparent"
                initial={{ x: "-100%" }}
                animate={inView ? { x: "400%" } : { x: "-100%" }}
                transition={{
                  delay: delay + 1.6,
                  duration: 1.8,
                  repeat: Infinity,
                  repeatDelay: 3,
                  ease: "easeInOut",
                }}
              />
            </motion.div>
          )}
        </motion.div>
      </div>

      {/* "main stack" tooltip for highlight */}
      <motion.div
        initial={{ height: 0 }}
        animate={inView ? { height: `${value}%` } : { height: 0 }}
        transition={{
          duration: 1.2,
          type: "spring",
          damping: 18,
          stiffness: 80,
          delay: delay + 0.2,
        }}
        className="absolute bottom-0 w-full pointer-events-none"
      >
        <motion.div
          initial={{ opacity: 0, y: 10, scale: 0.8 }}
          animate={
            inView && highlight
              ? { opacity: 1, y: 0, scale: 1 }
              : { opacity: 0, y: 10, scale: 0.8 }
          }
          transition={{
            delay: delay + 1.2,
            type: "spring",
            damping: 15,
          }}
          className="absolute -top-6 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-xl bg-accent-primary px-2 py-1 text-accent-on text-xs whitespace-nowrap"
        >
          <motion.div
            animate={{ scale: [1, 1.15, 1] }}
            transition={{ duration: 1.6, repeat: Infinity, ease: "easeInOut" }}
            className="absolute -bottom-6 left-1/2 size-3 -translate-x-1/2 -translate-y-1/2 rounded-full border-2 border-bg-base bg-accent-primary"
          />
          <svg
            className="absolute -bottom-2 left-1/2 -translate-x-1/2 text-accent-primary"
            width="10"
            height="10"
            viewBox="0 0 10 10"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M3.83855 8.41381C4.43827 9.45255 5.93756 9.45255 6.53728 8.41381L9.65582 3.01233C10.2555 1.97359 9.50589 0.675159 8.30646 0.675159H2.06937C0.869935 0.675159 0.120287 1.97359 0.720006 3.01233L3.83855 8.41381Z"
              fill="currentColor"
            />
          </svg>
          main stack
        </motion.div>
      </motion.div>

      {/* Label with fade-in */}
      <motion.p
        initial={{ opacity: 0, y: 10 }}
        animate={inView ? { opacity: 1, y: 0 } : { opacity: 0, y: 10 }}
        transition={{ delay: delay + 1.1, duration: 0.5 }}
        className="mx-auto mt-2 w-fit tracking-tight text-fg-muted/80 text-sm font-medium"
      >
        {label}
      </motion.p>
    </motion.div>
  );
};
```

### 6.14 `src/components/ui/testimonial.tsx`

```tsx
import * as React from "react";
import { motion } from "framer-motion";
import { cn } from "@/lib/utils";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Card, CardContent } from "@/components/ui/card";

export interface Testimonial {
  type: "user" | "quote";
  quote: string;
  name?: string;
  role?: string;
  avatarSrc?: string;
  avatarFallback?: string;
}

interface TestimonialSectionProps extends React.HTMLAttributes<HTMLElement> {
  title: string;
  testimonials: Testimonial[];
}

const QuoteIcon = (props: React.SVGProps<SVGSVGElement>) => (
  <svg
    width="48"
    height="36"
    viewBox="0 0 48 36"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
    {...props}
  >
    <path
      d="M14.9951 36C12.4951 36 10.2285 35.0167 8.19513 33.05C6.1618 31.0833 5.14513 28.8333 5.14513 26.3C5.14513 22.8 6.2118 19.4833 8.34513 16.35C10.4785 13.2167 13.2285 10.1 16.5951 7L21.4951 11.25C19.3618 13.1333 17.6785 14.8833 16.4451 16.5C15.2118 18.1167 14.5951 19.9833 14.5951 22.1H19.9951V36H14.9951ZM37.9951 36C35.4951 36 33.2285 35.0167 31.1951 33.05C29.1618 31.0833 28.1451 28.8333 28.1451 26.3C28.1451 22.8 29.2118 19.4833 31.3451 16.35C33.4785 13.2167 36.2285 10.1 39.5951 7L44.4951 11.25C42.3618 13.1333 40.6785 14.8833 39.4451 16.5C38.2118 18.1167 37.5951 19.9833 37.5951 22.1H42.9951V36H37.9951Z"
      fill="currentColor"
    />
  </svg>
);

const TestimonialCard = ({ testimonial }: { testimonial: Testimonial }) => {
  const isQuoteType = testimonial.type === "quote";

  return (
    <motion.div
      variants={{
        hidden: { opacity: 0, y: 20 },
        visible: { opacity: 1, y: 0 },
      }}
    >
      <Card
        className={cn(
          "h-full w-full transform-gpu transition-all duration-300 hover:-translate-y-1 hover:shadow-xl",
          isQuoteType &&
            "flex flex-col items-center justify-center bg-transparent shadow-none border-none text-center"
        )}
      >
        <CardContent
          className={cn(
            "flex flex-col gap-4 p-6 h-full",
            isQuoteType ? "items-center text-center" : "items-start"
          )}
        >
          {isQuoteType ? (
            <>
              <QuoteIcon className="h-9 w-12 text-accent-primary/50" />
              <p className="text-xl font-display leading-relaxed">
                &ldquo;{testimonial.quote}&rdquo;
              </p>
            </>
          ) : (
            <>
              <p className="text-muted-foreground">&ldquo;{testimonial.quote}&rdquo;</p>
              <div className="flex flex-row items-center gap-4 mt-auto">
                <Avatar>
                  <AvatarImage src={testimonial.avatarSrc} alt={testimonial.name} />
                  <AvatarFallback>{testimonial.avatarFallback}</AvatarFallback>
                </Avatar>
                <div className="flex flex-col">
                  <p className="font-semibold">{testimonial.name}</p>
                  <p className="text-sm text-muted-foreground">{testimonial.role}</p>
                </div>
              </div>
            </>
          )}
        </CardContent>
      </Card>
    </motion.div>
  );
};

const TestimonialSection = React.forwardRef<HTMLElement, TestimonialSectionProps>(
  ({ title, testimonials, className, ...props }, ref) => {
    const containerVariants = {
      hidden: { opacity: 0 },
      visible: {
        opacity: 1,
        transition: {
          staggerChildren: 0.2,
          delayChildren: 0.1,
        },
      },
    };

    return (
      <section
        ref={ref}
        className={cn("mx-auto w-full max-w-6xl px-6 py-12 md:px-8 md:py-24", className)}
        {...props}
      >
        <div className="flex flex-col items-center text-center gap-4 mb-12">
          <h2 className="text-3xl md:text-4xl font-display tracking-tighter">{title}</h2>
        </div>

        <motion.div
          className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
          initial="hidden"
          whileInView="visible"
          viewport={{ amount: 0.25 }}
          variants={containerVariants}
        >
          {testimonials.map((testimonial, index) => {
            const isMiddleItem = index === Math.floor(testimonials.length / 2);
            return (
              <div key={index} className={cn(isMiddleItem && "md:col-span-2 lg:col-span-1")}>
                <TestimonialCard testimonial={testimonial} />
              </div>
            );
          })}
        </motion.div>
      </section>
    );
  }
);

TestimonialSection.displayName = "TestimonialSection";

export { TestimonialSection };
```

### 6.15 `src/components/ui/footer-glow.tsx`

> Inline SVG dipakai untuk Twitter/GitHub/LinkedIn karena `lucide-react` v1.9.0 tidak punya brand icons. Ikon `Zap` masih dari lucide-react.

```tsx
import { Zap } from "lucide-react";

const TwitterIcon = (props: React.SVGProps<SVGSVGElement>) => (
  <svg viewBox="0 0 24 24" fill="currentColor" {...props}>
    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
  </svg>
);

const GithubIcon = (props: React.SVGProps<SVGSVGElement>) => (
  <svg viewBox="0 0 24 24" fill="currentColor" {...props}>
    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
  </svg>
);

const LinkedinIcon = (props: React.SVGProps<SVGSVGElement>) => (
  <svg viewBox="0 0 24 24" fill="currentColor" {...props}>
    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
  </svg>
);

type FooterLink = { label: string; href: string };

type FooterGlowProps = {
  brand?: string;
  description?: string;
  product?: FooterLink[];
  company?: FooterLink[];
  resources?: FooterLink[];
  socials?: { twitter?: string; github?: string; linkedin?: string };
};

const defaultProduct: FooterLink[] = [
  { label: "Projects", href: "#projects" },
  { label: "Skills", href: "#skills" },
  { label: "Testimonials", href: "#testimonials" },
  { label: "Contact", href: "#contact" },
];

const defaultCompany: FooterLink[] = [
  { label: "About", href: "#hero" },
  { label: "Process", href: "#projects" },
  { label: "Blog", href: "#" },
  { label: "Contact", href: "#" },
];

const defaultResources: FooterLink[] = [
  { label: "Docs", href: "#" },
  { label: "Community", href: "#" },
  { label: "Support", href: "#" },
  { label: "Security", href: "#" },
];

export function FooterGlow({
  brand = "Portfolio",
  description = "Crafting bold, playful, and high-impact interfaces for modern teams.",
  product = defaultProduct,
  company = defaultCompany,
  resources = defaultResources,
  socials = {},
}: FooterGlowProps) {
  const year = new Date().getFullYear();

  return (
    <footer
      data-theme="projects"
      className="relative z-40 w-full bg-bg-base pt-12 pb-6 text-fg-primary md:pt-20 md:pb-8"
    >
      <div className="pointer-events-none absolute inset-x-0 top-0 z-0 h-full select-none">
        <div className="absolute -top-32 left-1/4 h-64 w-64 -translate-x-1/2 rounded-full bg-accent-primary/20 blur-3xl md:-top-48 md:h-96 md:w-96 md:bg-accent-primary/25" />
        <div className="absolute right-1/4 -bottom-24 h-60 w-60 translate-x-1/2 rounded-full bg-accent-primary/15 blur-3xl md:h-80 md:w-80 md:bg-accent-primary/20" />
      </div>

      <div className="relative mx-auto flex w-full max-w-7xl flex-col gap-10 px-6 md:flex-row md:items-start md:justify-between md:gap-12 lg:px-10">
        <div className="flex flex-col items-center text-center md:items-start md:text-left">
          <a href="#hero" className="mb-3 flex items-center gap-2 md:mb-4">
            <span className="flex h-8 w-8 items-center justify-center rounded-full bg-accent-primary text-bg-base shadow-md md:h-9 md:w-9">
              <Zap className="h-4 w-4 md:h-5 md:w-5" strokeWidth={2.5} />
            </span>
            <span className="font-display text-lg font-semibold tracking-tight text-fg-primary md:text-xl">
              {brand}
            </span>
          </a>
          <p className="mb-5 max-w-xs text-sm text-fg-muted md:mb-6">
            {description}
          </p>
          <div className="flex gap-4 text-accent-primary md:mt-2 md:gap-3">
            <a
              href={socials.twitter ?? "#"}
              aria-label="Twitter"
              className="transition hover:text-fg-primary"
            >
              <TwitterIcon className="h-5 w-5" />
            </a>
            <a
              href={socials.github ?? "#"}
              aria-label="GitHub"
              className="transition hover:text-fg-primary"
            >
              <GithubIcon className="h-5 w-5" />
            </a>
            <a
              href={socials.linkedin ?? "#"}
              aria-label="LinkedIn"
              className="transition hover:text-fg-primary"
            >
              <LinkedinIcon className="h-5 w-5" />
            </a>
          </div>
        </div>

        <nav className="grid w-full grid-cols-3 gap-4 text-left sm:gap-6 md:flex md:w-auto md:gap-9 md:text-left">
          <FooterColumn title="Explore" links={product} />
          <FooterColumn title="Company" links={company} />
          <FooterColumn title="Resources" links={resources} />
        </nav>
      </div>

      <div className="relative z-10 mt-8 px-6 text-center text-xs text-fg-muted md:mt-10">
        <span>
          &copy; {year} {brand}. All rights reserved.
        </span>
      </div>
    </footer>
  );
}

function FooterColumn({ title, links }: { title: string; links: FooterLink[] }) {
  return (
    <div className="min-w-0">
      <div className="mb-2 text-[10px] font-semibold uppercase tracking-widest text-accent-primary md:mb-3 md:text-xs">
        {title}
      </div>
      <ul className="space-y-1.5 md:space-y-2">
        {links.map(({ label, href }) => (
          <li key={label}>
            <a
              href={href}
              className="text-xs text-fg-muted transition hover:text-fg-primary md:text-sm"
            >
              {label}
            </a>
          </li>
        ))}
      </ul>
    </div>
  );
}
```

---

## 7. Section Components

### 7.1 `src/components/sections/Loader.tsx`

```tsx
import { useEffect, useState } from "react";
import { BlurFade } from "../ui/blur-fade";

const LOADING_MESSAGES = [
  "Crafting your experience…",
  "Brewing some coffee…",
  "Optimizing pixels…",
  "Almost there…",
  "Bringing your vision to life…",
];

export function Loader() {
  const [messageIndex, setMessageIndex] = useState(0);

  useEffect(() => {
    const interval = setInterval(() => {
      setMessageIndex((prev) => (prev + 1) % LOADING_MESSAGES.length);
    }, 800); // Change message every 800ms

    return () => clearInterval(interval);
  }, []);

  return (
    <section
      data-theme="loader"
      className="fixed inset-0 z-[100] flex flex-col items-center justify-center bg-bg-base text-fg-primary"
    >
      <div className="flex flex-col items-center gap-6">
        <BlurFade delay={0.1} inView>
          <h1 className="font-display text-5xl sm:text-7xl xl:text-8xl tracking-tighter text-center">
            Welcome <span className="inline-block animate-wave origin-[70%_70%]">👋</span>
          </h1>
        </BlurFade>

        <div className="h-8 flex items-center justify-center">
          <BlurFade key={messageIndex} delay={0} duration={0.4} inView>
            <span className="text-lg sm:text-xl text-fg-primary/70 tracking-tight text-center block">
              {LOADING_MESSAGES[messageIndex]}
            </span>
          </BlurFade>
        </div>
      </div>
    </section>
  );
}
```

### 7.2 `src/components/sections/HeroSection.tsx`

```tsx
import { Hero } from "@/components/ui/hero-1";

export function HeroSection() {
  return (
    <section data-theme="hero" id="hero" className="relative">
      <Hero
        title="Frontend Developer building fast, delightful UIs"
        subtitle="I turn designs into pixel-perfect, performant web experiences — React, TypeScript, and a lot of care for the details."
        eyebrow="Frontend Engineer — Sugi.dev"
        ctaLabel="View Projects"
        ctaHref="#projects"
      />
    </section>
  );
}
```

### 7.3 `src/components/sections/ProjectsSection.tsx`

```tsx
import { ZoomParallax } from "@/components/ui/zoom-parallax";

const parallaxImages = [
  {
    src: "https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?q=80&w=1600&auto=format&fit=crop",
    alt: "Neon Tokyo — illuminated streets of Shinjuku",
  },
  {
    src: "https://images.unsplash.com/photo-1470770841072-f978cf4d019e?q=80&w=1600&auto=format&fit=crop",
    alt: "Nordic Silence — minimalist Icelandic coast",
  },
  {
    src: "https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?q=80&w=1600&auto=format&fit=crop",
    alt: "Sahara Echoes — golden dunes",
  },
  {
    src: "https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=1600&auto=format&fit=crop",
    alt: "Cyber Future — AI meets humanity",
  },
  {
    src: "https://images.unsplash.com/photo-1682687220742-aba13b6e50ba?q=80&w=1600&auto=format&fit=crop",
    alt: "Deep Ocean — alien beauty of the trench",
  },
  {
    src: "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1600&auto=format&fit=crop",
    alt: "Modern architecture",
  },
  {
    src: "https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1600&auto=format&fit=crop",
    alt: "Forest trees and sunlight",
  },
];

export function ProjectsSection() {
  return (
    <section
      data-theme="projects"
      id="projects"
      className="relative z-10 w-full bg-bg-base text-fg-primary"
    >
      <div className="relative flex flex-col items-center px-4 pt-20 pb-12 text-center md:pt-24">
        <div
          aria-hidden
          className="pointer-events-none absolute left-1/2 -top-20 h-[60vmin] w-[60vmin] -translate-x-1/2 rounded-full bg-accent-primary/10 blur-3xl"
        />
        <h2 className="font-display text-4xl tracking-tighter text-fg-primary md:text-6xl">
          Featured Work
        </h2>
        <p className="mt-3 max-w-md text-fg-muted">
          Scroll to explore selected works in motion.
        </p>
      </div>

      <ZoomParallax images={parallaxImages} />
    </section>
  );
}
```

### 7.4 `src/components/sections/ServicesSection.tsx`

```tsx
import { motion } from "framer-motion";
import {
  HoverSlider,
  HoverSliderImage,
  HoverSliderImageWrap,
  TextStaggerHover,
} from "@/components/ui/animated-slideshow";

const SLIDES = [
  {
    id: "frontend",
    title: "frontend dev",
    imageUrl:
      "https://images.unsplash.com/photo-1654618977232-a6c6dea9d1e8?q=80&w=1600&auto=format&fit=crop",
  },
  {
    id: "backend",
    title: "backend dev",
    imageUrl:
      "https://images.unsplash.com/photo-1624996752380-8ec242e0f85d?q=80&w=1600&auto=format&fit=crop",
  },
  {
    id: "ui-ux",
    title: "ui ux design",
    imageUrl:
      "https://images.unsplash.com/photo-1688733720228-4f7a18681c4f?q=80&w=1600&auto=format&fit=crop",
  },
  {
    id: "video",
    title: "video editing",
    imageUrl:
      "https://images.unsplash.com/photo-1574717025058-2f8737d2e2b7?q=80&w=1600&auto=format&fit=crop",
  },
  {
    id: "seo",
    title: "seo optimization",
    imageUrl:
      "https://images.unsplash.com/photo-1726066012698-bb7a3abce786?q=80&w=1600&auto=format&fit=crop",
  },
];

export function ServicesSection() {
  return (
    <section
      data-theme="services"
      id="services"
      className="relative z-20 w-full bg-bg-base text-fg-primary"
    >
      <div className="container mx-auto px-6 py-24 md:px-12 md:py-32">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ amount: 0.5 }}
          transition={{ duration: 0.7, ease: "easeOut" }}
          className="mx-auto max-w-2xl text-center"
        >
          <motion.h2
            initial={{ opacity: 0, y: 20, filter: "blur(8px)" }}
            whileInView={{ opacity: 1, y: 0, filter: "blur(0px)" }}
            viewport={{ amount: 0.5 }}
            transition={{ duration: 0.8, ease: "easeOut" }}
            className="w-full font-display text-5xl tracking-tighter lg:text-6xl"
          >
            Our Services
          </motion.h2>
          <motion.p
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ amount: 0.5 }}
            transition={{ duration: 0.6, ease: "easeOut", delay: 0.2 }}
            className="my-4 tracking-tight text-fg-muted lg:px-15 lg:text-lg"
          >
            What I can help you ship — from product UI to performance and polish.
          </motion.p>
        </motion.div>

        <HoverSlider className="mt-16">
          <div className="flex flex-wrap items-center justify-evenly gap-10 md:gap-16">
            <motion.div
              initial={{ opacity: 0, x: -30 }}
              whileInView={{ opacity: 1, x: 0 }}
              viewport={{ amount: 0.3 }}
              transition={{ duration: 0.7, ease: "easeOut" }}
              className="flex flex-col space-y-3 md:space-y-5"
            >
              {SLIDES.map((slide, index) => (
                <TextStaggerHover
                  key={slide.id}
                  index={index}
                  className="cursor-pointer font-display text-3xl font-bold uppercase tracking-tighter transition-colors duration-300 hover:text-accent-primary md:text-5xl"
                  text={slide.title}
                />
              ))}
            </motion.div>
            <motion.div
              initial={{ opacity: 0, x: 30 }}
              whileInView={{ opacity: 1, x: 0 }}
              viewport={{ amount: 0.3 }}
              transition={{ duration: 0.7, ease: "easeOut", delay: 0.15 }}
              className="aspect-[4/5] w-full max-w-md"
            >
              <HoverSliderImageWrap className="h-full w-full overflow-hidden rounded-xl border border-border-subtle">
                {SLIDES.map((slide, index) => (
                  <HoverSliderImage
                    key={slide.id}
                    index={index}
                    imageUrl={slide.imageUrl}
                    alt={slide.title}
                    className="h-full w-full object-cover"
                    loading="eager"
                    decoding="async"
                  />
                ))}
              </HoverSliderImageWrap>
            </motion.div>
          </div>
        </HoverSlider>
      </div>
    </section>
  );
}
```

### 7.5 `src/components/sections/SkillsSection.tsx`

```tsx
import { SkillsChart, type Skill } from "@/components/ui/skills-chart";

const defaultSkills: Skill[] = [
  { name: "React", value: 95, logo: "react", level: 4, highlight: true },
  { name: "TypeScript", value: 85, logo: "typescript", level: 3 },
  { name: "Node.js", value: 65, logo: "nodedotjs", level: 2 },
  { name: "Tailwind CSS", value: 90, logo: "tailwindcss", level: 4 },
];

export function SkillsSection() {
  return (
    <div
      data-theme="skills"
      id="skills"
      className="relative z-20 bg-bg-base text-fg-primary"
    >
      <SkillsChart
        title="Skills & Tools"
        subtitle="The stack behind the work. Proficiency level across my daily drivers."
        skills={defaultSkills}
      />
    </div>
  );
}
```

### 7.6 `src/components/sections/TestimonialsSection.tsx`

```tsx
import { TestimonialSection, type Testimonial } from "@/components/ui/testimonial";

const defaultTestimonials: Testimonial[] = [
  {
    type: "user",
    quote:
      "Working with them transformed our product's identity. The attention to motion, color, and detail is next level.",
    name: "Le'mont C.",
    role: "Product Lead, Acme Co.",
    avatarSrc: "https://i.pravatar.cc/150?u=lemont",
    avatarFallback: "LC",
  },
  {
    type: "quote",
    quote:
      "Design is not just what it looks like — design is how it works, how it feels, and how it moves.",
    name: "Design Philosophy",
    role: "",
  },
  {
    type: "user",
    quote:
      "The final product exceeded every expectation. Fast, beautiful, and absolutely unique. Zero generic AI vibes.",
    name: "Christian W.",
    role: "Founder, Studio Nord",
    avatarSrc: "https://i.pravatar.cc/150?u=christian",
    avatarFallback: "CW",
  },
];

export function TestimonialsSectionWrapper() {
  return (
    <div
      data-theme="testimonials"
      id="testimonials"
      className="relative z-30 bg-bg-base text-fg-primary"
    >
      <TestimonialSection
        title="Words from collaborators"
        testimonials={defaultTestimonials}
      />
    </div>
  );
}
```

### 7.7 `src/components/sections/Footer.tsx`

```tsx
import { FooterGlow } from "@/components/ui/footer-glow";

export function Footer({ brand = "Portfolio" }: { brand?: string }) {
  return <FooterGlow brand={brand} />;
}
```

---

## 8. App Root

**File: `src/App.tsx`**

```tsx
import { useEffect, useState } from "react";
import { Loader } from "@/components/sections/Loader";
import { HeroSection } from "@/components/sections/HeroSection";
import { ProjectsSection } from "@/components/sections/ProjectsSection";
import { ServicesSection } from "@/components/sections/ServicesSection";
import { SkillsSection } from "@/components/sections/SkillsSection";
import { TestimonialsSectionWrapper } from "@/components/sections/TestimonialsSection";
import { Footer } from "@/components/sections/Footer";
import { NavBar } from "@/components/ui/nav-bar";
import { SocialDock } from "@/components/ui/social-dock";

function App() {
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    const timer = setTimeout(() => setIsLoading(false), 3000);
    return () => clearTimeout(timer);
  }, []);

  if (isLoading) return <Loader />;

  return (
    <>
      <NavBar brand="Sugi.dev" />
      <main>
        <HeroSection />
        <ProjectsSection />
        <ServicesSection />
        <SkillsSection />
        <TestimonialsSectionWrapper />
      </main>
      <Footer brand="Sugi.dev" />
      <SocialDock />
    </>
  );
}

export default App;
```

**Penjelasan flow:**
- **Loader** ditampilkan 3 detik (fixed overlay z-[100]) sebelum App render isinya. Loader pakai `data-theme="loader"` + animasi BlurFade + emoji wave.
- Setelah loader hilang: `NavBar` (desktop pill) + `MobileNav` (drawer) terpasang sebagai sibling pertama, lalu `<main>` berisi 5 section. `Footer` dan `SocialDock` (fixed dock di desktop) di luar `<main>`.
- `brand="Sugi.dev"` diteruskan ke NavBar dan Footer untuk konsistensi label.

---

## 9. Theme Summary

| Section            | `data-theme`     | Background | Note                                                    |
| ------------------ | ---------------- | ---------- | ------------------------------------------------------- |
| Loader             | `loader`         | `#0a0a0a`  | Fade-out setelah 3 detik                                |
| NavBar / MobileNav | `nav`            | translucent `bg-bg-elevated/70` + blur | Pill desktop menyusut saat scroll |
| Hero               | `hero`           | `#0a0a0a`  | Grid bg + radial parallax (lime accent edge)            |
| Projects           | `projects`       | `#0a0a0a`  | Heading + ZoomParallax 300vh (7 gambar zoom)            |
| Services           | `services`*      | `#0a0a0a`  | *belum punya override CSS — fallback ke `:root` (sama)  |
| Skills             | `skills`         | `#0a0a0a`  | BarChart 4 skill, palet 2-warna (lime / neutral-700)    |
| Testimonials       | `testimonials`   | `#111111`  | Sedikit lebih terang dari section lain                  |
| Footer             | `projects` reuse | `#0a0a0a`  | Glow lime di atas + bawah, full-width tanpa border      |
| SocialDock         | `nav`            | dock pill  | Desktop only, fixed bottom-center                       |

**Aturan akses token (yang berlaku di seluruh app):**
- Background: `bg-bg-base` (utama), `bg-bg-elevated` (card/elevated), `bg-bg-contrast` (terang utk button mobile-nav toggle)
- Foreground: `text-fg-primary` (heading/body), `text-fg-muted` (subtitle), `text-fg-inverted` (di atas bg-contrast)
- Accent: `bg-accent-primary` / `text-accent-primary` (lime `#e8ff3a`), `text-accent-on` (pada bg accent — `#0a0a0a`)
- Border: `border-border-subtle` (hairline transparan), `border-border-strong` (solid)

**Font usage:**
- `font-display` (Instrument Serif) → semua headline (h1/h2/h3 utama, brand wordmark)
- Default body → Inter (langsung dari `body` style)

---

## 10. Checklist Akhir

```bash
# 1. Setup dari nol
npm create vite@latest landing-page -- --template react-ts
cd landing-page
npm install

# 2. Tambahkan deps
npm install tailwindcss @tailwindcss/vite framer-motion clsx tailwind-merge \
  lucide-react @radix-ui/react-slot @radix-ui/react-avatar \
  class-variance-authority @number-flow/react
npm install -D @types/node

# 3. Salin SEMUA file dari spec ini sesuai path-nya
#    - vite.config.ts (ganti default)
#    - tsconfig.app.json (tambah `paths`)
#    - src/index.css (overwrite default Vite)
#    - src/lib/utils.ts (buat baru)
#    - src/components/ui/*.tsx (15 file)
#    - src/components/sections/*.tsx (7 file)
#    - src/App.tsx (overwrite default)

# 4. Jalankan
npm run dev
```

**Yang harus terlihat saat dev server hidup:**
1. **3 detik loader** dengan "Welcome 👋" + rotating message tiap 800ms.
2. **Hero**: title serif besar, lime radial edge di bagian bawah, CTA "View Projects".
3. **Featured Work**: heading center, lalu 7 gambar zoom-parallax dengan scroll panjang (300vh).
4. **Our Services**: 5 service text di kiri, image preview di kanan, hover text → lime + slide animation.
5. **Skills & Tools**: 4 vertical bar (React lime, TS/Node/Tailwind gray) dengan logo dan tooltip "main stack" hanya di React.
6. **Words from collaborators**: 3 testimonial card, item tengah memakai gaya `quote` (no card bg).
7. **Footer**: glow lime menyatu ke atas, brand + 3 column link, di mobile 3-column compact.
8. **NavBar pill** di desktop (kanan-kiri symmetric center, menyusut saat scroll), **hamburger** di mobile.
9. **SocialDock** di tengah-bawah desktop (4 ikon: GitHub, X, LinkedIn, Dribbble) dengan tooltip.

**Smoke check:**
- `npm run build` → harus lulus tanpa error TS.
- Buka di mobile (Chrome DevTools 375px): footer pakai 3-col grid (compact), navbar berubah jadi hamburger, SocialDock disembunyikan, MobileNav drawer muncul saat hamburger ditekan.
- Buka di desktop (≥768px): NavBar pill terlihat, SocialDock dock muncul di bottom-center.

Selesai — page hasil harus identik dengan kode yang sudah ada di repo.
