<x-app-layout title="Categories - {{ $colocation->name }}">
    <div class="flex">
        {{-- Sidebar --}}
        <x-nav></x-nav>

        {{-- Main content --}}
        <div class="flex-1 mt-20 md:mt-16 md:ml-64 px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-6xl mx-auto space-y-8">

                {{-- Success Message --}}
                @if (session('status'))
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-6 py-4 rounded-2xl">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Header --}}
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
                    <h1 class="text-2xl lg:text-3xl font-bold text-gray-800 dark:text-gray-100">
                        Categories
                    </h1>
                    <div class="flex flex-wrap gap-3 justify-end">
                        @if (Gate::allows('can_update_colocation', $colocation))
                            <a href="{{ route('colocations.categories.create', $colocation) }}"
                               class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
                                + New Category
                            </a>
                        @endif
                        <a href="{{ route('colocations.show', $colocation) }}"
                           class="inline-flex items-center justify-center bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-xl font-semibold shadow-sm hover:shadow-md transition-all">
                            ← Back
                        </a>
                    </div>
                </div>

                @if ($categories->isEmpty())
                    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl p-16 text-center border-2 border-dashed border-gray-200 dark:border-gray-700">
                        <div class="max-w-md mx-auto">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">No categories yet</h3>
                            <p class="text-lg text-gray-500 dark:text-gray-400 mb-8">Categories help you organize expenses and track spending.</p>
                            @if (Gate::allows('can_update_colocation', $colocation))
                                <a href="{{ route('colocations.categories.create', $colocation) }}" 
                                   class="inline-flex items-center justify-center bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl transition-all">
                                    Create first category
                                </a>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                        {{-- Table Header --}}
                        <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-900/50 dark:to-gray-800/50">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">All Categories</h2>
                                <span class="px-4 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 text-sm font-semibold rounded-2xl">
                                    {{ $categories->total() }} total
                                </span>
                            </div>
                        </div>

                        {{-- Table --}}
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700/50">
                                    <tr>
                                        <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category Name</th>
                                        <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Expenses</th>
                                        @if (Gate::allows('can_update_colocation', $colocation))
                                            <th class="px-8 py-5 text-right text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($categories as $category)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/30 transition-colors group">
                                            <td class="px-8 py-6">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                                        <span class="text-white font-bold text-sm">{{ substr($category->name, 0, 2) }}</span>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('colocations.categories.expenses.index', [$colocation, $category]) }}"
                                                           class="text-xl font-bold text-gray-900 dark:text-gray-100 hover:text-blue-600 dark:hover:text-blue-400 group-hover:underline transition-all">
                                                            {{ $category->name }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-6">
                                                <span class="inline-flex items-center px-4 py-2 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 text-sm font-bold rounded-2xl">
                                                    {{ $category->expenses_count }} expenses
                                                </span>
                                            </td>
                                            @if (Gate::allows('can_update_colocation', $colocation))
                                                <td class="px-8 py-6 text-right">
                                                    <div class="flex items-center justify-end gap-4">
                                                        <a href="{{ route('colocations.categories.edit', [$colocation, $category]) }}"
                                                           class="inline-flex items-center px-4 py-2 bg-blue-100 dark:bg-blue-900/30 hover:bg-blue-200 dark:hover:bg-blue-800 text-blue-800 dark:text-blue-200 font-semibold rounded-xl hover:shadow-md transition-all group-hover:scale-105">
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('colocations.categories.destroy', [$colocation, $category]) }}" method="POST" class="inline"
                                                              onsubmit="return confirm('Delete category and all expenses?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit"
                                                                    class="inline-flex items-center px-4 py-2 bg-red-100 dark:bg-red-900/30 hover:bg-red-200 dark:hover:bg-red-800 text-red-800 dark:text-red-200 font-semibold rounded-xl hover:shadow-md transition-all group-hover:scale-105">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Pagination --}}
                    @if($categories->hasPages())
                        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl border border-gray-100 dark:border-gray-700 p-6">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-700 dark:text-gray-300">
                                    Page {{ $categories->currentPage() }} of {{ $categories->lastPage() }}
                                </div>
                                <div>
                                    {{ $categories->appends(request()->query())->links('pagination::tailwind') }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
