/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                main: {
                    '900': '#1C1E21',
                    '800': '#222427',
                    '700': '#26292D',
                    '500': '#2C2F33',
                    '300': '#35383D',
                },
                'primary': '#31363D'
            },
        },
    },
    plugins: [],
}
