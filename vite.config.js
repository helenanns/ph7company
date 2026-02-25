import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import path from 'path'

export default defineConfig(({ command }) => ({
  plugins: [react()],
  base: command === 'build' ? './' : '/',   // build com paths relativos p/ WP
  server: {
    host: '127.0.0.1',
    port: 5173,
    strictPort: true,
    cors: true,
    hmr: {
      host: '127.0.0.1',
      protocol: 'ws',
      port: 5173,
    },
  },
  build: {
    manifest: true,
    outDir: 'dist',
    rollupOptions: {
      input: {
        account: path.resolve(__dirname, 'src/js/account.js'),
        blog: path.resolve(__dirname, 'src/js/blog.js'),
        cart: path.resolve(__dirname, 'src/js/cart.js'),
        home: path.resolve(__dirname, 'src/js/home.js'),
        main: path.resolve(__dirname, 'src/js/main.js'),
        page: path.resolve(__dirname, 'src/js/page.js'),
        singleProduct: path.resolve(__dirname, 'src/js/single-product.js'),
        single: path.resolve(__dirname, 'src/js/single.js'),
        blocks: path.resolve(__dirname, 'src/blocks/index.jsx'),
      },
      output: {
        entryFileNames: (chunk) => {
          const name = chunk.name || ''
          if (name.startsWith('blocks/')) return 'blocks/[name].js'
          return 'js/[name].js'
        },
        chunkFileNames: 'js/[name]-[hash].js',
        assetFileNames: (assetInfo) => {
          const name = assetInfo.name || ''
          if (name.endsWith('.css')) return 'css/[name][extname]'
          if (/\.(woff2?|ttf|otf|eot)$/.test(name)) return 'fonts/[name][extname]'
          if (/\.(png|jpe?g|gif|svg|webp|avif)$/.test(name)) return 'img/[name][extname]'
          return 'assets/[name][extname]'
        },
      },
    },
  },
}))