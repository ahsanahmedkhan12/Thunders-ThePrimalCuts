<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Role extends Model
{
    use HasFactory, \App\Http\Traits\UsesUuid;

    protected $fillable = [
        'role',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'role_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}

