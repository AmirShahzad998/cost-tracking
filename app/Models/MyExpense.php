<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyExpense extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];



    /**
     * Get the expense that owns the MyExpense
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expense()
    {
        return $this->belongsTo(Expense::class, 'expense_id');
    }
}
