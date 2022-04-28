const colors = require('tailwindcss/colors');

module.exports = {
  content: [
    'templates/**/*.html.twig'
  ],
  theme: {
    container: {
      center: true,
    },
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.gray,
      zinc: colors.zinc,
      neutral: colors.neutral,
      stone: colors.stone,
      emerald: colors.emerald,
      indigo: colors.indigo,
      slate: colors.slate,
      smoke: colors.smoke,
      orange: colors.orange,
      amber: colors.amber,
      green: colors.green,
      teal: colors.teal,
      pink: colors.pink,
      yellow: {
        100: '#FFBC4D',
        200: '#FFB233',
        300: '#FFA91A',
        400: '#FFA91A',
        500: '#FF9F00',
        600: '#E68F00',
        700: '#CC7F00',
        800: '#B36F00',
        900: '#995F00',
      },
      byzantine: {
        100: '#9767AA',
        200: '#864E9C',
        300: '#75358D',
        400: '#631B7F',
        500: '#520271',
        600: '#4A0266',
        700: '#42025A',
        800: '#39014F',
        900: '#310144',
      },
      red: {
        100: '#B25B5B',
        200: '#B25B5B',
        300: '#A74444',
        400: '#9C2C2C',
        500: '#911515',
        600: '#831313',
        700: '#741111',
        800: '#660F0F',
        900: '#570D0D',
      },
      dark: {
        '100': '#565d69',
        '200': '#3d4654',
        '300': '#252f3e',
        '400': '#0d1829',
        '500': '#0c1625',
        '600': '#0a1321',
        '700': '#09111d',
        '800': '#080e19',
        '900': '#070c15',
      }
    },
    extend: {},
  },
  darkMode: 'class',
  plugins: [
    require('@tailwindcss/forms')
  ],
}
