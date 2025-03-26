/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.blade.php",   // Todos los archivos Blade (plantillas de Laravel)
    "./resources/js/**/*.js",             // Todos los archivos JavaScript
    "./resources/css/**/*.css",           // Todos los archivos CSS si es que tienes archivos adicionales CSS
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
