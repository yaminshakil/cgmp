import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                brand: {
                    blue: '#04699f',
                    'blue-dark': '#03507d',
                    'blue-darker': '#023a58',
                    'blue-tint': '#eaf5fb',
                    'blue-vivid': '#0586ca',
                    red: '#cf3a3f',
                    'red-dark': '#a92e32',
                    'red-tint': '#fbeaea',
                },
                // Semantic text colors (replaces the ad-hoc #062238/#45627d... literals).
                ink: {
                    DEFAULT: '#062238',
                    soft: '#3b4a5a',
                    muted: '#45627d',
                    faint: '#60758d',
                },
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
            },
        },
    },

    plugins: [forms],
};
