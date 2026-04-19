@extends('layouts.app')
@section('content')
<section>
    @if($items->isEmpty())
        <div style="text-align:center;padding:4rem;color:var(--color-text-muted);">
            <p style="font-size:3rem;">🧺</p>
            <p style="font-size:1.0625rem;margin-top:1rem;">No items match your filters.</p>
            <a href="{{ route('marketplace.index') }}" class="btn btn-secondary" style="margin-top:1rem;">Clear filters</a>
        </div>
    @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1.125rem;">
            @foreach($items as $i => $item)
                <x-item-card :item="$item" />
            @endforeach
        </div>
        
    @endif
</section>
@endsection