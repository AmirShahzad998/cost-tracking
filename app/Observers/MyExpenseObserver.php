<?php

namespace App\Observers;

use App\Models\MyExpense;
use App\Models\Transaction;

class MyExpenseObserver
{
    /**
     * Handle the MyExpense "created" event.
     *
     * @param  \App\Models\MyExpense  $myExpense
     * @return void
     */
    public function created(MyExpense $myExpense)
    {
        $data = [
            'expense_id' => $myExpense->expense_id,
            'my_expense_id' => $myExpense->id,
            'title' => $myExpense->title,
            'date' => $myExpense->date,
            'slug' => getSlug(),
            'type' => "Out",
            'amount' => $myExpense->expense,
            'description' => $myExpense->description,
        ];

        Transaction::create($data);
    }

    /**
     * Handle the MyExpense "updated" event.
     *
     * @param  \App\Models\MyExpense  $myExpense
     * @return void
     */
    public function updated(MyExpense $myExpense)
    {
        //
    }

    /**
     * Handle the MyExpense "deleted" event.
     *
     * @param  \App\Models\MyExpense  $myExpense
     * @return void
     */
    public function deleted(MyExpense $myExpense)
    {
        //
    }

    /**
     * Handle the MyExpense "restored" event.
     *
     * @param  \App\Models\MyExpense  $myExpense
     * @return void
     */
    public function restored(MyExpense $myExpense)
    {
        //
    }

    /**
     * Handle the MyExpense "force deleted" event.
     *
     * @param  \App\Models\MyExpense  $myExpense
     * @return void
     */
    public function forceDeleted(MyExpense $myExpense)
    {
        //
    }
}
