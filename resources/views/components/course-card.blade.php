@props(['title', 'instructor', 'price', 'rating', 'reviews', 'image', 'id', 'badge' => null])

<div class="group bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
    <a href="{{ route('courses.show', $id) }}" class="block">
        <div class="relative aspect-video overflow-hidden">
            <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @if($badge)
                <span class="absolute top-3 left-3 bg-indigo-600 text-white text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wider">{{ $badge }}</span>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        </div>
    </a>
    
    @auth
        <form action="{{ route('wishlist.toggle', $id) }}" method="POST" class="absolute top-3 right-3 z-10">
            @csrf
            <button type="submit" class="p-2 rounded-full backdrop-blur-md transition-all {{ auth()->user()->wishlistedCourses()->where('course_id', $id)->exists() ? 'bg-rose-500 text-white shadow-lg shadow-rose-200' : 'bg-white/80 text-slate-400 hover:text-rose-500 hover:bg-white' }}">
                <svg class="w-4 h-4 {{ auth()->user()->wishlistedCourses()->where('course_id', $id)->exists() ? 'fill-current' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
            </button>
        </form>
    @endauth

    <div class="p-5">
        <div class="flex items-center gap-1 mb-2">
            <div class="flex text-amber-400">
                @for($i = 1; $i <= 5; $i++)
                    <svg class="w-3.5 h-3.5 {{ $i <= round($rating) ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endfor
            </div>
            <span class="text-xs font-bold text-slate-700">{{ $rating }}</span>
            <span class="text-xs text-slate-400">({{ $reviews }})</span>
        </div>
        <a href="{{ route('courses.show', $id) }}">
            <h3 class="font-bold text-slate-900 leading-tight mb-2 line-clamp-2 group-hover:text-indigo-600 transition-colors h-10">{{ $title }}</h3>
        </a>
        <p class="text-xs text-slate-500 mb-4">By <span class="font-medium text-slate-700">{{ $instructor }}</span></p>
        
        <div class="flex items-center justify-between pt-4 border-t border-slate-100">
            <span class="text-lg font-bold text-slate-900">${{ number_format($price, 2) }}</span>
            <a href="{{ route('courses.show', $id) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 uppercase tracking-wider flex items-center gap-1">
                View Course
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </a>
        </div>
    </div>
</div>
