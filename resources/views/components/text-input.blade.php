@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'form-input']) }}
    style="display:block;width:100%;">
