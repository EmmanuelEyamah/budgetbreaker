<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'amount',
        'source',
        'description',
        'received_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'received_at' => 'date'
    ];

    public function allocations()
    {
        return $this->hasMany(IncomeAllocation::class);
    }
}
