import { NextResponse } from 'next/server';
import {
  boardMembersList,
  assemblyMembers,
  annualReports,
  financialStatements,
  assemblyMinutes,
  policiesDocs,
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
    },
    {
      headers: {
        'Cache-Control': 'public, max-age=60, stale-while-revalidate=300',
      },
    }
  );
}
