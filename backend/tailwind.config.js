/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
    theme: {
        extend: {
            keyframes: {
                "fade-in": {
                    from: {
                        opacity: "0",
                    },
                    to: {
                        opacity: "1",
                    },
                },
            },
            animation: {
                "fade-in": "fade-in 0.2s ease-in-out both",
            },
        },
        plugins: [require("@tailwindcss/forms")],
    },
};
