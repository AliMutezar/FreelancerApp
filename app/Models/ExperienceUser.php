<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExperienceUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'experience_user';
    
    protected $dates = [
        'updated_at',
        'deleted_at',
        'created_at'
    ];

    protected $fillable = [
        'detail_user_id',
        'experience'
    ];

    // Inverse Relationship
    public function detail_user(): BelongsTo
    {
        return $this->belongsTo(DetailUser::class, 'detail_user_id');
    }
}
