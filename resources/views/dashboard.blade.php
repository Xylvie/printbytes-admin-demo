@php
    // Total all over sales
    $totalSalesAll = $sales->sum('amount');

    // Total sales for the current month
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
@endphp

<x-app-layout>
    <x-sidebar :user="$user">
        <div>
            <div class="grid items-center grid-cols-2 gap-5 px-10 py-5">
                <div class="px-10 py-2 bg-green-500 border border-white rounded-md">
                    <p class="text-xl font-semibold text-green-200">Total all over Sales</p>
                    <p class="text-xl text-center">Php {{ number_format($totalSalesAll, 2) }}</p>
                </div>

                <div class="px-10 py-2 bg-blue-500 border border-white rounded-md">
                    <p class="text-xl font-semibold text-green-200">Total sales for the Month</p>
                    <p class="text-xl text-center">Php {{ number_format($totalSalesMonth, 2) }}</p>
                </div>

                <div class="px-10 py-2 bg-red-500 border border-white rounded-md">
                    <p class="text-xl font-semibold text-green-200">Total Expenses for the month</p>
                    <p class="text-xl text-center">Php {{ number_format($totalExpensesMonth, 2) }}</p>
                </div>

                <div class="px-10 py-2 bg-yellow-500 border border-white rounded-md">
                    <p class="text-xl font-semibold text-green-200">Net Profit</p>
                    <p class="text-xl text-center">Php {{ number_format($netProfit, 2) }}</p>
                </div>
            </div>
            <div class="w-full px-10 overflow-x-scroll no-scrollbar">
                <canvas id="salesChart"></canvas>
            </div>
            <div class="w-full h-screen px-10 overflow-y-scroll no-scrollbar">
                <h1 class="py-5 text-2xl font-bold text-center text-gray-200">Recent Expenses</h1>
                <table class="w-full text-left text-gray-200 border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-black border-b">Reason</th>
                            <th class="px-4 py-2 text-black border-b">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($expenses as $expense)
                            <tr class="hover:bg-gray-50 hover:text-black">
                                <td class="px-4 py-2 border-b">{{ $expense->reason }}</td>
                                <td class="px-4 py-2 border-b">Php {{ number_format($expense->amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-2 text-center border-b" colspan="2">No expenses found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </x-sidebar>
</x-app-layout>

<script>
    const labels = @json($labels);
    const data = @json($data);

    const ctx = document.getElementById('salesChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar', // or 'line'
        data: {
            labels: labels,
            datasets: [{
                label: 'YTD Sales',
                data: data,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

