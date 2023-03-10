<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Service extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'service';
    
    protected $dates = [
        'updated_at',
        'deleted_at',
        'created_at'
    ];

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'delivery_time',
        'revision_limit',
        'price',
        'note',
        'updated_at',
        'deleted_at',
        'created_at'
    ];

    // Inverse Relationshop
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function advantage_users(): HasMany
    {
        return $this->hasMany(AdvantageUser::class, 'service_id');
    }

    public function taglines(): HasMany
    {
        return $this->hasMany(Tagline::class, 'service_id');
    }

    public function advantage_services(): HasMany
    {
        return $this->hasMany(AdvantageService::class, 'service_id');
    }

    public function thumbnail_services(): HasMany
    {
        return $this->hasMany(ThumbnailService::class, 'service_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'service_id');
    }
}
