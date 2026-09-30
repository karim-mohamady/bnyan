Bunyan truth kit
================
truth/*.json            Ground truth generated mechanically from bnyan-next/src/data/*.ts (do not edit).
tools/extract-truth.mjs Regenerates truth/*.json from the source (node --experimental-strip-types).
tools/verify-strings.mjs Fails if any Arabic/https literal in the Laravel seed layer is not found verbatim in bnyan-next/src.
tools/string-gate-allowlist.json Explicit, justified exceptions only (starts empty).

Place in the repo root:
  tools/*                       -> tools/
  truth/*.json                  -> laravel/database/seeders/truth/
Run from repo root:
  node --experimental-strip-types tools/extract-truth.mjs bnyan-next/src/data laravel/database/seeders/truth
  node tools/verify-strings.mjs bnyan-next/src laravel/config/content_schema.php laravel/database/seeders

This is a [Next.js](https://nextjs.org) project bootstrapped with [`create-next-app`](https://nextjs.org/docs/app/api-reference/cli/create-next-app).

## Getting Started

First, run the development server:

```bash
npm run dev
# or
yarn dev
# or
pnpm dev
# or
bun dev
```

Open [http://localhost:3000](http://localhost:3000) with your browser to see the result.

You can start editing the page by modifying `app/page.tsx`. The page auto-updates as you edit the file.

This project uses [`next/font`](https://nextjs.org/docs/app/building-your-application/optimizing/fonts) to automatically optimize and load [Geist](https://vercel.com/font), a new font family for Vercel.

## Learn More

To learn more about Next.js, take a look at the following resources:

- [Next.js Documentation](https://nextjs.org/docs) - learn about Next.js features and API.
- [Learn Next.js](https://nextjs.org/learn) - an interactive Next.js tutorial.

You can check out [the Next.js GitHub repository](https://github.com/vercel/next.js) - your feedback and contributions are welcome!

## Deploy on Vercel

The easiest way to deploy your Next.js app is to use the [Vercel Platform](https://vercel.com/new?utm_medium=default-template&filter=next.js&utm_source=create-next-app&utm_campaign=create-next-app-readme) from the creators of Next.js.

Check out our [Next.js deployment documentation](https://nextjs.org/docs/app/building-your-application/deploying) for more details.
