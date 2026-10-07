import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  output: 'standalone',
  images: {
    remotePatterns: [
      {
        protocol: 'https',
        hostname: 'res.cloudinary.com',
      },
      {
        protocol: 'https',
        hostname: 'bunyankh.org.sa',
      },
      {
        protocol: 'https',
        hostname: 'www.bunyankh.org.sa',
      },
      {
        protocol: 'https',
        hostname: 'api.bunyankh.org.sa',
      },
      {
        protocol: 'http',
        hostname: '127.0.0.1',
      },
    ],
  },
  experimental: {
    // ترك الكائن فارغاً أو إضافة الخصائص التجريبية الخاصة بالإصدار عند الحاجة
  },
};

export default nextConfig;