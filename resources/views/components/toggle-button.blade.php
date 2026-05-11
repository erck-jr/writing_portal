@props(['active' => false])

<button {{ $attributes->merge(['class' => 'p-2 rounded-lg transition-colors duration-200 focus:outline-none ' . ($active ? 'text-purple-600 dark:text-purple-400' : 'text-gray-500 hover:text-purple-600 dark:hover:text-purple-400')]) }}>
    {{ $slot }}
</button>