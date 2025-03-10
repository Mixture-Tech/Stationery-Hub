import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './resources/views',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Instrument Sans"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'soft-gray': '#E8EFF5',
                'mint-green': '#D1F8EF',
                'light-blue': '#A1E3F9',
                'medium-blue': '#578FCA',
                'dark-blue': '#3674B5',
                'navy-blue': '#1B4B82',
                // Shorthands
                'mint': '#D1F8EF',
                'navy': '#1B4B82',
            },
        },
    },

    plugins: [forms],
};