<x-app-layout title="New Category - {{ $colocation->name }}">
    <div class="flex">
        {{-- Sidebar --}}
        <x-nav></x-nav>

        {{-- Main content --}}
        <div class="flex-1 mt-20 md:mt-16 md:ml-64 px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-2xl mx-auto space-y-8">

                {{-- Header --}}
                <div class="flex items-center gap-3 mb-8">
                    <a href="{{ route('colocations.categories.index', $colocation) }}" 
                       class="inline-flex items-center text-gray-600 hover:text-gray-800 text-sm font-medium transition-colors group">
                        ← Back to categories
                        <svg class="w-4 h-4 ml-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                </div>

                {{-- Form Card --}}
                <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="px-8 py-10 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg flex-shrink-0 mt-1">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">New Category</h1>
                                <p class="text-lg text-gray-600 dark:text-gray-300">
                                    Browser suggestions from {{ $suggestions->count() }} deleted categories
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('colocations.categories.store', $colocation) }}" class="p-8">
                        @csrf
                        
                        <div class="space-y-8">
                            <div>
                                <label for="categoryName" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">
                                    Category Name
                                </label>
                                <div class="relative">
                                    <input
                                        list="category-suggestions"
                                        type="text"
                                        name="name"
                                        id="categoryName"
                                        value="{{ old('name') }}"
                                        class="w-full pl-12 pr-6 py-5 border-2 border-gray-200 dark:border-gray-600 rounded-2xl bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-4 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-lg hover:shadow-xl @error('name') border-red-400 bg-red-50 dark:bg-red-900/20 @enderror"
                                        maxlength="70"
                                        required
                                        placeholder="Type for browser suggestions from deleted categories..."
                                    >
                                    <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <datalist id="category-suggestions">
                                    @foreach($suggestions as $suggestion)
                                        <option value="{{ $suggestion }}">{{ $suggestion }}</option>
                                    @endforeach
                                </datalist>
                                @error('name')
                                    <div class="mt-4 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-2xl">
                                        <p class="text-sm font-medium text-red-800 dark:text-red-200">
                                            {{ $message }}
                                        </p>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row gap-4 mt-12 pt-8 border-t border-gray-100 dark:border-gray-700">
                            <button type="submit"
                                    class="flex-1 lg:flex-none bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-bold py-5 px-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-200 focus:ring-4 focus:ring-emerald-500 focus:ring-opacity-50">
                                Create Category
                            </button>
                            <a href="{{ route('colocations.categories.index', $colocation) }}"
                               class="flex-1 lg:flex-none inline-flex items-center justify-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-semibold py-5 px-8 border-2 border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-400 rounded-2xl transition-all shadow-lg hover:shadow-xl">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
