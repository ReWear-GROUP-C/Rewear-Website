<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ReWear') }}</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,900&family=DM+Sans:wght@400;500;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body style="min-height:100vh;background:var(--color-canvas);font-family:'DM Sans',system-ui,sans-serif;display:flex;flex-direction:column;align-items:center;justify-content:center;">


    <div style="margin-bottom:2rem;text-align:center;">
        <a href="{{ route('dashboard') }}" style="text-decoration:none;">
            <span style="font-family:'Playfair Display',serif;font-size:2rem;font-weight:900;color:var(--color-primary-900);">Re</span><span style="font-family:'Playfair Display',serif;font-size:2rem;font-weight:900;color:var(--color-accent-500);">Wear</span>
        </a>
        <p style="font-family:'JetBrains Mono',monospace;font-size:0.625rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--color-text-muted);margin-top:4px;">Circular Fashion Platform</p>
    </div>


    <div style="width:100%;max-width:420px;background:var(--color-surface);border:1px solid var(--color-border);border-radius:16px;padding:2rem;box-shadow:0 8px 32px rgba(27,67,50,0.08);">

        <div style="height:3px;background:linear-gradient(90deg,var(--color-primary-900),var(--color-accent-500));border-radius:3px;margin:-2rem -2rem 1.5rem -2rem;width:calc(100% + 4rem);"></div>

        {{ $slot }}
    </div>

    {{-- Footer link --}}
    <p style="margin-top:1.5rem;font-size:0.8125rem;color:var(--color-text-muted);">
        <a href="{{ route('dashboard') }}" style="color:var(--color-primary-700);text-decoration:none;">← Back to homepage</a>
    </p>

</body>
</html>
