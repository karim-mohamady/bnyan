import { NextResponse } from 'next/server';
import {
  boardMembersList,
  assemblyMembers,
  annualReports,
  financialStatements,
  assemblyMinutes,
  policiesDocs,
  governanceDocuments,
  governanceCategories,
} from '@/data/governance';

export async function GET() {
  return NextResponse.json(
    {
      boardMembers: boardMembersList,
      assemblyMembers,
      annualReports,
      financialStatements,
      assemblyMinutes,
      policies: policiesDocs,
      policiesDocs,
      documents: governanceDocuments,
      categories: governanceCategories,
    },
    {
      headers: {
        'Cache-Control': 'public, max-age=60, stale-while-revalidate=300',
      },
    }
  );
}
