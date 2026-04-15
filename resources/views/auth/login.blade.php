<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | ReWear</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#173124",
                        "secondary": "#924a2f",
                        "surface": "#f9f9f6",
                        "surface-container-highest": "#e2e3e0",
                        "on-surface": "#1a1c1b",
                        "on-surface-variant": "#424844",
                        "primary-fixed": "#ccead6",
                        "primary-fixed-dim": "#b0cdbb",
                        "error": "#ba1a1a",
                    },
                    fontFamily: {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            },
        }
    </script>
    <style>
        .bg-archive-hero {
            background-image: linear-gradient(rgba(23, 49, 36, 0.4), rgba(23, 49, 36, 0.4)), url('https://images.unsplash.com/photo-1558769132-cb1aea458c5e?q=80&w=2000&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased">

<main class="min-h-screen flex flex-col md:flex-row">
    <section class="hidden md:flex md:w-1/2 lg:w-3/5 bg-archive-hero relative items-center justify-center p-12 overflow-hidden">
        <div class="relative z-10 max-w-xl text-white">
            <div class="mb-8">
                <span class="text-primary-fixed uppercase tracking-[0.2em] font-label text-sm font-semibold">EST. 2024</span>
            </div>
            <h1 class="font-headline font-extrabold text-5xl lg:text-7xl leading-tight tracking-tighter mb-6">
                Welcome Back to the Archive
            </h1>
            <p class="font-body text-lg max-w-md opacity-90">
                Reconnecting you with timeless stories and sustainable fashion heritage. Your next chapter begins here.
            </p>
        </div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-primary/20 blur-[120px] rounded-full"></div>
    </section>

    <section class="flex-1 flex flex-col justify-center items-center px-6 py-12 md:px-12 lg:px-20 bg-surface">
        <div class="w-full max-w-md">
            <div class="md:hidden flex justify-center mb-12">
                <h2 class="text-3xl font-headline font-bold text-primary tracking-tighter">ReWear</h2>
            </div>

            <div class="mb-10 text-center md:text-left">
                <h2 class="text-3xl font-headline font-bold text-primary mb-2">Sign In</h2>
                <p class="text-on-surface-variant font-body">Enter your details to access your curated wardrobe.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="space-y-1.5">
                    <label class="block font-label text-sm font-medium text-on-surface-variant" for="email">Email Address</label>
                    <input class="w-full px-4 py-3 bg-stone-100 border-none rounded-lg focus:ring-2 focus:ring-primary/20 text-on-surface transition-all"
                           id="email" name="email" type="email" value="{{ old('email') }}" required autofocus placeholder="name@archive.com" />
                    @error('email')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5 relative">
                    <div class="flex justify-between items-center">
                        <label class="block font-label text-sm font-medium text-on-surface-variant" for="password">Password</label>
                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-secondary hover:underline" href="{{ route('password.request') }}">Forgot password?</a>
                        @endif
                    </div>
                    <input class="w-full px-4 py-3 bg-stone-100 border-none rounded-lg focus:ring-2 focus:ring-primary/20 text-on-surface transition-all"
                           id="password" name="password" type="password" required autocomplete="current-password" placeholder="••••••••" />
                    @error('password')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3">
                    <input class="w-4 h-4 text-primary border-stone-300 rounded focus:ring-primary" id="remember_me" name="remember" type="checkbox"/>
                    <label class="font-label text-sm text-on-surface-variant cursor-pointer" for="remember_me">Keep me signed in</label>
                </div>

                <button class="w-full py-4 bg-primary text-white font-headline font-bold rounded-full shadow-lg hover:bg-emerald-900 transition-all active:scale-[0.98]" type="submit">
                    Sign In
                </button>
            </form>

            <div class="relative my-10">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-stone-200"></div></div>
                <div class="relative flex justify-center text-sm uppercase"><span class="bg-surface px-4 text-stone-400 font-bold text-[10px] tracking-widest">Or continue with</span></div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <button class="flex items-center justify-center gap-2 py-3 border border-stone-200 rounded-full hover:bg-stone-50 transition-colors">
                    <svg class="w-5 h-5 grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-300" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    <span class="text-sm font-semibold">Google</span>
                </button>
                <button class="flex items-center justify-center gap-2 py-3 border border-stone-200 rounded-full hover:bg-stone-50 transition-colors">
                    <svg class="w-5 h-5 text-on-surface-variant opacity-70 group-hover:text-on-surface group-hover:opacity-100 transition-all duration-300" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.71 19.5C17.88 20.74 17 21.95 15.66 21.97C14.32 22 13.89 21.18 12.37 21.18C10.84 21.18 10.37 21.95 9.09997 22C7.78997 22.05 6.79997 20.68 5.95997 19.47C4.24997 17 2.93997 12.45 4.69997 9.39C5.56997 7.87 7.12997 6.91 8.81997 6.88C10.1 6.86 11.32 7.75 12.11 7.75C12.89 7.75 14.37 6.68 15.92 6.84C16.57 6.87 18.39 7.1 19.56 8.82C19.47 8.88 17.39 10.1 17.41 12.63C17.44 15.65 20.06 16.66 20.09 16.67C20.06 16.74 19.67 18.11 18.71 19.5ZM13 3.5C13.73 2.67 14.94 2.04 15.94 2C16.07 3.17 15.6 4.35 14.9 5.19C14.21 6.04 13.07 6.7 11.95 6.61C11.8 5.46 12.36 4.26 13 3.5Z" fill="currentColor"/>
                    </svg>
                    <span class="text-sm font-semibold">Apple</span>
                </button>
            </div>

            <p class="mt-12 text-center text-on-surface-variant font-body text-sm">
                New to the Archive?
                <a class="font-bold text-primary underline underline-offset-4" href="{{ route('register') }}">Join ReWear</a>
            </p>
        </div>
    </section>
</main>

<footer class="md:fixed md:bottom-8 md:right-12 text-center md:text-right p-6 md:p-0">
    <p class="text-[10px] text-stone-400 font-label uppercase tracking-widest">
        © 2024 ReWear. The Living Archive of Fashion.
    </p>
</footer>

</body>
</html>
