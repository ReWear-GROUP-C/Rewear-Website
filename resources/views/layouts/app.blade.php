<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ReWear | @yield('title', 'Marketplace')</title>

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>
    @stack('styles')
    @vite(['resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <script>
        tailwind.config = { 
            theme: {
                extend: {
                    colors: { 
                        primary: "#173124", 
                        secondary: "#924a2f", 
                        surface: "#f9f9f6" 
                    },
                    fontFamily: { 
                        headline: ["Manrope"], 
                        body: ["Inter"] 
                    }
                }
            }
        }
    </script>
</head>
<body style="background-color:#F5F5F2;color:#1A2820;">

    {{-- Navigation --}}
    @include('layouts.navigation')

    {{-- Page Content --}}
    <main class="pt-24 min-h-screen px-10">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="w-full py-12 px-6 mt-20 bg-stone-100 border-t border-stone-200">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 max-w-screen-2xl mx-auto text-sm">
            <div class="space-y-4">
                <span class="font-headline font-bold text-emerald-900 text-xl">ReWear</span>
                <p class="text-stone-500 leading-relaxed">Preserving the history of craftsmanship through circular fashion.</p>
            </div>
            <div class="space-y-4">
                <h4 class="font-bold text-primary uppercase tracking-widest text-xs">Resources</h4>
                <nav class="flex flex-col space-y-2 text-stone-500">
                    <a href="#" class="hover:text-primary">Repair Guides</a>
                    <a href="#" class="hover:text-primary">Sustainability Impact</a>
                </nav>
            </div>
            <div class="space-y-4">
                <h4 class="font-bold text-primary uppercase tracking-widest text-xs">Platform</h4>
                <nav class="flex flex-col space-y-2 text-stone-500">
                    <a href="#" class="hover:text-primary">Terms of Service</a>
                    <a href="#" class="hover:text-primary">Privacy Policy</a>
                </nav>
            </div>
            <div class="space-y-4">
                <h4 class="font-bold text-primary uppercase tracking-widest text-xs">Newsletter</h4>
                <div class="flex gap-2">
                    <input class="bg-white border border-stone-200 rounded-full px-4 py-2 text-xs flex-1 outline-none focus:ring-1 focus:ring-primary" placeholder="email@example.com" type="email"/>
                    <button class="bg-primary text-white px-4 py-2 rounded-full text-xs font-bold">Join</button>
                </div>
            </div>
        </div>
        <div class="mt-12 text-center text-[10px] text-stone-400 font-label uppercase tracking-widest">
            © 2026 ReWear. The Living Archive of Fashion.
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
