<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Menu;
use App\Models\OrderDetailAddOn;
class OrderDetail extends Model
{
    use \App\Http\Traits\UsesUuid ;
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'subtotal',

    ];         

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function orderdetailaddon()
    {
        return $this->hasMany(OrderDetailAddOn::class, 'order_detail_id');
    }
}

