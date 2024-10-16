@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-white text-lg font-medium leading-5 text-orange-500 focus:outline-none focus:border-orange-500 transition duration-150 ease-in-out' 
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-lg font-medium leading-5 text-orange-500 hover:text-orange-500 hover:border-orange-500 focus:outline-none focus:text-orange-500 focus:border-orange-500 transition duration-150 ease-in-out'; 
@endphp


<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>