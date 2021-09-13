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
        'brand': '#FF4E08'
      }
    },
    fontFamily: {
      sans: ['Nunito', 'sans-serif'],
    },
    
  },
  variants: {
    extend: {
    },
  },
  plugins: [],
}
