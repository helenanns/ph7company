import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
	build: {
		manifest: true,
		outDir: 'dist',
		rollupOptions: {
			input: {
				main: path.resolve(__dirname, 'src/js/main.js'),
				home: path.resolve(__dirname, 'src/js/home.js'),
				single: path.resolve(__dirname, 'src/js/single-product.js'),
			},
		},
	},
});
