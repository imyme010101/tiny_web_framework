const colors = require('tailwindcss/colors')

module.exports = {
  content: [
    "./views/**/*.{php,html,js,vue}",
    "./components/**/*.{php,html,js,vue}"
  ],
  theme: {
    colors: {
      'point1': '#FFAD4E',
      black: colors.black,
      white: colors.white,
      gray: colors.slate,
      green: colors.emerald,
      purple: colors.violet,
      yellow: colors.amber,
      pink: colors.fuchsia,
      violet: colors.violet
    },
    extend: {},
  },
  plugins: [],
}
