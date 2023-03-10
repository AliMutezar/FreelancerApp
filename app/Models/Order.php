<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    // Inverse Relationship
    public function user_buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function user_freelancer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function order_status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }
}
