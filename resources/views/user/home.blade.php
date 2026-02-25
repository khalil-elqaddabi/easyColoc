<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Welcome Card -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Welcome 👋
                </h1>

                <p class="text-gray-600 mt-2">
                    Hello {{ auth()->user()->name }},
                    this is your personal space.
                </p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Colocation -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm">
                        My Colocation
                    </h3>
                    <p class="text-xl font-semibold mt-2">
                        No Data Yet
                    </p>
                </div>

                <!-- Balance -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm">
                        My Balance
                    </h3>
                    <p class="text-xl font-semibold mt-2 text-green-600">
                        0.00 €
                    </p>
                </div>

                <!-- Reputation -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm">
                        Reputation
                    </h3>
                    <p class="text-xl font-semibold mt-2">
                        ⭐ 0
                    </p>
                </div>

            </div>

            <!-- Quick Actions -->
            <div class="mt-8 bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">
                    Quick Actions
                </h2>

                <div class="flex flex-wrap gap-4">

                    <a href="#"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        View Colocation
                    </a>

                    <a href="#"
                       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Add Expense
                    </a>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>