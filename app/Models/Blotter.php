<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blotter extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'complainant',
        'respondent',
        'datetime',
        'location',
        'date_of_incident',
        'official_id',
        'statement',
        'is_solved'
    ];

    // ========================== Relationship ======================================================

    public function official():BelongsTo
    {
        return $this->belongsTo(Official::class);
    }

    // ========================== Custom Methods ======================================================

    public function registerMediaCollections(): void
    {
        $this->addMediaConversion('card')
        ->width(450)
        ->nonQueued();
    }

}