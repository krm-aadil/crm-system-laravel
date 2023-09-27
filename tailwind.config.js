import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require("daisyui"),
        forms,
        typography,
    ],

    daisyui: {
        themes: [
            {
                mytheme: {
                    primary: '#8c0096',
                    secondary: '#d42dcc',
                    accent: '#c75eea',
                    neutral: '#064e3b',
                    'base-100': '#ffffff',
                    info: '#9c3af8',
                    success: '#36d399',
                    warning: '#fbbd23',
                    error: '#f87272',
                },
            },
        ],
    },
};
