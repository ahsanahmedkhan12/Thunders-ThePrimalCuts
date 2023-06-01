<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Branch;
use App\Models\Order;
use App\Models\UserExtraDetail;
use Illuminate\Support\Str;
class User extends Authenticatable 
{
    use \App\Http\Traits\UsesUuid ;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'status',
        'role_id',
        'branch_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class,  'role_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function hasRole($role){
       if($this->role()->where(Str::lower('role'), $role)->first()){
        return true;
       }
       return false;
    }

    public function hasAnyRoles($role){
       if($this->role()->whereIn(Str::lower('role'), $role)->first()){
        return true;
       }
       return false;
    }


    public function userextradetail()
    {
        return $this->hasMany(UserExtraDetail::class, 'user_id');
    }

}

