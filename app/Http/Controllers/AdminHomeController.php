<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function dashboard()
    {
        $payments = Transaction::where('type', 'In')->orderBy('created_at','desc')->take(5)->get();
        $my_expenses = Transaction::where('type', 'Out')->orderBy('created_at','desc')->take(5)->get();

        $expenses = Expense::withSum('my_expenses', 'expense')->orderBy('created_at','desc')->get();


        $total = [
            'revenue' => Transaction::where('type', 'In')->sum('amount'),
            'expense' => Transaction::where('type', 'Out')->sum('amount'),
        ];

        $monthly = [
            'revenue' => Transaction::where('type', 'In')->whereMonth('created_at', Carbon::now()->month)->sum('amount'),
            'expense' => Transaction::where('type', 'Out')->whereMonth('created_at', Carbon::now()->month)->sum('amount'),
        ];
        $prev_month = [
            'revenue' => Transaction::where('type', 'In')->whereMonth('created_at', Carbon::now()->subMonth())->sum('amount'),
            'expense' => Transaction::where('type', 'Out')->whereMonth('created_at', Carbon::now()->subMonth())->sum('amount'),
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

        return view('admin.dashboard', compact('payments', 'my_expenses', 'expenses', 'total', 'monthly', 'total_profit', 'monthly_profit', 'percentage'));
    }
}
