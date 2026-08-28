<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suitable Sow - Premium Plant Intelligence</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: '#0B2516',
                        emerald_deep: '#113F25',
                        sage_light: '#F4F7F5',
                        gold_accent: '#D4AF37'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-sage_light font-sans text-stone-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- Header / Navigation -->
    <header class="w-full max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <!-- Minimalist Leaf Logo Icon -->
            <svg class="w-8 h-8 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.344l-.707-.707M12 5a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span class="text-xl font-bold tracking-wide text-forest">Suitable<span class="text-emerald-600 font-medium">Sow</span></span>
        </div>
        
        <div>
            <a href="{{ route('register') }}" class="text-sm font-medium text-emerald-800 hover:text-emerald-600 transition duration-300">
                Sign Up
            </a>
        </div>
    </header>

    <!-- Hero / Main Content Section -->
    <main class="flex-grow flex items-center justify-center px-6 py-12">
        <div class="max-w-4xl mx-auto text-center space-y-8">
            
            <!-- Premium Tag -->
            <div class="inline-flex items-center space-x-2 bg-emerald-100/60 border border-emerald-200/50 px-4 py-1.5 rounded-full backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                <span class="text-xs font-semibold tracking-wider uppercase text-emerald-800">Smart Plant Analytics</span>
            </div>

            <!-- Main Heading -->
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-forest leading-[1.1]">
                Cultivate with <br>
                <span class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-teal-700 bg-clip-text text-transparent">
                    Absolute Certainty.
                </span>
            </h1>

            <!-- Subtitle -->
            <p class="max-w-2xl mx-auto text-lg md:text-xl text-stone-600 leading-relaxed font-light">
                Discover the precise suitability of your soil, climate, and environment. Suitable Sow bridges data and nature to ensure your crops and plants thrive.
            </p>

            <!-- CTA Button Area -->
            <div class="pt-4 flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ route('login') }}" class="group relative inline-flex items-center justify-center px-8 py-4 font-semibold text-white transition-all duration-300 bg-forest rounded-xl hover:bg-emerald_deep shadow-xl shadow-emerald-900/10 hover:shadow-emerald-900/20 w-full sm:w-auto">
                    <span>Log In</span>
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>

            <!-- Subtle Feature Highlights -->
            <div class="pt-16 grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-3xl mx-auto text-left border-t border-stone-200/60">
                <div class="space-y-1">
                    <h3 class="text-sm font-semibold text-forest uppercase tracking-wider">01 / Soil Mapping</h3>
                    <p class="text-sm text-stone-500">Advanced composition compatibility metrics.</p>
                </div>
                <div class="space-y-1">
                    <h3 class="text-sm font-semibold text-forest uppercase tracking-wider">02 / Microclimate Tech</h3>
                    <p class="text-sm text-stone-500">Hyper-local weather forecasting for growth cycles.</p>
                </div>
                <div class="space-y-1">
                    <h3 class="text-sm font-semibold text-forest uppercase tracking-wider">03 / Yield Optimization</h3>
                    <p class="text-sm text-stone-500">Data-driven insights to maximize your harvest potential.</p>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full max-w-7xl mx-auto px-6 py-8 text-center text-xs text-stone-400 tracking-wide border-t border-stone-200/30">
        &copy; {{ date('Y') }} Suitable Sow. Architectural Plant Intelligence. All rights reserved.
    </footer>

</body>
</html>