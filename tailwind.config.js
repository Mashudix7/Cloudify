/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./application/views/**/*.php", "./application/views/**/*.html"],
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        "primary": "#3bb2f7",
        "primary-dark": "#2a93d5",
        "background-light": "#f1f5f9",
        "background-dark": "#1d293a",
      },
      fontFamily: {
        "display": ["Inter", "sans-serif"],
        "sans": ["Inter", "sans-serif"],
      },
      borderRadius: {
        "DEFAULT": "0.5rem",
        "lg": "1rem",
        "xl": "1.5rem",
        "2xl": "2rem",
        "3xl": "2.5rem",
        "full": "9999px"
      },
      backgroundImage: {
        'hero-gradient': 'linear-gradient(135deg, #38BDF8 0%, #3B82F6 100%)',
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/container-queries'),
  ],
}
