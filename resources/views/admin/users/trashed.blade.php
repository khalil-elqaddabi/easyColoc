<x-app-layout>
    <x-nav>
        </x-nav>

<div class="mt-16 ml-64 p-8">
    <a href="{{ route('admin.users.index') }}"
            class="bg-gray-700 text-white px-4 py-2 rounded-lg">
            View Users
        </a>

    <h1 class="text-2xl font-bold mb-6">
        Banned Users
    </h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-2xl overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4">Name</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr class="border-t">
                        <td class="p-4">{{ $user->name }}</td>
                        <td class="p-4">{{ $user->email }}</td>
                        <td class="p-4">

                            <form action="{{ route('admin.users.restore', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                                    Deban
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">
                            No banned users
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>

</div>

</x-app-layout>