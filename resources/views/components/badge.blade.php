@props(['variant' => 'purple'])

@php
    $classes = match($variant) {
        'purple' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300',
        'turquoise' => 'bg-teal-100 text-teal-700 dark:bg-teal-900/30 dark:text-teal-300',
        'gray' => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400',
        default => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300',
    };
@endphp

<span {{ $attributes->merge(['class' => "px-2.5 py-0.5 rounded-full text-xs font-medium {$classes}"]) }}>
    {{ $slot }}
</span>