// Generates ground-truth JSON fixtures directly from bnyan-next/src/data/*.ts
// Usage (repo root):
//   node --experimental-strip-types tools/extract-truth.mjs bnyan-next/src/data laravel/database/seeders/truth
// Fixtures are GENERATED. Never edit them by hand and never type these values from memory.
// The source files are read-only: a temp copy is made only to add ".ts" to relative imports.
import { mkdirSync, writeFileSync, readFileSync, readdirSync, mkdtempSync } from 'node:fs';
import { resolve, join } from 'node:path';
import { tmpdir } from 'node:os';
import { pathToFileURL } from 'node:url';

const [, , srcDir = 'bnyan-next/src/data', outDir = 'laravel/database/seeders/truth'] = process.argv;
const tmp = mkdtempSync(join(tmpdir(), 'bnyan-truth-'));
for (const f of readdirSync(srcDir).filter((f) => f.endsWith('.ts'))) {
  const code = readFileSync(resolve(srcDir, f), 'utf8')
    .replace(/from\s+(['"])(\.\/[^'"]+?)(?<!\.ts)\1/g, 'from $1$2.ts$1');
  writeFileSync(join(tmp, f), code, 'utf8');
}
mkdirSync(outDir, { recursive: true });
const load = (f) => import(pathToFileURL(join(tmp, f)).href);
const write = (name, data) => writeFileSync(resolve(outDir, name), JSON.stringify(data, null, 2) + '\n', 'utf8');

const p = await load('projects.ts');
const n = await load('news.ts');
const b = await load('board.ts');
const c = await load('contact.ts');
const g = await load('governance.ts');

write('projects.json', p.projects);
write('news_home.json', n.newsItems);
write('board_members.json', b.boardMembers);
write('contact.json', { CONTACT: c.CONTACT, SOCIAL_PLATFORMS: c.SOCIAL_PLATFORMS });
write('governance.json', {
  GOVERNANCE_SUBMENU: g.GOVERNANCE_SUBMENU,
  annualReports: g.annualReports,
  financialStatements: g.financialStatements,
  assemblyMinutes: g.assemblyMinutes,
  assemblyMembers: g.assemblyMembers,
  policiesDocs: g.policiesDocs,
  boardMembersList: g.boardMembersList,
});
console.log('OK ->', outDir);
