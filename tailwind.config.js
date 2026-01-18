import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
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
                brand: {
                    blue: '#0954B8',
                    sky: '#38B6FF',
                    yellow: '#FFBD59',
                    orange: '#FF914D',
                }
            },
            backgroundImage: {
                'gradient-ocean': 'linear-gradient(to bottom right, #38B6FF, #0954B8)',
                'gradient-sunset': 'linear-gradient(to bottom right, #FFBD59, #FF914D)',
            },
        },
    },

    plugins: [forms],
};
