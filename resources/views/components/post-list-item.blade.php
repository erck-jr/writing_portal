@props(['post'])

<div class="group flex flex-col sm:flex-row gap-6 bg-white dark:bg-gray-900 p-4 rounded-2xl border border-gray-100 dark:border-gray-800 transition-all duration-300 hover:shadow-lg">
    <a href="{{ route('posts.show', $post->slug) }}" class="flex-shrink-0 w-full sm:w-48 h-32 overflow-hidden rounded-xl">
        <img src="{{ $post->cover_image ? asset('storage/' . $post->cover_image) : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=800&auto=format&fit=crop' }}" 
             alt="{{ $post->title }}" 
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
    </a>
    
    <div class="flex-1 flex flex-col justify-between">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <x-badge variant="turquoise">{{ $post->category->name }}</x-badge>
                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $post->published_at->format('M d, Y') }}</span>
            </div>
            
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
            </h3>
            
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
            </p>
        </div>
        
        <div class="mt-3 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <img src="{{ $post->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($post->user->name) }}" class="w-5 h-5 rounded-full">
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">{{ $post->user->name }}</span>
            </div>
            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $post->reading_time }} min read</span>
        </div>
    </div>
</div>