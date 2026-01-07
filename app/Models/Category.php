<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'percentage',
        'current_balance',
        'is_active',
        'parent_id'
    ];

    protected $casts = [
        'percentage' => 'decimal:2',
        'current_balance' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function incomeAllocations()
    {
        return $this->hasMany(IncomeAllocation::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function getTotalAllocatedAttribute()
    {
        return $this->incomeAllocations()->sum('allocated_amount');
    }

    public function getTotalSpentAttribute()
    {
        return $this->expenses()->sum('amount');
    }

    public function isParent()
    {
        return $this->parent_id === null;
    }

    public function isChild()
    {
        return $this->parent_id !== null;
    }
}
