import { svelte } from "@sveltejs/vite-plugin-svelte";
import { defineConfig } from "vite";

// One self-contained script per tool, named after it, for a Zola page to load
// with the `tool` shortcode. Styles are injected by the script so each tool is
// a single file.
const tools = ["encounter-calculator"];

export default defineConfig({
  plugins: [svelte({ compilerOptions: { css: "injected" } })],
  build: {
    outDir: "../static/tools",
    emptyOutDir: true,
    rollupOptions: {
      input: Object.fromEntries(tools.map((name) => [name, `src/${name}/main.ts`])),
      output: { entryFileNames: "[name].js", chunkFileNames: "chunks/[name]-[hash].js" },
    },
  },
});
