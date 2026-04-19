<div class="rounded-2xl overflow-hidden bg-white border border-stone-200 hover:-translate-y-0.5 transition-transform duration-200 cursor-pointer">

    {{-- Image --}}
    <div class="relative" style="aspect-ratio:3/4;">
        @if($item->first_photo)
            <img src="{{ asset('storage/'.$item->first_photo) }}"
                 alt="{{ $item->item_name }}"
                 class="w-full h-full object-cover">
        @else
            <img src="/placeholder.jpg"
                 alt="{{ $item->item_name }}"
                 class="w-full h-full object-cover">
        @endif

        {{-- CO2 badge --}}
        <div class="absolute top-2.5 left-2.5 flex items-center gap-1.5 bg-emerald-950 text-emerald-300 text-[11px] font-medium px-3 py-1 rounded-full tracking-wide">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 flex-shrink-0"></span>
            SAVED {{ (float) $item->category?->co2_constant?? '0' }}KG CO2
        </div>

        
    </div>

    {{-- Body --}}
    <div class="px-3.5 py-3">
        <div class="flex items-baseline justify-between gap-2 mb-1">
            <a href="#"
               class="text-sm font-medium text-stone-900 leading-snug hover:text-emerald-900 transition-colors line-clamp-2">
                {{ $item->item_name }}
            </a>
            <span class="text-sm font-medium text-stone-900 whitespace-nowrap">
                Rp {{ number_format($item->price, 0, ',', '.') }}
            </span>
        </div>

        <p class="text-xs text-stone-400 mb-2">
            {{ $item->user?->city ?? 'Indonesia' }} &middot; Size {{ $item->size ?? '—' }}
        </p>

        {{-- Collection tag --}}
        @if($item->condition === 'new_with_tags')
            <span class="text-[10px] font-medium uppercase tracking-widest px-2 py-0.5 rounded-full bg-orange-100 text-orange-800">New With Tags</span>
        @elseif($item->condition === 'like_new')
            <span class="text-[10px] font-medium uppercase tracking-widest px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">Like New</span>
        @else
            <span class="text-[10px] font-medium uppercase tracking-widest px-2 py-0.5 rounded-full bg-stone-100 text-stone-500">{{ str_replace('_', ' ', $item->condition) }}</span>
        @endif
    </div>
</div>