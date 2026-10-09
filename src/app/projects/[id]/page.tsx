import type { Metadata } from 'next';
import { notFound } from 'next/navigation';
import { fetchProject } from '@/lib/api';
import ProjectDetailsClient from './ProjectDetailsClient';
export const dynamic = 'force-dynamic';
interface PageProps {
  params: Promise<{ id: string }>;
}

export async function generateMetadata({ params }: PageProps): Promise<Metadata> {
  const { id } = await params;
  const project = await fetchProject(parseInt(id, 10));
  if (!project) return { title: 'المشروع غير موجود' };
  return { title: project.name, description: project.desc };
}

export default async function ProjectDetailsPage({ params }: PageProps) {
  const { id } = await params;
  const projectId = parseInt(id, 10);
  if (Number.isNaN(projectId)) notFound();

  const project = await fetchProject(projectId);
  if (!project) notFound();

  return <ProjectDetailsClient project={project} />;
}
