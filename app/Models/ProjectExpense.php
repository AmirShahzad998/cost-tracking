<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectExpense extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    /**
     * Get the project that owns the ProjectExpense
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expense()
    {
        return $this->belongsTo(Expense::class, 'expense_id');
    }
    public function project()
    {
        return $this->belongsTo(User::class, 'project_id');
    }
    
}
