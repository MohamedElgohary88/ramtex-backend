import preset from './vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            borderRadius: {
                'lg': '0.6rem',
                'xl': '0.8rem',
                '2xl': '1rem',
            }
        }
    }
}
