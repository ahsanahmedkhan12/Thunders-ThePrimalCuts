<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\OrderDetailAddOn;
class AddOnMenu extends Model
{ 
    use \App\Http\Traits\UsesUuid ;
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'name',
        'price',
        'position'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

     public function orderdetailaddon()
    {
        return $this->hasMany(OrderDetailAddOn::class, 'add_on_menu_id');
    }


}
