import type { Metadata } from "next";
import { Noto_Kufi_Arabic } from "next/font/google";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import FloatActions from "@/components/FloatActions";

// Import stylesheets in correct sequence to preserve CSS cascade rules
import "@/styles/base.css";
import "@/styles/header.css";
import "@/styles/hero.css";
import "@/styles/about.css";
import "@/styles/projects.css";
import "@/styles/projects-hscroll.css";
import "@/styles/project-details.css";
import "@/styles/stats.css";
import "@/styles/impact.css";
import "@/styles/news.css";
import "@/styles/news-home.css";
import "@/styles/quick-contact.css";
import "@/styles/about-page.css";
import "@/styles/governance.css";
import "@/styles/donate.css";
import "@/styles/contact.css";
import "@/styles/board.css";
import "@/styles/volunteer.css";
import "@/styles/page-system.css";
import "@/styles/news-full.css";
import "@/styles/footer.css";
import "@/styles/animations.css";
import "@/styles/section-reveal.css";
import "@/styles/responsive.css";
import "@/styles/home-about.css";
import "@/styles/floating-actions.css";
import "./globals.css";

const notoKufiArabic = Noto_Kufi_Arabic({
  subsets: ["arabic"],
  variable: "--font-noto-kufi",
  display: "swap",
});

export const metadata: Metadata = {
  title: "جمعية بنيان للعناية بالمساجد بالخبراء",
  description: "جمعية أهلية غير ربحية متخصصة في صيانة وترميم المساجد بمحافظة الخبراء، مرخصة من المركز الوطني لتنمية القطاع غير الربحي.",
  formatDetection: {
    telephone: false,
  },
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="ar" dir="rtl" className={notoKufiArabic.variable} suppressHydrationWarning>
      <head>
        <link 
          rel="stylesheet" 
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
          integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
          crossOrigin="anonymous" 
          referrerPolicy="no-referrer" 
        />
      </head>
      <body style={{ fontFamily: "var(--font-noto-kufi), sans-serif" }} suppressHydrationWarning>
        <Header />
        {children}
        <Footer />
        <FloatActions />
      </body>
    </html>
  );
}
