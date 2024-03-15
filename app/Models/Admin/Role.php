<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    public const ADMIN = 1;
    public const SECRETARY = 2;
    public const RESIDENT = 3;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}