<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpendItem extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'amount', 'date', 'spend_category_id'];

    public function spendCategory()
    {
        return $this->belongsTo(SpendCategory::class);
    }
}
