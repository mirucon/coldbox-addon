import { cpSync, mkdirSync, readdirSync, rmSync } from 'node:fs';
import assert from 'node:assert/strict';
import { fileURLToPath } from 'node:url';
process.chdir(fileURLToPath(new URL('..', import.meta.url)));
rmSync(new URL('../dist', import.meta.url), { recursive: true, force: true });
mkdirSync('dist/inc', { recursive: true });
for (const name of ['coldbox-addon.php', 'readme.txt']) cpSync(name, `dist/${name}`);
for (const name of readdirSync('inc').filter(name => name.endsWith('.php'))) cpSync(`inc/${name}`, `dist/inc/${name}`);
try { cpSync('languages', 'dist/languages', { recursive: true }); } catch (error) { if (error.code !== 'ENOENT') throw error; }
const files = readdirSync('dist', { recursive: true });
assert(!files.some(name => /(?:node_modules|vendor|tests|amp-style|\.sql$)/.test(name)));
console.log(`Packaged Add-on (${files.length} entries); no CSS build is needed.`);
