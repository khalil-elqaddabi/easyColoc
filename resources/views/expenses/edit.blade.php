<x-app-layout title="Edit {{ $expense->title }} - {{ $category->name }} - {{ $colocation->name }}">
    <div class="flex">
        {{-- Sidebar --}}
        <x-nav></x-nav>

        {{-- Main content --}}
        <div class="flex-1 mt-20 md:mt-16 md:ml-64 px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-2xl mx-auto space-y-8">

                {{-- Header --}}
                <div class="flex items-center gap-3 mb-8">
                    <a href="{{ route('colocations.categories.expenses.index', [$colocation, $category]) }}" 
                       class="inline-flex items-center text-gray-600 hover:text-gray-800 text-sm font-medium transition-colors group">
                        ← Back to {{ $category->name }}
                        <svg class="w-4 h-4 ml-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                </div>

                {{-- Form Errors --}}
                @if ($errors->any())
                    <div class="bg-red-50 dark:bg-red-900/20 border-2 border-red-200 dark:border-red-800 rounded-3xl p-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <ul class="text-sm text-red-800 dark:text-red-200 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                {{-- Form Card --}}
                <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="px-8 py-10 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg flex-shrink-0 mt-1">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">Edit Expense</h1>
                                <p class="text-lg text-gray-600 dark:text-gray-300">
                                    {{ $expense->title }} • {{ $category->name }} • {{ $colocation->name }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('colocations.categories.expenses.update', [$colocation, $category, $expense]) }}" class="p-8">
                        @csrf @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- Date --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Date *</label>
                                <div class="relative">
                                    <input type="date" 
                                           name="start_at"
                                           value="{{ old('start_at', $expense->start_at->format('Y-m-d')) }}"
                                           required
                                           class="w-full pl-12 pr-6 py-5 border-2 border-gray-200 dark:border-gray-600 rounded-2xl bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-4 focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-lg hover:shadow-xl @error('start_at') border-red-400 bg-red-50 dark:bg-red-900/20 @enderror">
                                    <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                @error('start_at')
                                    <p class="mt-3 text-sm text-red-600 dark:text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Amount --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Amount (DH) *</label>
                                <div class="relative">
                                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-xl font-bold text-gray-500">DH</div>
                                    <input type="number" 
                                           name="amount" 
                                           step="0.01" 
                                           min="0"
                                           value="{{ old('amount', $expense->amount) }}"
                                           required
                                           class="w-full pl-16 pr-6 py-5 border-2 border-gray-200 dark:border-gray-600 rounded-2xl bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-4 focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-lg hover:shadow-xl @error('amount') border-red-400 bg-red-50 dark:bg-red-900/20 @enderror"
                                           placeholder="0.00">
                                </div>
                                @error('amount')
                                    <p class="mt-3 text-sm text-red-600 dark:text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-8 mt-2">
                            {{-- Payer --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Paid by *</label>
                                <div class="relative">
                                    <select name="payer_id" 
                                            required
                                            class="w-full pl-12 pr-6 py-5 border-2 border-gray-200 dark:border-gray-600 rounded-2xl bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-4 focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-lg hover:shadow-xl appearance-none @error('payer_id') border-red-400 bg-red-50 dark:bg-red-900/20 @enderror">
                                        <option value="">Select member</option>
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}" {{ old('payer_id', $expense->payer_id) == $member->id ? 'selected' : '' }}>
                                                {{ $member->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <svg class="absolute right-5 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                @error('payer_id')
                                    <p class="mt-3 text-sm text-red-600 dark:text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Title --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Title *</label>
                                <div class="relative">
                                    <input type="text" 
                                           name="title"
                                           value="{{ old('title', $expense->title) }}"
                                           required
                                           class="w-full pl-12 pr-6 py-5 border-2 border-gray-200 dark:border-gray-600 rounded-2xl bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-4 focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-lg hover:shadow-xl @error('title') border-red-400 bg-red-50 dark:bg-red-900/20 @enderror"
                                           placeholder="What was purchased?">
                                    <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                                @error('title')
                                    <p class="mt-3 text-sm text-red-600 dark:text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row gap-4 mt-12 pt-8 border-t border-gray-100 dark:border-gray-700">
                            <button type="submit"
                                    class="flex-1 lg:flex-none bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 text-white font-bold py-5 px-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-200 focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50">
                                Update Expense
                            </button>
                            <a href="{{ route('colocations.categories.expenses.show', [$colocation, $category, $expense]) }}"
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
