const colors = require('tailwindcss/colors')

const round = (num) =>
    num
        .toFixed(7)
        .replace(/(\.[0-9]+?)0+$/, '$1')
        .replace(/\.0$/, '')
const rem = (px) => `${round(px / 16)}rem`
const em = (px, base) => `${round(px / base)}em`

module.exports = {
  prefix: '',
  content: {
    enabled: true,
    layers: ['components', 'utilities'],
    content: [
      './vendor/symfony/twig-bridge/Resources/views/Form/tailwind_2_layout.html.twig',
      './templates/**/*.html.twig',
      './assets/**/*.css',
      './assets/**/*.js',
      './assets/**/*.vue',
    ],
  },
  darkMode: 'class', // or 'media' or 'class'
  theme: {
    extend: {
      typography: (theme) => ({
        DEFAULT: {
          css: {
            // snip...
            blockquote: {
              fontSize: '150%',
              fontWeight: '500',
              fontStyle: 'italic',
              fontVariant: 'small-caps',
              color: theme('colors.gray.100'),
              borderLeftWidth: '0.0rem',
              // borderLeftColor: theme('colors.gray.200'),
              marginTop: em(0, 30),
              marginLeft: em(30, 30),
            },
            'blockquote:before': {
              fontSize: '4.5em',
              marginTop: em(-12, 30),
              marginLeft: em(-18, 30),
              color: '#919da7',
              position: 'absolute',
              fontFamily: 'Georgia, "Times New Roman", Times, serif',
              content: '"\\201C"',
              fontWeight: 'bold',
              fontStyle: 'normal',
            },
            'blockquote p:first-of-type::before': {
              content: '""',
            },
            'blockquote p:first-of-type::after': {
              content: '""',
            },
          },
        },
        sm: {
          css: {
            blockquote: {
              marginTop: em(0, 30),
              marginLeft: em(24, 30),
            },
            'blockquote:before': {
              fontSize: '4.5em',
              marginTop: em(-12, 30),
              marginLeft: em(-18, 30),
            },
          },
        },
        lg: {
          css: {
            blockquote: {
              marginTop: em(0, 30),
              marginLeft: em(24, 30),
            },
            'blockquote:before': {
              fontSize: '4.5em',
              marginTop: em(-12, 30),
              marginLeft: em(-18, 30),
            },
          },
        },
        xl: {
          css: {
            blockquote: {
              marginTop: em(0, 30),
              marginLeft: em(28, 30),
            },
            'blockquote:before': {
              fontSize: '4.5em',
              marginTop: em(-12, 30),
              marginLeft: em(-18, 30),
            },
          },
        },
        '2xl': {
          css: {
            blockquote: {
              marginTop: em(0, 0),
              marginLeft: em(24, 30),
            },
            'blockquote:before': {
              fontSize: '4.5em',
              marginTop: em(-12, 30),
              marginLeft: em(-18, 30),
            },
          },
        },
      }),
    },
  },
  variants: {
    fill: ['hover', 'focus'],
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}