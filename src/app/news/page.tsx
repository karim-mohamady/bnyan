import type { Metadata } from 'next';
import { fetchNews } from '@/lib/api';
import NewsClient from './NewsClient';

export const metadata: Metadata = {
  title: 'المركز الإعلامي',
  description: 'تابع آخر أخبار جمعية بنيان للعناية بالمساجد بالخبراء، تقارير صيانة المساجد والتغطيات الصحفية الميدانية.',
};

export default async function NewsPage() {
  const news = await fetchNews({ page_news: true });
  return <NewsClient initialNews={news} />;
}
