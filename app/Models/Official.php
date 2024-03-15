<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Official extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'position_id',
        'name',
        'contact',
        'is_active'
    ];

    // ============================== Relationship ==========================================


    public function position():BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    // ============================== Accessor & Mutator ==========================================

    public function getAvatarProfileAttribute()
    {
        return optional($this->getFirstMedia('avatar_image'))->getUrl('avatar');
    }
    
    // ========================== Custom Methods ======================================================

    public function registerMediaCollections(): void
    {
        $this->addMediaConversion('avatar')
        ->width(300)
        ->nonQueued();
    }

    // ========================== Scope ======================================================

    public function scopeByPosition($query, $position)
    {
        return $query->whereRelation('position', 'name', $position);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

}