<x-app-layout>
    <div class="flex">
        {{-- Sidebar --}}
        <x-nav></x-nav>

        {{-- Main content --}}
        <div class="flex-1 mt-20 md:mt-16 md:ml-64 px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-2xl mx-auto">

                {{-- Header --}}
                <div class="flex items-center justify-between mb-8">
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-100">
                        Create New Colocation
                    </h1>
                    <a href="{{ route('colocations.index') }}"
                       class="inline-flex items-center text-gray-600 hover:text-gray-800 text-sm font-medium transition-colors">
                        ← Back to list
                    </a>
                </div>

                {{-- Form Card --}}
                <div class="bg-white dark:bg-gray-800 shadow rounded-2xl overflow-hidden">
                    <form method="post" action="{{ route('colocations.store') }}" class="p-6">
                        @csrf

                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">
                                    Colocation Name
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm"
                                    required
                                    placeholder="Enter a name for your colocation"
                                >
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg px-3 py-2">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-gray-700">
                            <button type="submit"
                                    class="flex-1 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 focus:ring-4 focus:ring-emerald-500 focus:ring-opacity-50">
                                Create Colocation
                            </button>
                            <a href="{{ route('colocations.index') }}"
                               class="flex-1 inline-flex items-center justify-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-medium py-4 px-6 border border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-400 rounded-xl transition-all shadow-sm hover:shadow-md">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
