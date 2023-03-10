<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagline extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'taqline';
    
    protected $dates = [
        'updated_at',
        'deleted_at',
        'created_at'
    ];

    protected $fillable = [
        'service_id',
        'taqline',
        'updated_at',
        'deleted_at',
        'created_at'
    ];

    // Inverse Relationship
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
