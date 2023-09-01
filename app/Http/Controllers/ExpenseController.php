<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::withSum('my_expenses', 'expense')->orderBy('created_at','desc')->get();
        return view('admin.expense.index', compact('expenses'));
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
        $data = $request->validate([
            'expense_name' => ['required'],
        ]);
        $data['slug'] = getSlug();
        Expense::create($data);
        return back()->with('status', 'A New Expense has been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return view('admin.expense.show', compact('expense'));
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

    public function expense_store(Request $request)
    {
        $data = $request->validate([
            'expense_id' => ['required'],
            'title' => ['nullable', 'string', 'min:3', 'max:255'],
            'date' => ['required'],
            'expense' => ['required', 'integer'],
            'description' => ['nullable', 'string', 'min:3', 'max:255'],
        ]);

        $expense = Expense::findOrFail($request->expense_id);
        $data['slug'] = getSlug();

        if(!$request->title){
            $data['title'] = "Expense";
        }
        if(!$request->description){
            $data['description'] = "Expense has been added: ({$request->expense})";
        }

        $data['date'] = Carbon::parse($request->date)->setTimeFromTimeString(now()->toTimeString());


        $expense->my_expenses()->create($data);

        return back()->with('status', 'A Expense has been Added');
    }
}
