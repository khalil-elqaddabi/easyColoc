<x-app-layout>
    <x-nav>
    </x-nav>


    <div class="mt-16 ml-64 p-8">
        <a href="{{ route('admin.users.trashed') }}"
            class="bg-gray-700 text-white px-4 py-2 rounded-lg">
            View Banned Users
        </a>

        <h1 class="text-2xl font-bold mb-6">Users List</h1>

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
                    @foreach($users as $user)
                    <tr class="border-t">
                        <td class="p-4">{{ $user->name }}</td>
                        <td class="p-4">{{ $user->email }}</td>
                        <td class="p-4">

                            @if(auth()->id() !== $user->id)

                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                    Ban
                                </button>
                            </form>

                            @else
                            <span class="text-gray-400 text-sm">Current User</span>
                            @endif
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>

    </div>

</x-app-layout>