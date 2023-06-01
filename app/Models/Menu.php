<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Branch;
use App\Models\Category;
use App\Models\AddOnMenu;
use App\Models\OrderDetail;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;
use BinaryCats\Sku\HasSku;
class Menu extends Model
{ 
    use \App\Http\Traits\UsesUuid , HasSku;
    use HasFactory, Sluggable;

    protected $fillable = [
        'branch_id',
        'cat_id',
        'name',
        'slug',
        'image',
        'price',
        'status',
        'sku',
        'description',
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

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function addonmenu()
    {
        return $this->hasMany(AddOnMenu::class, 'menu_id');
    }

    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class, 'menu_id');
    }

    public function getImagePathAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }
}
