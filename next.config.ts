import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  output: 'standalone',
  images: {
    unoptimized: true, // الصور هتتحمّل مباشرة من Cloudinary من غير ما تعدي على سيرفر Next
    remotePatterns: [
      { protocol: 'https', hostname: 'res.cloudinary.com' },
      { protocol: 'https', hostname: 'bunyankh.org.sa' },
      { protocol: 'https', hostname: 'www.bunyankh.org.sa' },
      { protocol: 'https', hostname: 'api.bunyankh.org.sa' },
      { protocol: 'http', hostname: '127.0.0.1' },
    ],
  },
};

export default nextConfig;