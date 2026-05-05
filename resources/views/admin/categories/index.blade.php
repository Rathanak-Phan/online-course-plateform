@extends('layouts.admin')

@section('title', 'Manage Categories - System Admin')

@section('content')
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8" x-data="{ openModal: false, editMode: false, currentCategory: { id: '', name: '', icon: '' } }">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Content Categories</h1>
                <p class="mt-2 text-lg text-slate-500 font-medium">Organize your platform's courses into logical groups.</p>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <form action="{{ route('admin.categories.index') }}" method="GET" class="relative w-full sm:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search categories..." class="w-full pl-10 pr-4 py-4 bg-white border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all shadow-sm">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    @if(request('search'))
                        <a href="{{ route('admin.categories.index') }}" class="absolute right-3 top-5 text-slate-300 hover:text-slate-500">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </a>
                    @endif
                </form>
                <button @click="editMode = false; currentCategory = { id: '', name: '', icon: '' }; openModal = true" 
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-indigo-600 text-white px-8 py-4 rounded-2xl font-black text-sm hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-200 uppercase tracking-widest whitespace-nowrap">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
                    New Category
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl mb-12 flex justify-between items-center shadow-sm">
                <span class="font-bold text-sm">{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-rose-50 border border-rose-100 text-rose-700 px-6 py-4 rounded-2xl mb-12 flex justify-between items-center shadow-sm">
                <span class="font-bold text-sm">{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-rose-400 hover:text-rose-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        @endif

        <!-- Category Table/List -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Icon</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Category Name</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Courses</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($categories as $category)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-500 group-hover:bg-indigo-100 group-hover:text-indigo-600 transition-all duration-300">
                                        @if($category->icon)
                                            {!! $category->icon !!}
                                        @else
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-sm font-black text-slate-900">{{ $category->name }}</span>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">/categories/{{ $category->slug }}</p>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="inline-flex items-center px-3 py-1 bg-slate-100 rounded-full text-xs font-black text-slate-600">{{ $category->courses_count }} Courses</span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <button @click="editMode = true; currentCategory = { id: '{{ $category->id }}', name: '{{ $category->name }}', icon: '{{ addslashes($category->icon) }}' }; openModal = true" 
                                                class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                        </button>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category? This cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div class="inline-flex items-center justify-center w-24 h-24 bg-slate-100 rounded-full text-slate-300 mb-6">
                                        <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                    </div>
                                    <h3 class="text-2xl font-black text-slate-900 mb-2">No Categories Found</h3>
                                    <p class="text-slate-500 font-medium">Create your first category to start organizing courses.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($categories->hasPages())
                <div class="px-8 py-5 bg-slate-50 border-t border-slate-100">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>

        <!-- Modal for Add/Edit -->
        <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" @keydown.escape.window="openModal = false">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click="openModal = false"></div>
                
                <div class="bg-white rounded-[32px] w-full max-w-lg p-10 shadow-2xl relative z-10 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-full -mr-16 -mt-16"></div>
                    
                    <h2 class="text-3xl font-black text-slate-900 mb-2" x-text="editMode ? 'Edit Category' : 'New Category'"></h2>
                    <p class="text-slate-500 font-medium mb-8">Set a name and icon for this category.</p>
                    
                    <form :action="editMode ? '{{ route('admin.categories.index') }}/' + currentCategory.id : '{{ route('admin.categories.store') }}'" method="POST" class="space-y-8">
                        @csrf
                        <template x-if="editMode">
                            <input type="hidden" name="_method" value="PATCH">
                        </template>

                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 ml-1">Category Name</label>
                            <input type="text" name="name" x-model="currentCategory.name" required 
                                   class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" 
                                   placeholder="e.g. Graphic Design">
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 ml-1">Icon SVG (Optional)</label>
                            <textarea name="icon" x-model="currentCategory.icon" rows="4"
                                      class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none resize-none font-mono text-[10px]" 
                                      placeholder="Paste <svg> code here..."></textarea>
                        </div>

                        <div class="flex gap-4 pt-4">
                            <button type="button" @click="openModal = false" class="flex-1 px-8 py-4 rounded-2xl font-black text-sm text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest">Cancel</button>
                            <button type="submit" class="flex-1 bg-slate-900 text-white px-8 py-4 rounded-2xl font-black text-sm hover:bg-slate-800 transition-all shadow-xl shadow-slate-200 uppercase tracking-widest" x-text="editMode ? 'Update' : 'Create'"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
