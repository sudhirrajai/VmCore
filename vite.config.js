import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import html from '@rollup/plugin-html';
import { glob } from 'glob';
import path from 'path';
import iconsPlugin from './vite.icons.plugin.js';

/**
 * Get Files from a directory
 * @param {string} query
 * @returns array
 */
function GetFilesArray(query) {
  return glob.sync(query);
}

// ─── Admin (Sneat) Assets ─────────────────────────────────────────────────────
// Page JS Files
const pageJsFiles = GetFilesArray('resources/assets/admin/js/*.js');

// Vendor JS Files
const vendorJsFiles = GetFilesArray('resources/assets/admin/vendor/js/*.js');

// Libs JS Files
const LibsJsFiles = GetFilesArray('resources/assets/admin/vendor/libs/**/*.js');

// Libs Scss & Css
const LibsScssFiles = GetFilesArray('resources/assets/admin/vendor/libs/**/!(_)*.scss');
const LibsCssFiles = GetFilesArray('resources/assets/admin/vendor/libs/**/*.css');

// Core / Theme Scss
const CoreScssFiles = GetFilesArray('resources/assets/admin/vendor/scss/**/!(_)*.scss');

// Fonts
const FontsScssFiles = GetFilesArray('resources/assets/admin/vendor/fonts/!(_)*.scss');
const FontsJsFiles = GetFilesArray('resources/assets/admin/vendor/fonts/**/!(_)*.js');
const FontsCssFiles = GetFilesArray('resources/assets/admin/vendor/fonts/**/!(_)*.css');

export default defineConfig({
  plugins: [
    laravel({
      input: [
        // ── Frontend (portfolio) ──────────────────────────────
        'resources/css/app.css',
        'resources/js/app.js',

        // ── Admin (Sneat) ─────────────────────────────────────
        'resources/assets/admin/css/demo.css',
        ...pageJsFiles,
        ...vendorJsFiles,
        ...LibsJsFiles,
        ...CoreScssFiles,
        ...LibsScssFiles,
        ...LibsCssFiles,
        ...FontsScssFiles,
        ...FontsJsFiles,
        ...FontsCssFiles
      ],
      refresh: true
    }),
    tailwindcss(),
    html(),
    iconsPlugin()
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources')
    }
  },
  json: {
    stringify: true
  },
  build: {
    commonjsOptions: {
      include: [/node_modules/]
    }
  },
  server: {
    watch: {
      ignored: ['**/storage/framework/views/**']
    }
  }
});
