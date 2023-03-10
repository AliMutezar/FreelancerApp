<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'order_status';
    
    protected $dates = [
        'updated_at',
        'deleted_at',
        'created_at'
    ];

    protected $fillable = [
        'name',
        'updated_at',
        'deleted_at',
        'created_at'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'order_status_id');
    }
}
