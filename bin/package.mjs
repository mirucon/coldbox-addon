import { cpSync, mkdirSync, readFileSync, readdirSync, rmSync, statSync, writeFileSync } from 'node:fs';
import { extname } from 'node:path';
import assert from 'node:assert/strict';
import { fileURLToPath } from 'node:url';
process.chdir(fileURLToPath(new URL('..', import.meta.url)));
rmSync(new URL('../dist', import.meta.url), { recursive: true, force: true });
mkdirSync('dist/inc', { recursive: true });
for (const name of ['coldbox-addon.php', 'readme.txt']) cpSync(name, `dist/${name}`);
for (const name of readdirSync('inc').filter(name => name.endsWith('.php'))) cpSync(`inc/${name}`, `dist/inc/${name}`);
try { cpSync('languages', 'dist/languages', { recursive: true }); } catch (error) { if (error.code !== 'ENOENT') throw error; }
const textExts = new Set(['.php', '.txt', '.md', '.pot']);
for (const rel of readdirSync('dist', { recursive: true })) {
  const full = `dist/${rel}`;
  if (statSync(full).isFile() && textExts.has(extname(full).toLowerCase())) {
    writeFileSync(full, readFileSync(full, 'utf8').replace(/\r\n/g, '\n'));
  }
}
const files = readdirSync('dist', { recursive: true });
assert(!files.some(name => /(?:node_modules|vendor|tests|amp-style|\.sql$)/.test(name)));
console.log(`Packaged Add-on (${files.length} entries); no CSS build is needed.`);
