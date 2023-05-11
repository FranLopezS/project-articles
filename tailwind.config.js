/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    require('flowbite/plugin')
    // "./resources/**/*.js"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

