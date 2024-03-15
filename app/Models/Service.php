<?php

namespace App\Models;

use App\Traits\HasManyRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory, HasManyRequest;

    protected $fillable = ['name', 'description', 'fee'];

}
