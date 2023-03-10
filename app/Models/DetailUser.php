<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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


}
