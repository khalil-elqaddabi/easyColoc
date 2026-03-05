<x-app-layout>
    <div class="flex">
        <x-nav></x-nav>

        <div class="flex-1 mt-20 md:mt-16 md:ml-64 p-4 sm:p-6 lg:p-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                <a href="{{ route('admin.users.index') }}"
                    class="inline-flex items-center justify-center bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm">
                    View Users
                </a>

                <h1 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Banned Users
                </h1>
            </div>

            @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4 text-sm">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow rounded-2xl overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        Total: <span class="font-semibold">{{ $users->total() }}</span> banned users
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-200 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3 font-semibold tracking-wider">Name</th>
                                <th class="px-6 py-3 font-semibold tracking-wider">Email</th>
                                <th class="px-6 py-3 font-semibold tracking-wider text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-100">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-300">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.users.restore', $user->id) }}" method="POST" class="flex justify-end">
                                        @csrf
                                        @method('PATCH')
                                        <button
                                            class="inline-flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-xs sm:text-sm font-medium shadow-sm">
                                            Deban
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        No banned users
                                    </p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($users->hasPages())
                <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
                        </div>
                        <div class="text-sm">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>