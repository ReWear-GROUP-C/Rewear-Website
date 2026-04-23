@extends('layouts.app')
@section('title', 'Profile')

@section('content')
<div class="py-12 max-w-[900px] mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-stone-900 mb-2">My Profile</h1>
        <p class="text-stone-500 font-medium">Manage your account and view your environmental impact.</p>
    </div>

    <div class="space-y-8">
        
        <div class="p-6 sm:p-8 bg-emerald-950 shadow-lg sm:rounded-2xl text-emerald-50 relative overflow-hidden">
            <div class="absolute top-0 right-0 opacity-10 transform translate-x-1/4 -translate-y-1/4">
                <span class="material-symbols-outlined text-[160px] text-emerald-300">eco</span>
            </div>
            <div class="relative z-10 max-w-xl">
                <h3 class="text-sm font-bold uppercase tracking-widest text-emerald-300">
                    Lifetime Environmental Impact
                </h3>
                <p class="mt-2 text-sm text-emerald-200/80 leading-relaxed">
                    Thank you for championing the circular economy. This is the total CO₂ saved across all your pre-loved purchases.
                </p>
                <div class="mt-6 flex items-baseline gap-2">
                    <span class="text-5xl font-black text-white">{{ number_format($totalCo2Saved, 2) }}</span>
                    <span class="text-xl font-bold text-emerald-300">kg CO₂</span>
                </div>
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white shadow-sm sm:rounded-2xl border border-stone-200">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white shadow-sm sm:rounded-2xl border border-stone-200">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white shadow-sm sm:rounded-2xl border border-stone-200">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection