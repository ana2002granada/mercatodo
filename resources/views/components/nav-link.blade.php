@props(['active'])

@php
$classes = !($active ?? false)
            ? 'mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0'
            : 'mt-3 text-gray-800 font-bold hover:underline sm:mx-3 sm:mt-0';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
