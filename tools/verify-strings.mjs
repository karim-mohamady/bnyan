// Anti-fabrication gate: every Arabic / https string literal in the Laravel seed layer must appear
// VERBATIM (whitespace-collapsed) somewhere in the original Next.js source.
// Usage (repo root):
//   node tools/verify-strings.mjs bnyan-next/src laravel/config/content_schema.php laravel/database/seeders
// Exit code 1 if any literal is not found and not allow-listed in tools/string-gate-allowlist.json
//   allowlist format: [{ "text": "<exact literal>", "reason": "<why>", "source": "<file:line>" }]
import { readFileSync, readdirSync, statSync, existsSync } from 'node:fs';
import { join, extname } from 'node:path';

const [, , srcDir, ...targets] = process.argv;
if (!srcDir || targets.length === 0) { console.error('usage: verify-strings.mjs <srcDir> <phpFileOrDir>...'); process.exit(2); }

const walk = (p, exts, out = []) => {
  const s = statSync(p);
  if (s.isDirectory()) for (const f of readdirSync(p)) { if (f === 'node_modules' || f === 'truth') continue; walk(join(p, f), exts, out); }
  else if (exts.includes(extname(p))) out.push(p);
  return out;
};
const norm = (t) => t.replace(/\s+/g, ' ').trim();

// haystack = all source text, whitespace-collapsed, JSX/TS escapes removed
const hay = norm(walk(srcDir, ['.ts', '.tsx', '.css', '.js', '.json'])
  .map((f) => readFileSync(f, 'utf8')).join('\n')
  .replace(/\\'/g, "'").replace(/\\"/g, '"').replace(/&nbsp;/g, ' '));

// PHP string-literal scanner (single and double quoted, with escapes)
const literals = (code) => {
  const out = []; let i = 0;
  while (i < code.length) {
    const ch = code[i];
    if (ch === '/' && code[i + 1] === '/') { while (i < code.length && code[i] !== '\n') i++; continue; }
    if (ch === '#') { while (i < code.length && code[i] !== '\n') i++; continue; }
    if (ch === '/' && code[i + 1] === '*') { i = code.indexOf('*/', i + 2); if (i < 0) break; i += 2; continue; }
    if (ch === "'" || ch === '"') {
      const q = ch; let s = ''; i++;
      while (i < code.length && code[i] !== q) {
        if (code[i] === '\\' && (code[i + 1] === q || code[i + 1] === '\\')) { s += code[i + 1]; i += 2; }
        else { s += code[i]; i++; }
      }
      i++; out.push(s); continue;
    }
    i++;
  }
  return out;
};

// content_schema.php mixes site text ('default' => ...) with dashboard-only labels/hints.
// For that file ONLY the expression after each 'default' => is checked (string or balanced [...] / array(...)).
const defaultsOnly = (code) => {
  const out = []; const re = /['"]default['"]\s*=>\s*/g; let m;
  while ((m = re.exec(code))) {
    let i = re.lastIndex; const start = i;
    if (code[i] === '[' || code.startsWith('array(', i)) {
      let depth = 0, q = null;
      for (; i < code.length; i++) {
        const c = code[i];
        if (q) { if (c === '\\') i++; else if (c === q) q = null; continue; }
        if (c === "'" || c === '"') { q = c; continue; }
        if (c === '[' || c === '(') depth++;
        if (c === ']' || c === ')') { depth--; if (depth === 0) { i++; break; } }
      }
    } else if (code[i] === "'" || code[i] === '"') {
      const qc = code[i]; i++;
      while (i < code.length && code[i] !== qc) { if (code[i] === '\\') i++; i++; }
      i++;
    } else continue;
    out.push(...literals(code.slice(start, i)));
  }
  return out;
};
const AR = /[\u0600-\u06FF]/;
const allow = existsSync('tools/string-gate-allowlist.json') ? JSON.parse(readFileSync('tools/string-gate-allowlist.json', 'utf8')) : [];
const allowed = new Set(allow.map((a) => norm(a.text)));

let checked = 0; const missing = [];
for (const t of targets) for (const f of walk(t, ['.php'])) {
  const code = readFileSync(f, 'utf8');
  const lits = f.endsWith('content_schema.php') ? defaultsOnly(code) : literals(code);
  for (const raw of lits) {
    const s = norm(raw);
    if (!(AR.test(s) || /^https?:\/\//.test(s))) continue;
    checked++;
    if (hay.includes(s) || allowed.has(s)) continue;
    missing.push({ file: f, text: s });
  }
}
console.log(`checked ${checked} literals; NOT FOUND in source: ${missing.length}`);
for (const m of missing) console.log(`  ✗ ${m.file}\n    ${m.text.slice(0, 200)}`);
process.exit(missing.length ? 1 : 0);
