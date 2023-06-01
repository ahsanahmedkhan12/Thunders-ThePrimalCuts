<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class UserExtraDetail extends Model
{
    use \App\Http\Traits\UsesUuid ;
    use HasFactory;

    protected $fillable = [
        'country',
        'city',
        'zip_code',
        'state',
        'address',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
