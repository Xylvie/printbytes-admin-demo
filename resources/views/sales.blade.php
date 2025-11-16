<x-app-layout>
    <x-sidebar :user="$user">
        <div>
            <div class="flex shadow-md shadow-white">
                <form action="{{ route('sales-updated') }}" method="POST" class="flex items-center justify-center w-full gap-10 py-5">
                    @csrf
                    <label for="amount" class="font-bold text-gray-200">INPUT AMOUNT</label>
                    <input name="amount" id="amount" type="number" class="rounded-md w-80">
                    <button type="submit" class="px-5 py-2 bg-gray-200 rounded-md hover:bg-gray-400 hover:text-gray-200">Add Sales</button>
                </form>
            </div>
            <div class="w-full h-screen px-10 overflow-x-scroll no-scrollbar">
                <h1 class="py-5 text-2xl font-bold text-center text-gray-200">Recent Sales</h1>
                <table class="w-full text-left text-white border border-gray-200 rounded-md">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-black border-b">Date</th>
                            <th class="px-4 py-2 text-black border-b">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                            <tr class="hover:bg-gray-50 hover:text-black">
                                <td class="px-4 py-2 border-b">{{ $sale->created_at->format('d-m-Y') }}</td>
                                <td class="px-4 py-2 border-b">Php {{ number_format($sale->amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-2 text-center border-b" colspan="2">No sales found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </x-sidebar>

</x-app-layout>