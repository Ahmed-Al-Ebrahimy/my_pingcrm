const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
          fontFamily: {
            sans: ['Cerebri Sans', ...defaultTheme.fontFamily.sans],
            "maven": ['Maven Pro', 'sans-serif'],
          },
          colors: {
            indigo: {
              '900': '#191e38',
              '800': '#2f365f',
              '600': '#5661b3',
              '500': '#6574cd',
              '400': '#7886d7',
              '300': '#b2b7ff',
              '100': '#e6e8ff',
            },

            banafsagy: {
                '900': 'rgb(53, 70, 127)',
                '800': 'rgb(71, 86, 140)',
                '600': 'rgb(128, 140, 178)',
              },
              samaee: {
                '900': 'rgb(100, 225, 220)',
                '800': 'rgb(187, 220, 255)',
              }

          },
          boxShadow: theme => ({
            outline: '0 0 0 3px ' + theme('colors.indigo.500'),
          }),
          fill: theme => theme('colors'),
        },
      },
      variants: {
        fill: ['responsive', 'hover', 'focus', 'group-hover'],
        textColor: ['responsive', 'hover', 'focus', 'group-hover'],
        zIndex: ['responsive', 'focus'],
        borderWidth: ['responsive', 'hover', 'focus', 'focus-within'],
        borderColor: ['responsive', 'hover', 'focus'],
      },

    plugins: [require('@tailwindcss/ui')],
};
