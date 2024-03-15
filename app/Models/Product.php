<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'slug',
        'code',
        'name',
        'description',
        'price',
        'qty',
        'is_available',
        'manufactured_at',
        'expired_at',
    ];


    // ==============================Relationship==================================================

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}