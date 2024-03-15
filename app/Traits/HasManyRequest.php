<?php 

namespace App\Traits;

use App\Models\Request;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyRequest {

    public function requests():HasMany
    {
        return $this->hasMany(Request::class);
    }
}