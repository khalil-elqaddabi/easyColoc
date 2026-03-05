<x-app-layout>
    <div class="flex">
        <x-nav></x-nav>

        <section class="flex-1 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6 md:ml-64 mt-20">
            <div class="bg-gray-100 hover:bg-green-200 transition rounded-2xl shadow-md p-6 flex flex-col items-center justify-center">
                <i class="fa-solid fa-users text-3xl mb-3 text-green-700"></i>
                <p class="text-gray-600">Total Users</p>
                <p class="text-2xl font-bold">{{ $userCount }}</p>
            </div>

            <div class="bg-gray-100 hover:bg-blue-200 transition rounded-2xl shadow-md p-6 flex flex-col items-center justify-center">
                <i class="fa-solid fa-list text-3xl mb-3 text-green-700"></i>
                <p class="text-gray-600">Total Colocations</p>
                <p class="text-2xl font-bold">{{ $colocCount }}</p>

            </div>

            <div class="bg-gray-100 hover:bg-orange-200 transition rounded-2xl shadow-md p-6 flex flex-col items-center justify-center">
                <i class="fa-solid fa-user-tie text-3xl mb-3 text-green-700"></i>
                <p class="text-gray-600">Total Suppliers</p>
            </div>

            <div class="bg-gray-100 hover:bg-purple-200 transition rounded-2xl shadow-md p-6 flex flex-col items-center justify-center">
                <i class="fa-solid fa-chart-line text-3xl mb-3 text-green-700"></i>
                <p class="text-gray-600">Other Metric</p>
            </div>
        </section>
    </div>
</x-app-layout>