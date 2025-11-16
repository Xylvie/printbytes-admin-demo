<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sales::all();
        $expenses = Expenses::all();
        $user = User::all();

        return view('partition', compact('sales', 'expenses', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $expenses = Expenses::all();
        $user = User::all();

        return view('expenses', compact('expenses', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sales = $request->validate([
            'reason' => 'required|string',
            'amount' => 'required',
        ]);

        Expenses::create($sales);

        return redirect()->back()->with('success', 'Expenses Updated');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expenses $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expenses $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expenses $expenses)
    {
        //
    }
}
