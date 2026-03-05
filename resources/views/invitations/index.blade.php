<x-app-layout title="Invitations - {{ $colocation->name }}">
    <div class="flex">
        {{-- Sidebar --}}
        <x-nav></x-nav>

        {{-- Main content --}}
        <div class="flex-1 mt-20 md:mt-16 md:ml-64 px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-6xl mx-auto space-y-8">

                {{-- Header --}}
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800 dark:text-gray-100">
                            Invitations
                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-300 mt-1">
                            {{ $colocation->name }}
                        </p>
                    </div>
                    <a href="{{ route('colocations.show', $colocation) }}"
                       class="inline-flex items-center justify-center bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-xl font-semibold shadow-sm hover:shadow-md transition-all">
                        ← Back to Colocation
                    </a>
                </div>

                @if($invitations->isEmpty())
                    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl p-20 text-center border-2 border-dashed border-gray-200 dark:border-gray-700">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-lg">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">No invitations yet</h3>
                            <p class="text-lg text-gray-500 dark:text-gray-400 mb-8">Start inviting members to join your colocation.</p>
                        </div>
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                        {{-- Header --}}
                        <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Invitations</h2>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $invitations->count() }} total invitations for {{ $colocation->name }}
                                    </p>
                                </div>
                                <span class="px-4 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 text-sm font-bold rounded-2xl">
                                    {{ $invitations->where('accepted_at', '!=', null)->count() }} joined
                                </span>
                            </div>
                        </div>

                        {{-- Invitations List --}}
                        <div class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($invitations as $invitation)
                                <div class="px-8 py-8 hover:bg-gray-50 dark:hover:bg-gray-900/30 transition-colors group">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-14 h-14 bg-gradient-to-br from-gray-400 to-gray-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform">
                                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 018 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-xl font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $invitation->email }}</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ $invitation->created_at->format('M d, Y \a\t g:i A') }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center gap-3">
                                            @if($invitation->accepted_at)
                                                <span class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-green-600 text-white font-semibold rounded-2xl shadow-lg">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Accepted
                                                </span>
                                            @elseif($invitation->refused_at)
                                                <span class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-2xl shadow-lg">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Refused
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-orange-600 text-white font-semibold rounded-2xl shadow-lg animate-pulse">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Pending
                                                </span>
                                            @endif
                                        </div>
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
