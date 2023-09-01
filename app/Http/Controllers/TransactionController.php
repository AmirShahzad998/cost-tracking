<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with('project', 'expense')->orderBy('created_at','desc')->get();
        $total = [
            'revenue' => Transaction::where('type', 'In')->sum('amount'),
            'expense' => Transaction::where('type', 'Out')->sum('amount'),
        ];

        $monthly = [
            'revenue' => Transaction::where('type', 'In')->whereMonth('date', Carbon::now()->month)->sum('amount'),
            'expense' => Transaction::where('type', 'Out')->whereMonth('date', Carbon::now()->month)->sum('amount'),
        ];
        $prev_month = [
            'revenue' => Transaction::where('type', 'In')->whereMonth('date', Carbon::now()->month-1)->sum('amount'),
            'expense' => Transaction::where('type', 'Out')->whereMonth('date', Carbon::now()->month-1)->sum('amount'),
        ];

        $total_profit = $total['revenue'] - $total['expense'];
        $monthly_profit = $monthly['revenue'] - $monthly['expense'];
        $prev_month_profit = $prev_month['revenue'] - $prev_month['expense'];

        $percentage = null;
        if ($prev_month_profit != 0) {
            $difference = $monthly_profit - $prev_month_profit;
            $percentage = ($difference / $prev_month_profit) * 100;
            $sign = $difference > 0 ? '+' : '-';
            $percentage = $sign . number_format(abs($percentage), 2);
        }


        return view('admin.transaction.index', compact('transactions', 'total', 'monthly', 'total_profit', 'monthly_profit', 'percentage'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
