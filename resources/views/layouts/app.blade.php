<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ReWear') }} — ReWear</title>
    <meta name="description" content="ReWear — Circular fashion platform for sustainable consumption.">

    {{-- Google Fonts: Manrope (headlines) + Inter (body/label) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')

    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Manrope', system-ui, sans-serif; }
    </style>
</head>
<body style="background-color:#F5F5F2;color:#1A2820;">

    {{-- Navigation --}}
    <header style="background:#ffffff;border-bottom:1px solid #E2E2DE;position:sticky;top:0;z-index:50;">
        <div style="max-width:1100px;margin:auto;padding:0 24px;height:64px;display:flex;align-items:center;justify-content:space-between;gap:16px;">
            {{-- Logo --}}
            <a href="{{ route('dashboard') }}" style="text-decoration:none;flex-shrink:0;display:flex;align-items:center;gap:2px;">
                <span style="font-family:'Manrope',sans-serif;font-size:1.375rem;font-weight:800;color:#2D4739;letter-spacing:-0.02em;">Re</span><span style="font-family:'Manrope',sans-serif;font-size:1.375rem;font-weight:800;color:#D98364;letter-spacing:-0.02em;">Wear</span>
            </a>

            {{-- Nav Tabs --}}
            <nav class="nav-pill-group">
                <a href="{{ route('dashboard') }}" class="nav-pill {{ request()->routeIs('marketplace.*','items.*') ? 'active' : '' }}">Marketplace</a>
                <a href="{{ route('dashboard') }}" class="nav-pill {{ request()->routeIs('community.*') ? 'active' : '' }}">Komunitas</a>
                @auth
                <a href="{{ route('dashboard') }}" class="nav-pill {{ request()->routeIs('favorites.*') ? 'active' : '' }}">Tersimpan</a>
                <a href="{{ route('dashboard') }}" class="nav-pill {{ request()->routeIs('transactions.*') ? 'active' : '' }}">Pesanan</a>
                @endauth
            </nav>

            {{-- Auth --}}
            <div style="display:flex;align-items:center;gap:8px;flex-shrink:0;">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary" style="padding:0.375rem 0.75rem;font-size:0.8125rem;">⚙ Admin</a>
                    @endif
                    <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:8px;text-decoration:none;color:#1A2820;font-size:0.875rem;font-weight:500;">
                        <span style="width:30px;height:30px;border-radius:50%;background:#EBF0EC;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:#2D4739;border:1.5px solid #C5D5CD;">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                        <span style="max-width:100px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ Auth::user()->name }}</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn btn-secondary" style="padding:0.375rem 0.75rem;font-size:0.8125rem;">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-pill">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary" style="padding:0.4375rem 1rem;font-size:0.875rem;">Daftar</a>
                @endauth
            </div>
        </div>
    </header>

    {{-- Flash Messages --}}
    <div style="max-width:1100px;margin:0 auto;padding:0 24px;">
        @foreach(['success','error','info'] as $type)
            @if(session($type))
                <div class="flash-base flash-{{ $type }} animate-fade-up" style="margin-top:1rem;">
                    @if($type==='success') ✓ @elseif($type==='error') ✗ @else ℹ @endif {{ session($type) }}
                </div>
            @endif
        @endforeach
    </div>

    {{-- Page Heading --}}
    @isset($header)
        <div style="max-width:1100px;margin:0 auto;padding:1.5rem 24px 0;">
            <div style="background:#ffffff;border-radius:12px;padding:1.25rem 1.5rem;border:1px solid #E2E2DE;">
                {{ $header }}
            </div>
        </div>
    @endisset

    {{-- Page Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer style="background:#2D4739;color:rgba(255,255,255,0.65);margin-top:5rem;padding:3.5rem 24px 2rem;">
        <div style="max-width:1100px;margin:auto;">
            <div style="display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:2.5rem;margin-bottom:2.5rem;">
                {{-- Brand --}}
                <div>
                    <div style="display:flex;align-items:center;gap:2px;margin-bottom:0.75rem;">
                        <span style="font-family:'Manrope',sans-serif;font-size:1.25rem;font-weight:800;color:#fff;">Re</span><span style="font-family:'Manrope',sans-serif;font-size:1.25rem;font-weight:800;color:#D98364;">Wear</span>
                    </div>
                    <p style="font-size:0.875rem;line-height:1.65;max-width:220px;color:rgba(255,255,255,0.6);">Platform fashion sirkular yang membantu kamu menjual dan membeli pakaian preloved berkualitas.</p>
                </div>
                {{-- Explore --}}
                <div>
                    <p style="font-family:'Manrope',sans-serif;font-size:0.8125rem;font-weight:700;color:#fff;margin-bottom:0.75rem;letter-spacing:0.04em;text-transform:uppercase;">Eksplorasi</p>
                    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:0.5rem;font-size:0.875rem;">
                        <li><a href="{{ route('dashboard') }}" style="color:rgba(255,255,255,0.6);text-decoration:none;">Marketplace</a></li>
                        <li><a href="{{ route('dashboard') }}" style="color:rgba(255,255,255,0.6);text-decoration:none;">Komunitas</a></li>
                        @auth<li><a href="{{ route('dashboard') }}" style="color:rgba(255,255,255,0.6);text-decoration:none;">Jual Barang</a></li>@endauth
                    </ul>
                </div>
                {{-- Legal --}}
                <div>
                    <p style="font-family:'Manrope',sans-serif;font-size:0.8125rem;font-weight:700;color:#fff;margin-bottom:0.75rem;letter-spacing:0.04em;text-transform:uppercase;">Legal</p>
                    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:0.5rem;font-size:0.875rem;">
                        <li><span style="color:rgba(255,255,255,0.6);">Kebijakan Layanan</span></li>
                        <li><span style="color:rgba(255,255,255,0.6);">Kebijakan Privasi</span></li>
                        <li><span style="color:rgba(255,255,255,0.6);">Panduan Penjual</span></li>
                    </ul>
                </div>
                {{-- Newsletter --}}
                <div>
                    <p style="font-family:'Manrope',sans-serif;font-size:0.8125rem;font-weight:700;color:#fff;margin-bottom:0.75rem;letter-spacing:0.04em;text-transform:uppercase;">Newsletter</p>
                    <p style="font-size:0.8125rem;color:rgba(255,255,255,0.6);margin-bottom:0.75rem;">Tips gaya hidup berkelanjutan.</p>
                    <div style="display:flex;gap:8px;">
                        <input type="email" placeholder="Email anda" style="flex:1;padding:0.5rem 0.75rem;border-radius:8px;border:1.5px solid rgba(255,255,255,0.15);background:rgba(255,255,255,0.08);color:#fff;font-family:'Inter',sans-serif;font-size:0.875rem;outline:none;min-width:0;">
                        <button style="width:36px;height:36px;border-radius:8px;background:#D98364;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </button>
                    </div>
                </div>
            </div>
            <div style="border-top:1px solid rgba(255,255,255,0.1);padding-top:1.5rem;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:0.5rem;">
                <p style="font-size:0.8125rem;color:rgba(255,255,255,0.4);">© 2025 ReWear Indonesia — Group C</p>
                <p style="font-size:0.8125rem;color:rgba(255,255,255,0.35);">Laravel 12 · Sprint 1</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
