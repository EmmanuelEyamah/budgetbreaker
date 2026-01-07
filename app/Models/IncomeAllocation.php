<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeAllocation extends Model
{
    protected $fillable = [
        'income_id',
        'category_id',
        'allocated_amount',
        'percentage_used'
    ];

    protected $casts = [
        'allocated_amount' => 'decimal:2',
        'percentage_used' => 'decimal:2'
    ];

    public function income()
    {
        return $this->belongsTo(Income::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
