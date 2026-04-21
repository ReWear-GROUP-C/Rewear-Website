<button {{ $attributes->merge(['type' => 'submit']) }}
    class="btn btn-primary"
    style="width:100%;margin-top:1rem;font-size:0.9375rem;padding:0.75rem;">
    {{ $slot }}
</button>
