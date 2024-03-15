<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    use HasFactory, BelongsToUser;

    public const PENDING = 0;
    public const APPROVED = 1;
    public const DECLINED = 2;

    protected $fillable = [
        'user_id',
        'service_id',
        'purpose',
        'business_name',
        'business_type',
        'business_location',
        'resident_type',
        'residency_year',
        'status',
        'remark',
        'paypal_transaction_id'
    ];


    // ==============================Relationship==================================================

    public function service():BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}