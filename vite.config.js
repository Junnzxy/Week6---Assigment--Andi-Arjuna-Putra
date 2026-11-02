import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
    ],
    build: {
        outDir: 'public/css',
        rollupOptions: {
            input: {
                app: 'resources/css/app.css',
            },
            output: {
                assetFileNames: '[name][extname]',
            }
        }
    }
});

