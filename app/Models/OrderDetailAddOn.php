<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
use App\Models\AddOnMenu;
class OrderDetailAddOn extends Model
{
    use \App\Http\Traits\UsesUuid ;
    use HasFactory;

    protected $fillable = [
        'order_detail_id',
        'add_on_menu_id',
        'quantity',
        'subtotal',
    ];         

    public function orderdetail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }

    public function addonmenu()
    {
        return $this->belongsTo(AddOnMenu::class, 'add_on_menu_id');
    }
}


