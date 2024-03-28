<?php

namespace App\Models;

use App\Models\Admin\Role;
use App\Traits\HasManyComment;
use App\Traits\HasManyRequest;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use HasFactory, 
    HasManyRequest, 
    HasManyComment, 
    Notifiable, 
    InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'role_id',
        'resident_id',
        'is_activated',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // ==============================Relationship==================================================

    public function avatar():HasOne
    {
        return $this->hasOne(Media::class, 'model_id', 'id');
    }

    public function role():BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function resident():BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }


    // ========================== Local Scopes ======================================================

    public function scopeRoleResident($query)
    {
        return $query->where('role_id', Role::RESIDENT);
    }

    // ============================== Accessor & Mutator ==========================================

    public function getAvatarProfileAttribute()
    {
        return optional($this->getFirstMedia('avatar_image'))->getUrl('avatar');
    }
    
    public function getAvatarThumbnailAttribute()
    {
        return optional($this->getFirstMedia('avatar_image'))->getUrl('thumbnail');
    }


    // ========================== Custom Methods ======================================================

    public function registerMediaCollections(): void
    {
        $this->addMediaConversion('avatar')
        ->width(512)
        ->nonQueued();

        $this->addMediaConversion('thumbnail')
        ->width(120)
        ->nonQueued();
    }

    public function hasRole($role) {
        return $this->role()->where('name', $role)->first() ? true : false;
    }

    // ========================== Local Scope ======================================================

    public function scopeByRole($query, $role)
    {
        return $query->whereRelation('role', 'name', $role);
    }
}