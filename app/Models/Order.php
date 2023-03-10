<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'order';
    
    protected $dates = [
        'updated_at',
        'deleted_at',
        'created_at'
    ];

    protected $fillable = [
        'service_id',
        'freelancer_id',
        'buyer_id',
        'order_status_id',
        'file',
        'note',
        'expired',
        'updated_at',
        'deleted_at',
        'created_at'
    ];
}
