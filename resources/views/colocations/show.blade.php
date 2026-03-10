<x-app-layout :title="'Colocation: ' . $colocation->name">
    <div class="flex">
        {{-- Sidebar --}}
        <x-nav></x-nav>

        {{-- Main content --}}
        <div class="flex-1 mt-20 md:mt-16 md:ml-64 px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-6xl mx-auto space-y-8">

                {{-- Header --}}
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100">
                            {{ $colocation->name }}
                        </h1>
                        <span
                            class="inline-flex items-center px-3 py-1 mt-2 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full dark:bg-blue-900/30 dark:text-blue-200">
                            {{ ucfirst($colocation->status) }}
                        </span>
                    </div>
                    <a href="{{ route('colocations.index') }}"
                        class="inline-flex items-center text-gray-600 hover:text-gray-800 text-sm font-medium transition-colors">
                        ← Back to colocations
                    </a>
                </div>

                {{-- Success/Error Messages --}}
                @if (session('status'))
                    <div
                        class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-6 py-4 rounded-2xl">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div
                        class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-6 py-4 rounded-2xl">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Info Cards --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Owner card -->
                    <div
                        class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 border border-gray-100 dark:border-gray-700">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                            <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Owner
                        </h2>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                            {{ optional($colocation->owner)->name ?? 'Unknown' }}
                        </p>
                    </div>

                    <!-- Actions card -->
                    <div
                        class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 border border-gray-100 dark:border-gray-700">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">Actions</h2>
                        <div class="grid grid-cols-1 gap-3">
                            <a href="{{ route('colocations.edit', $colocation) }}"
                                class="group bg-gray-50 dark:bg-gray-900/50 hover:bg-gray-100 dark:hover:bg-gray-800 border border-gray-200 dark:border-gray-600 p-4 rounded-xl text-sm font-semibold text-gray-800 dark:text-gray-200 transition-all hover:shadow-md">
                                <span class="group-hover:translate-x-1 transition-transform">Edit Colocation</span>
                            </a>

                            <a href="{{ route('colocations.categories.index', $colocation) }}"
                                class="group bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white p-4 rounded-xl text-sm font-bold uppercase tracking-wide shadow-lg hover:shadow-xl transition-all">
                                <span class="group-hover:scale-105 transition-transform">See Categories</span>
                            </a>

                            @if ($colocation->status === 'active' && auth()->user()->id !== $colocation->owner_id)
                                <form action="{{ route('colocations.quit', $colocation) }}" method="post"
                                    class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white p-4 rounded-xl text-sm font-semibold shadow-lg hover:shadow-xl transition-all group"
                                        onclick="return confirm('Are you sure you want to quit this colocation?')">
                                        Quit Colocation
                                    </button>
                                </form>
                            @endif

                            @if (auth()->user()->id === $colocation->owner_id && $colocation->status === 'active')
                                <form action="{{ route('colocations.cancel', $colocation) }}" method="post"
                                    class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white p-4 rounded-xl text-sm font-semibold shadow-lg hover:shadow-xl transition-all"
                                        onclick="return confirm('Are you sure you want to cancel this colocation?')">
                                        Cancel Colocation
                                    </button>
                                </form>
                            @endif

                            @if (auth()->user()->id === $colocation->owner_id && $colocation->status === 'cancelled')
                                <form action="{{ route('colocations.destroy', $colocation) }}" method="post"
                                    class="inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white p-4 rounded-xl text-sm font-bold shadow-lg hover:shadow-xl transition-all"
                                        onclick="return confirm('Delete this colocation permanently?')">
                                        Delete Forever
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Members List --}}
                <div
                    class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div
                        class="px-8 py-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-900/50 dark:to-gray-800/50">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Members</h2>
                    </div>
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach ($colocation->members as $member)
                            <div class="px-8 py-6 hover:bg-gray-50 dark:hover:bg-gray-900/30 transition-colors group">
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $member->name }}
                                    </span>
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-semibold rounded-full">
                                            Rep: {{ $member->reputation ?? 0 }}
                                        </span>

                                        @can('can_remove_member', [$colocation, $member])
                                            <form method="post"
                                                action="{{ route('colocations.members.remove', [$colocation, $member]) }}"
                                                class="inline"
                                                onsubmit="return confirm('Remove {{ $member->name }} from this colocation?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-800 text-sm font-semibold px-4 py-1 bg-red-50 hover:bg-red-100 rounded-full transition-all group-hover:scale-105">
                                                    Remove
                                                </button>
                                            </form>
                                        @endcan

                                        <span
                                            class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 text-sm font-semibold rounded-full">
                                            {{ ucfirst($member->pivot->role) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                {{-- Invite Form --}}
                @if (Gate::allows('can_invite_member', $colocation))
                    <div
                        class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl border border-gray-100 dark:border-gray-700 p-8">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Invite New Member</h2>
                        <form method="post" action="{{ route('colocations.invitations.invite', $colocation) }}"
                            class="flex flex-col sm:flex-row gap-4">
                            @csrf
                            <div class="flex-1">
                                <input type="email" name="email" placeholder="member@example.com"
                                    class="w-full px-5 py-4 border border-gray-200 dark:border-gray-600 rounded-2xl bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-4 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all"
                                    required>
                                @error('email')
                                    <p
                                        class="mt-2 text-sm text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl px-4 py-2">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <button type="submit"
                                class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-8 rounded-2xl shadow-lg hover:shadow-xl transition-all w-full sm:w-auto">
                                Send Invite
                            </button>
                        </form>
                    </div>
                @endif
            </div>


        </div>
    </div>
</x-app-layout>
