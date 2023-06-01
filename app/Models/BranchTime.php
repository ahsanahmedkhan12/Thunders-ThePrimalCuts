<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
use App\Models\weekday;
class BranchTime extends Model
{
    use \App\Http\Traits\UsesUuid ;
    use HasFactory;

     protected $fillable = [
        'branch_id',
        'weekday_id',
        'start_time',
        'stop_time',
        'position'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    } 

    public function weekday()
    {
        return $this->belongsTo(WeekDay::class, 'weekday_id');
    }
}
