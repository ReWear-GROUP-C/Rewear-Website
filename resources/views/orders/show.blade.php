@extends('layouts.app')
@section('title', 'Order #'.$order->id)

@section('content')
<div class="max-w-2xl mx-auto px-4 py-10">

    {{-- Header --}}
    <div class="mb-6">
        <p class="text-[11px] font-medium uppercase tracking-widest text-stone-400 mb-1">Order Flow</p>
        <h1 class="text-2xl font-bold text-stone-900">Order <span class="font-mono">#{{ $order->id }}</span></h1>
    </div>

    {{-- Status Pipeline --}}
    <div class="rounded-2xl bg-white border border-stone-200 p-5 mb-4">
        <p class="text-[11px] font-medium uppercase tracking-widest text-stone-400 mb-3">Status</p>
        <div class="flex items-center gap-2">
            @foreach(['pending', 'payment_confirmed', 'shipped', 'completed'] as $step)
                <div class="flex items-center gap-2 flex-1">
                    <div class="flex flex-col items-center">
                        <div class="w-3 h-3 rounded-full {{ $order->status === $step || (array_search($order->status, ['pending','payment_confirmed','shipped','completed']) >= array_search($step, ['pending','payment_confirmed','shipped','completed'])) ? 'bg-emerald-900' : 'bg-stone-200' }}"></div>
                        <p class="text-[9px] font-medium uppercase tracking-wide mt-1 {{ $order->status === $step ? 'text-emerald-900' : 'text-stone-400' }}">
                            {{ str_replace('_', ' ', $step) }}
                        </p>
                    </div>
                    @if(!$loop->last)
                        <div class="h-px flex-1 mb-3 {{ array_search($order->status, ['pending','payment_confirmed','shipped','completed']) > array_search($step, ['pending','payment_confirmed','shipped','completed']) ? 'bg-emerald-900' : 'bg-stone-200' }}"></div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{-- Item + Parties Grid --}}
    <div class="grid grid-cols-2 gap-4 mb-4">

        {{-- Item Card --}}
        <div class="rounded-2xl bg-white border border-stone-200 p-4">
            <p class="text-[11px] font-medium uppercase tracking-widest text-stone-400 mb-3">Item</p>
            <div class="flex gap-3">
                @if($order->item->first_photo)
                    <img src="{{ asset('storage/'.$order->item->first_photo) }}"
                         class="w-16 h-16 object-cover rounded-xl flex-shrink-0">
                @endif
                <div>
                    <p class="text-sm font-semibold text-stone-900 leading-snug mb-1">{{ $order->item->item_name }}</p>

                    {{-- Condition badge --}}
                    @if($order->item->condition === 'new_with_tags')
                        <span class="text-[10px] font-medium uppercase tracking-widest px-2 py-0.5 rounded-full bg-orange-100 text-orange-800">New With Tags</span>
                    @elseif($order->item->condition === 'like_new')
                        <span class="text-[10px] font-medium uppercase tracking-widest px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">Like New</span>
                    @else
                        <span class="text-[10px] font-medium uppercase tracking-widest px-2 py-0.5 rounded-full bg-stone-100 text-stone-500">{{ str_replace('_', ' ', $order->item->condition) }}</span>
                    @endif

                    <p class="text-sm font-bold text-emerald-900 mt-2">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Parties Card --}}
        <div class="rounded-2xl bg-white border border-stone-200 p-4 flex flex-col gap-4">
            <div>
                <p class="text-[11px] font-medium uppercase tracking-widest text-stone-400 mb-1">Buyer</p>
                <p class="text-sm font-semibold text-stone-900">{{ $order->buyer?->name }}</p>
            </div>
            <div>
                <p class="text-[11px] font-medium uppercase tracking-widest text-stone-400 mb-1">Seller</p>
                <p class="text-sm font-semibold text-stone-900">{{ $order->seller?->name }}</p>
            </div>
            @if($order->payment_reference)
            <div>
                <p class="text-[11px] font-medium uppercase tracking-widest text-stone-400 mb-1">Payment Ref</p>
                <p class="text-xs font-mono text-stone-600">{{ $order->payment_reference }}</p>
            </div>
            @endif
        </div>
    </div>

    {{-- CO2 Saved Badge --}}
    <div class="rounded-2xl bg-emerald-950 px-5 py-4 mb-4 flex items-center gap-3">
        <span class="w-2 h-2 rounded-full bg-emerald-400 flex-shrink-0"></span>
        <p class="text-emerald-300 text-sm font-medium tracking-wide">
            🌱 You saved <strong>{{ $order->co2_saved_amount }}kg CO2</strong> with this purchase!
        </p>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-wrap gap-3">
        @if(Auth::id() === $order->buyer_id && $order->status === 'pending')
            <a href="#"
               class="flex-1 flex items-center justify-center bg-emerald-900 hover:bg-emerald-800 text-white text-sm font-medium py-2.5 rounded-full transition-colors duration-200">
                Confirm Payment →
            </a>
        @endif

        @if(Auth::id() === $order->users_id && $order->status === 'payment_confirmed')
            <form method="POST" action="#" class="flex-1">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center bg-emerald-900 hover:bg-emerald-800 text-white text-sm font-medium py-2.5 rounded-full transition-colors duration-200">
                    Mark as Shipped
                </button>
            </form>
        @endif

        @if(Auth::id() === $order->buyer_id && $order->status === 'shipped')
            <form method="POST" action="#" class="flex-1">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center bg-emerald-900 hover:bg-emerald-800 text-white text-sm font-medium py-2.5 rounded-full transition-colors duration-200">
                    Confirm Received
                </button>
            </form>
        @endif

        <a href="#"
           class="flex items-center justify-center border border-stone-200 text-stone-600 hover:bg-stone-50 text-sm font-medium px-6 py-2.5 rounded-full transition-colors duration-200">
            All Transactions
        </a>
    </div>

</div>
@endsection