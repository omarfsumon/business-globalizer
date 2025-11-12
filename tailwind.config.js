/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './inc/**/*.php',
    './template-parts/**/*.php',
    './components/**/*.php',
    './src/**/*.js',
    './src/**/*.css',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      fontFamily: {
        'inter': ['inter', 'sans-serif'],
      },
      colors: {
        primary: '#2563eb',   // Blue-600
        secondary: '#22c55e', // Amber-500
        accent: '#3b76f6',    // Blue-500
        'blue': {
          '50': '#eff4ff',
          '100': '#dbe6fe',
          '200': '#bfd3fe',
          '300': '#93b4fd',
          '400': '#6090fa',
          '500': '#3b76f6',
          '600': '#2563eb',
          '700': '#1d58d8',
          '800': '#1e4baf',
          '900': '#1e408a',
          '950': '#172a54',
        },
      },
    },
  },
  plugins: [
  ],
};