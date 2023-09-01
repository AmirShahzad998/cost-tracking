<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }


    public function expense()
    {
        return $this->belongsTo(Expense::class, 'expense_id');
    }
    public function my_expense()
    {
        return $this->belongsTo(MyExpense::class, 'my_expense_id');
    }

    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
