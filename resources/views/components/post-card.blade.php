@props(['post'])

<div class="group bg-white dark:bg-gray-900 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
    <a href="{{ route('posts.show', $post->slug) }}" class="block relative aspect-video overflow-hidden">
        <img src="{{ $post->cover_image ? asset('storage/' . $post->cover_image) : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=800&auto=format&fit=crop' }}" 
             alt="{{ $post->title }}" 
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
        <div class="absolute top-4 left-4">
            <x-badge variant="purple">{{ $post->category->name }}</x-badge>
        </div>
    </a>
    
    <div class="p-5">
        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-2">
            <span>{{ $post->published_at->format('M d, Y') }}</span>
            <span>•</span>
            <span>{{ $post->reading_time }} min read</span>
        </div>
        
        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
            <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
        </h3>
        
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
            {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}
        </p>
        
        <div class="mt-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <img src="{{ $post->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($post->user->name) }}" class="w-6 h-6 rounded-full">
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">{{ $post->user->name }}</span>
            </div>
            <a href="{{ route('posts.show', $post->slug) }}" class="text-purple-600 dark:text-purple-400 hover:underline text-xs font-bold uppercase tracking-wider">Read More</a>
        </div>
    </div>
</div>