<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];



    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function my_expenses()
    {
        return $this->hasMany(MyExpense::class);
    }
}
