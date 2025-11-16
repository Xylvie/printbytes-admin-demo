@php
    $currentMonth = now()->month;
    $currentYear = now()->year;
    $totalSalesMonth = $sales->filter(function($sale) use ($currentMonth, $currentYear) {
        return $sale->created_at->month === $currentMonth 
            && $sale->created_at->year === $currentYear;
    })->sum('amount');

    // Total expenses for the current month
    $totalExpensesMonth = $expenses->filter(function($expense) use ($currentMonth, $currentYear) {
        return $expense->created_at->month === $currentMonth 
            && $expense->created_at->year === $currentYear;
    })->sum('amount');

    // Net profit = total sales for the month minus total expenses
    $netProfit = $totalSalesMonth - $totalExpensesMonth;
    $partitions = $netProfit / 3;
@endphp

<x-app-layout>
    <x-sidebar :user="$user">
        <div class="px-10 py-5">
            <div class="px-10 py-2 bg-yellow-500 border border-white rounded-md">
                <p class="text-xl font-semibold text-black">Net Profit</p>
                <p class="text-xl text-center">Php {{ number_format($netProfit, '2') }}</p>
            </div>

            <div class="grid grid-cols-3 gap-5 mt-10">
                <div class="px-10 py-2 bg-green-500 border border-white rounded-md">
                    <p class="text-xl font-semibold text-black">Joshua</p>
                    <p class="text-xl text-center">Php {{ number_format($partitions, '2') }}</p>
                </div>

                <div class="px-10 py-2 bg-green-500 border border-white rounded-md">
                    <p class="text-xl font-semibold text-black">Pierre</p>
                    <p class="text-xl text-center">Php {{ number_format($partitions, '2') }}</p>
                </div>

                <div class="px-10 py-2 bg-green-500 border border-white rounded-md">
                    <p class="text-xl font-semibold text-black">Kuya Jun2</p>
                    <p class="text-xl text-center">Php {{ number_format($partitions, '2') }}</p>
                </div>
            </div>
        </div>
    </x-sidebar>
</x-app-layout>