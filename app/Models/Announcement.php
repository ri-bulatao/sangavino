<?php

namespace App\Models;

use App\Traits\HasManyComment;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;

class Announcement extends Model implements HasMedia
{
    use HasFactory, 
    HasManyComment,
    InteractsWithMedia;

    protected $fillable = ['title', 'content', 'has_sms', 'sms_announcement'];

    
    // ============================== Accessor & Mutator ==========================================

    public function getCoverPhotoAttribute()
    {
        return optional($this->getFirstMedia('announcement_images'))->getUrl();
    }

    // ========================== Custom Methods ======================================================

    public function registerMediaCollections(): void
    {
        $this->addMediaConversion('card')
        ->width(450)
        ->nonQueued();
    }
}