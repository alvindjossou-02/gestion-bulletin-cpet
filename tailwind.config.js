import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: false,
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                cpet: {
                    primary: '#1E40AF',      // Bleu principal (logo)
                    secondary: '#22C55E',    // Vert secondaire (logo)
                    dark: '#0369A1',         // Bleu foncé (logo)
                    accent: '#84CC16',       // Vert lime (accent)
                    light: '#DBEAFE',        // Bleu clair
                },
            },
        },
    },

    plugins: [forms],
};
