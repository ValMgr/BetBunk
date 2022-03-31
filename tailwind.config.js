module.exports = {
  content: [
    'templates/**/*.html.twig'
  ],
  theme: {
    container: {
      center: true,
    },
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms')
  ],
}
