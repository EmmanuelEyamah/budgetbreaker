<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'category_id',
        'amount',
        'description',
        'spent_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'spent_at' => 'date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
