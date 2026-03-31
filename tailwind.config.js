import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                // Figtree é moderna e limpa, ótima para a área administrativa [cite: 3]
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Cores baseadas na identidade visual do portfólio [cite: 1, 3]
                brand: {
                    '50': '#f0f7ff',
                    '100': '#e0effe',
                    '500': '#3b82f6', // Azul para destaques e botões
                    '900': '#0f172a', // Azul Marinho profundo para o Hero e cabeçalhos
                },
            },
        },
    },

    plugins: [forms],
};