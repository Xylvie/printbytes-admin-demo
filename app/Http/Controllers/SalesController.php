<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Expenses;
use App\Models\User;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sales::all();
        $expenses = Expenses::all();
        $user = User::all();

        [$labels, $data] = $this->getSalesYtd();

        return view('dashboard', compact('sales', 'expenses', 'user', 'labels', 'data'));
    }

    private function getSalesYtd(): array
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $raw = Sales::selectRaw("strftime('%m', created_at) as month, SUM(amount) as total")
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->mapWithKeys(fn($value, $key) => [(int)$key => $value]); // convert month string to integer

        $labels = [];
        $data = [];
        for ($m = 1; $m <= $currentMonth; $m++) {
            $labels[] = now()->create($currentYear, $m, 1)->format('M');
            $data[] = $raw[$m] ?? 0;
        }

        return [$labels, $data];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sales = Sales::all();
        $user = User::all();

        return view('sales', compact('sales', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sales = $request->validate([
            'amount' => 'required',
        ]);

        Sales::create($sales);

        return redirect()->back()->with('success', 'Sales Updated');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sales $sales)
    {
        //
    }
}
