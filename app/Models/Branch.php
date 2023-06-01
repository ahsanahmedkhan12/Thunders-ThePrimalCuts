<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BranchTime;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;
use BinaryCats\Sku\HasSku;
class Branch extends Model
{ 
    use \App\Http\Traits\UsesUuid,HasSku ;
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'phone',
        'address',
        'status',
        'sku',
        'meta_title',
        'meta_description',
        'meta_keyword',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user()
    {
        return $this->hasMany(User::class, 'branch_id');
    }

    public function branchtime()
    {
        return $this->hasMany(BranchTime::class, 'branch_id')->orderby('position',  'asc');
    }
    
    public function category()
    {
        return $this->hasMany(Category::class, 'branch_id');
    }

    public function menu()
    {
        return $this->hasMany(Menu::class, 'branch_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'branch_id');
    }

    public function getImagePathAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }
}
