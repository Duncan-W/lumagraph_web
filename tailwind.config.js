/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          "50": "#eff6ff",
          "100": "#dbeafe",
          "200": "#bfdbfe",
          "300": "#93c5fd",
          "400": "#60a5fa",
          "500": "#3b82f6",
          "600": "#2563eb",
          "700": "#1d4ed8",
          "800": "#1e40af",
          "900": "#1e3a8a",
        },
      },
      typography: (theme) => ({
        DEFAULT: {
          css: {
            code: {
              color: theme('colors.gray.800'), // Default code color in light mode
            },
          },
        },
        dark: {
          css: {
            color: theme('colors.white'), // Default prose text color in dark mode
            code: {
              color: theme('colors.white'), // Make <code> text white in dark mode
            },
          },
        },
      }),
      spacing: {
        prosePadding: '10rem', // Add custom spacing value for prose padding
      },
    },
  },
  plugins: [require('@tailwindcss/typography')],
  variants: {
    extend: {
      typography: ['responsive', 'dark'], // Enable responsive typography and dark mode
    },
  },
  corePlugins: {
    container: false, // Optional: Disable container plugin if not used
  },
};
