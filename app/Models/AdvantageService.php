<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvantageService extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'advantage_service';
    
    protected $dates = [
        'updated_at',
        'deleted_at',
        'created_at'
    ];

    protected $fillable = [
        'service_id',
        'advantage',
        'updated_at',
        'deleted_at',
        'created_at'
    ];
}
