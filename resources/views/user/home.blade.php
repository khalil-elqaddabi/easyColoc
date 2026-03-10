<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Colocations
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('status'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl mb-8">
                    {{ session('status') }}
                </div>
            @endif

            @if($colocations->count() === 0)
                <div class="text-center py-20">
                    <svg class="w-24 h-24 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-6 4h1m-1 4h1"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No colocations yet</h3>
                    <p class="text-gray-600 mb-6">Join or create a colocation to get started</p>
                    <a href="{{ route('colocations.create') }}" class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-8 py-4 rounded-2xl font-bold shadow-xl hover:shadow-2xl transition-all">
                        Create Colocation
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($colocations as $colocation)
                        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-2xl transition-all">
                            <div class="px-8 pt-8 pb-6 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 border-b border-blue-100 dark:border-blue-800/50">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-2xl font-black text-gray-900 dark:text-gray-100">
                                            {{ $colocation->name }}
                                        </h3>
                                        <span class="inline-flex items-center px-3 py-1 mt-2 bg-{{ $colocation->status === 'active' ? 'emerald' : 'orange' }}-100 text-{{ $colocation->status === 'active' ? 'emerald' : 'orange' }}-800 text-sm font-semibold rounded-full">
                                            {{ ucfirst($colocation->status) }}
                                        </span>
                                    </div>
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                        {{ substr($colocation->name, 0, 2) }}
                                    </div>
                                </div>
                            </div>

                            <div class="p-8">
                                <div class="flex items-center mb-6 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-2xl">
                                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center text-white font-bold text-sm mr-3">
                                        {{ substr($colocation->owner->name ?? 'UN', 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-gray-100">Owner</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $colocation->owner->name ?? 'Unknown' }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-8">
                                    <div class="text-center p-4 bg-emerald-50 dark:bg-emerald-900/20 rounded-2xl">
                                        <p class="text-3xl font-black text-emerald-600">{{ $colocation->active_members }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wide">Members</p>
                                    </div>
                                    <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-2xl">
                                        <p class="text-3xl font-black text-blue-600">{{ $colocation->categories->count() }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wide">Categories</p>
                                    </div>
                                </div>

                                <div class="pt-6 border-t border-gray-100 dark:border-gray-700">
                                    <a href="{{ route('colocations.show', $colocation) }}"
                                       class="w-full block bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-bold py-4 px-6 rounded-2xl text-center shadow-xl hover:shadow-2xl transition-all">
                                        View Colocation
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 text-center">
                    <a href="{{ route('colocations.create') }}"
                       class="inline-flex items-center bg-gradient-to-r from-emerald-600 to-green-700 hover:from-emerald-700 hover:to-green-800 text-white font-bold px-10 py-5 rounded-3xl shadow-2xl hover:shadow-3xl transition-all">
                        Create New Colocation
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
