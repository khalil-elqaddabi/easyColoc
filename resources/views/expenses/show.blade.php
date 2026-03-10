<x-app-layout :title="$expense->title . ' - ' . $category->name . ' - ' . $colocation->name">
    <div class="flex">
        {{-- Sidebar --}}
        <x-nav></x-nav>

        {{-- Main content --}}
        <div class="flex-1 mt-20 md:mt-16 md:ml-64 px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-6xl mx-auto space-y-8">

                {{-- Header --}}
                <div class="flex items-center gap-4 mb-12">
                    <a href="{{ route('colocations.categories.expenses.index', [$colocation, $category]) }}"
                        class="inline-flex items-center text-gray-600 hover:text-gray-800 text-sm font-medium transition-all group">
                        ← Back to {{ $category->name }}
                        <svg class="w-4 h-4 ml-1 group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                </div>

                {{-- Success/Error Messages --}}
                @if (session('status'))
                    <div
                        class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-6 py-4 rounded-2xl">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Expense Detail Card --}}
                <div
                    class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div
                        class="px-8 py-12 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-emerald-50 via-green-50 to-emerald-50 dark:from-emerald-900/20 dark:to-green-900/20">
                        <div class="text-center">
                            <div
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-green-600 rounded-2xl text-white text-lg font-bold shadow-2xl mb-6">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                    </path>
                                </svg>
                                Receipt
                            </div>
                            <h1
                                class="text-4xl md:text-5xl font-black bg-gradient-to-r from-gray-900 to-gray-700 dark:from-gray-100 dark:to-gray-300 bg-clip-text text-transparent mb-4 leading-tight">
                                {{ $expense->title }}
                            </h1>
                            <div
                                class="bg-gradient-to-r from-blue-500 via-blue-600 to-indigo-600 text-white px-8 py-4 rounded-2xl shadow-2xl text-3xl md:text-4xl font-black mb-4">
                                {{ number_format($expense->amount, 2) }} <span
                                    class="text-xl font-normal tracking-wide">DH</span>
                            </div>
                            <div class="flex flex-wrap items-center justify-center gap-4 text-lg">
                                <span
                                    class="px-4 py-2 bg-purple-100 text-purple-800 rounded-xl dark:bg-purple-900/30 dark:text-purple-200">
                                    {{ $category->name }}
                                </span>
                                <span
                                    class="px-4 py-2 bg-blue-100 text-blue-800 rounded-xl dark:bg-blue-900/30 dark:text-blue-200">
                                    {{ $colocation->name }}
                                </span>
                                <span
                                    class="px-4 py-2 bg-emerald-100 text-emerald-800 rounded-xl dark:bg-emerald-900/30 dark:text-emerald-200">
                                    {{ $expense->start_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Details Grid --}}
                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Date --}}
                        <div class="group">
                            <label
                                class="block text-sm font-semibold text-gray-500 dark:text-gray-400 mb-3 uppercase tracking-wide">Date</label>
                            <div
                                class="flex items-center p-6 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-2xl border-2 border-blue-100 dark:border-blue-800/50 group-hover:shadow-xl transition-all">
                                <svg class="w-7 h-7 text-blue-600 dark:text-blue-400 mr-4 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="text-3xl font-black text-gray-900 dark:text-gray-100">
                                        {{ $expense->start_at->format('d M Y') }}</p>
                                    <p class="text-lg text-gray-500 dark:text-gray-400 font-medium">
                                        {{ $expense->start_at->format('l') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Paid by --}}
                        <div class="group">
                            <label
                                class="block text-sm font-semibold text-gray-500 dark:text-gray-400 mb-3 uppercase tracking-wide">Paid
                                by</label>
                            <div
                                class="flex items-center p-6 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 rounded-2xl border-2 border-emerald-100 dark:border-emerald-800/50 group-hover:shadow-xl transition-all">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center text-white font-bold text-2xl shadow-xl mr-5 flex-shrink-0">
                                    {{ substr($expense->payer->name, 0, 2) }}
                                </div>
                                <div>
                                    <p class="text-3xl font-black text-gray-900 dark:text-gray-100">
                                        {{ $expense->payer->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Original payer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ✅ QUI DOIT À QUI TABLE --}}
                @if (!empty($debtMatrix) && count($debtMatrix) > 0)
                    <div
                        class="bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 p-8 rounded-3xl border-2 border-yellow-200 dark:border-yellow-800/50 shadow-2xl">
                        <h2 class="text-3xl font-black text-gray-900 dark:text-gray-100 mb-8 flex items-center">
                            <svg class="w-10 h-10 text-yellow-600 mr-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08 .402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                </path>
                            </svg>
                            Qui doit à qui ({{ count($expense->payments->whereNull('paid_at')) }} paiements en attente)
                        </h2>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead
                                    class="bg-gradient-to-r from-yellow-100 to-orange-100 dark:from-yellow-900/30 dark:to-orange-900/30">
                                    <tr>
                                        <th
                                            class="px-8 py-6 text-left text-xl font-bold text-gray-900 dark:text-gray-100 uppercase tracking-wider">
                                            Débiteur</th>
                                        <th
                                            class="px-8 py-6 text-center text-xl font-bold text-gray-900 dark:text-gray-100 uppercase tracking-wider">
                                            Montant</th>
                                        <th
                                            class="px-8 py-6 text-left text-xl font-bold text-gray-900 dark:text-gray-100 uppercase tracking-wider">
                                            Créancier</th>
                                        <th
                                            class="px-8 py-6 text-right text-xl font-bold text-gray-900 dark:text-gray-100 uppercase tracking-wider">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($debtMatrix as $debtor => $creditors)
                                        @foreach ($creditors as $creditor => $amount)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-all group">
                                                {{-- Debtor --}}
                                                <td class="px-8 py-8">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-16 h-16 bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl flex items-center justify-center text-white font-bold text-xl mr-4 shadow-lg">
                                                            {{ substr($debtor, 0, 2) }}
                                                        </div>
                                                        <span
                                                            class="text-2xl font-black text-gray-900 dark:text-gray-100">{{ $debtor }}</span>
                                                    </div>
                                                </td>
                                                {{-- Amount --}}
                                                <td class="px-8 py-8 text-center">
                                                    <span
                                                        class="text-3xl font-black text-emerald-600 bg-emerald-100 dark:bg-emerald-900/50 px-8 py-4 rounded-2xl shadow-lg">
                                                        {{ number_format($amount, 2) }} DH
                                                    </span>
                                                </td>
                                                {{-- Creditor --}}
                                                <td class="px-8 py-8">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center text-white font-bold text-xl mr-4 shadow-lg">
                                                            {{ substr($creditor, 0, 2) }}
                                                        </div>
                                                        <span
                                                            class="text-2xl font-black text-blue-900 dark:text-blue-100">{{ $creditor }}</span>
                                                    </div>
                                                </td>
                                                {{-- Action --}}
                                                <td class="px-8 py-8 text-right">
                                                    @php
                                                        // ✅ FIXED: Direct payer_id lookup (no .user() chain)
                                                        $payment = $expense
                                                            ->payments()
                                                            ->whereHas('payer', fn($q) => $q->where('name', $debtor))
                                                            ->whereHas(
                                                                'receiver',
                                                                fn($q) => $q->where('name', $creditor),
                                                            )
                                                            ->whereNull('paid_at')
                                                            ->first();
                                                    @endphp

                                                    @if ($payment && (Auth::id() === $payment->payer_id || Auth::id() === $colocation->owner_id))
                                                        <form
                                                            action="{{ route('colocations.categories.expenses.payments.mark-paid', [$colocation, $category, $expense, $payment]) }}"
                                                            method="POST" class="inline">
                                                            @csrf @method('PATCH')
                                                            <button type="submit"
                                                                class="bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white px-12 py-4 rounded-2xl font-bold text-xl shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-200 focus:ring-4 focus:ring-green-500">
                                                                <svg class="w-6 h-6 inline mr-2" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                                </svg>
                                                                Marquer payé
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span
                                                            class="text-gray-500 text-lg font-medium px-8 py-4 rounded-2xl bg-gray-100 dark:bg-gray-700">
                                                            En attente
                                                        </span>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                @else
                    <div
                        class="bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 p-16 rounded-3xl border-2 border-emerald-200 dark:border-emerald-800/50 text-center shadow-2xl">
                        <svg class="w-24 h-24 text-emerald-500 mx-auto mb-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">Tous les paiements sont
                            réglés !</h3>
                        <p class="text-xl text-gray-600 dark:text-gray-400">Cette dépense est entièrement remboursée.
                        </p>
                    </div>
                @endif

                {{-- Actions --}}
                <div class="pt-12 border-t border-gray-100 dark:border-gray-700">
                    <div class="flex flex-col sm:flex-row gap-4 justify-center sm:justify-end">
                        <a href="{{ route('colocations.categories.expenses.edit', [$colocation, $category, $expense]) }}"
                            class="flex-1 sm:w-auto inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white px-10 py-5 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl transition-all duration-200 focus:ring-4 focus:ring-blue-500">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Edit Expense
                        </a>
                        <form
                            action="{{ route('colocations.categories.expenses.destroy', [$colocation, $category, $expense]) }}"
                            method="POST" class="flex-1 sm:w-auto"
                            onsubmit="return confirm('Are you sure you want to delete this expense?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-10 py-5 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl transition-all duration-200 focus:ring-4 focus:ring-red-500">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Delete Expense
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
