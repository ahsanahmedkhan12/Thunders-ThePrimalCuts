<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Branch;
use App\Models\OrderDetail;
use BinaryCats\Sku\HasSku;
use BinaryCats\Sku\Concerns\SkuOptions;
class Order extends Model
{
    use \App\Http\Traits\UsesUuid ;
    use HasFactory,HasSku;

    protected $fillable = [
        'branch_id',
        'user_id',
        'session_id',
        'order_code',
        'payment_status',
        'order_status',
        'delivery_status',
        'subtotal',
        'discount',
        'total_payable',
        'instruction',
        'pickup_time',
    ];         

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    /**
     * Get the options for generating the Sku.
     *
     * @return BinaryCats\Sku\SkuOptions
    */
    public function skuOptions() : SkuOptions
    {
        return SkuOptions::make()
            ->from(['label', 'delivery_status'])
            ->target('order_code')
            ->using('_')
            ->forceUnique(true)
            ->generateOnCreate(true)
            ->refreshOnUpdate(true);
    }
}

