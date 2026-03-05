<x-app-layout>
    <div class="flex">
        {{-- Sidebar --}}
        <x-nav></x-nav>

        {{-- Main content --}}
        <div class="flex-1 mt-20 md:mt-16 md:ml-64 px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-5xl mx-auto">

                {{-- Header --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-100">My Colocations</h1>
                    <a href="{{ route('colocations.create') }}"
                       class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium shadow-sm transition-colors">
                        + New Colocation
                    </a>
                </div>

                <!-- Success message -->
                @if (session('status'))
                    <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4 dark:bg-green-900/20 dark:border-green-800 dark:text-green-200">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- ERROR message -->
                @if (session('error'))
                    <div class="bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6 dark:bg-red-900/20 dark:border-red-800 dark:text-red-200">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($colocations->isEmpty())
                    <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-12 text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-300">You don't belong to any colocation yet.</p>
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 shadow rounded-2xl overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                Total: <span class="font-semibold text-gray-800 dark:text-gray-100">{{ $colocations->count() }}</span> colocations
                            </p>
                        </div>

                        <div class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach ($colocations as $colocation)
                                <div class="px-6 py-5 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition group">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1 min-w-0">
                                            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 group-hover:text-gray-900 truncate">
                                                {{ $colocation->name }}
                                            </h2>
                                            <div class="mt-1 flex items-center gap-4 text-sm text-gray-600 dark:text-gray-300">
                                                <span>Owner: {{ optional($colocation->owner)->name ?? 'Unknown' }}</span>
                                                <span>Status: 
                                                    @if($colocation->status === 'active')
                                                        <span class="inline-flex items-center rounded-full bg-green-100 text-green-800 px-2.5 py-0.5 text-xs font-medium dark:bg-green-900/50 dark:text-green-200">
                                                            Active
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center rounded-full bg-red-100 text-red-800 px-2.5 py-0.5 text-xs font-medium dark:bg-red-900/50 dark:text-red-200">
                                                            {{ ucfirst($colocation->status) }}
                                                        </span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <a href="{{ route('colocations.show', $colocation) }}"
                                           class="inline-flex items-center text-blue-600 hover:text-blue-700 text-sm font-medium ml-4 whitespace-nowrap group-hover:underline">
                                            View details →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
