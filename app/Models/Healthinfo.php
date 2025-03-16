<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Healthinfo extends Model
{
    use HasFactory;
    protected $table = 'healthinfos';
    protected $fillable = [
        'user_id',
        'abnormal_behaviour',
        'description',
        'child_general_health_condition',
    ];
}
