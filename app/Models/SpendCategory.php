<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpendCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function budgetCategory()
    {
        return $this->belongsTo(BudgetCategory::class);
    }

    public function spendItems()
    {
        return $this->hasMany(SpendItem::class);
    }
}
