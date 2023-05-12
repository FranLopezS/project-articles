/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    require('flowbite/plugin'),
    "./node_modules/flowbite/**/*.js"
    // "./resources/**/*.js"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

