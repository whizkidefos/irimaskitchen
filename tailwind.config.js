/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './templates/**/*.php',
    './inc/**/*.php',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        'irimas-blue': '#1F4E79',
        'irimas-red': '#D72638',
        'irimas-orange': '#F49D37',
        'irimas-green': '#3BB273',
        'irimas-cream': '#FDF6EC',
        'cream-light': 'rgba(253, 246, 236, 0.8)',
      },
      fontFamily: {
        'playfair': ['"Playfair Display"', 'serif'],
        'poppins': ['Poppins', 'sans-serif'],
        'sans': ['Poppins', 'sans-serif'],
      },
      container: {
        center: true,
        padding: '1rem',
      },
    },
  },
  plugins: [],
}