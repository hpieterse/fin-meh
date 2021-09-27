const colors = require('tailwindcss/colors')

module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      textColor: {
        'primary': colors.gray['800'],
        'secondary': colors.gray['600'],
        'danger': colors.red[500],
        'success': colors.green[500],
        'brand': '#FF4E08'
      },
      colors: {
        success: {
          DEFAULT: colors.green[500],
          active: colors.green[900],
        },
        danger: {
          DEFAULT: colors.red[500],
          active: colors.red[900],
        },
        primary: {
          DEFAULT: colors.gray[500],
          active: colors.gray[900],
        },
      }
    },
    fontFamily: {
      sans: ['Nunito', 'sans-serif'],
    },
    
  },
  variants: {
    extend: {
      margin: ['first'],
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
