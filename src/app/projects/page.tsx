import type { Metadata } from 'next';
import { fetchProjects } from '@/lib/api';
import ProjectsClient from './ProjectsClient';

export const metadata: Metadata = { title: 'المشاريع' };

export default async function ProjectsPage() {
  const projects = await fetchProjects();
  return <ProjectsClient projects={projects} />;
}
