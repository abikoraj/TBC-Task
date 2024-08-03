@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center p-2 text-white bg-blue-500 hover:text-white focus:outline-none focus:text-white transition duration-150 ease-in-out'
            : 'flex items-center p-2 border-transparent text-gray-400 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
