const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'bg-semi-75': 'rgba(0, 0, 0, 0.75)',

                primary: {
                    500: '#F8FF01'
                },
            },

            backgroundImage: {
                'back' : "url(https://st4.depositphotos.com/39002138/i/600/depositphotos_409022534-stock-photo-shopping-basket-filled-fruits-vegetables.jpg)",
            }
            },

    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
