<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'detail_user';
    
    protected $dates = [
        'updated_at',
        'deleted_at',
        'created_at'
    ];

    protected $fillable = [
        'user_id',
        'photo',
        'role',
        'contact_number',
        'biography',
        'updated_at',
        'deleted_at',
        'created_at'
    ];


    // Inverse Relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // Relation
    public function experience_users(): HasMany
    {
        return $this->hasMany(ExperienceUser::class, 'detail_user_id');
    }


}
