<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Branch;
use App\Models\Menu;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;
use BinaryCats\Sku\HasSku;
class Category extends Model
{
   use \App\Http\Traits\UsesUuid ,HasSku;
    use HasFactory, Sluggable;

    protected $fillable = [
        'branch_id',
        'name',
        'slug',
        'image',
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
        return $this->belongsTo(Branch::class,'branch_id');
    } 
    public function menu()
    {
        return $this->hasMany(Menu::class, 'cat_id')->orderby('created_at',  'asc');
    }
    public function getImagePathAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }
}
