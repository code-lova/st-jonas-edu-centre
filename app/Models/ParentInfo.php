<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentInfo extends Model
{
    use HasFactory;
    protected $table = 'parent_infos';
    protected $fillable = [
        'user_id',
        'parent_name',
        'parent_address',
        'occupation',
        'fathers_phone',
        'mothers_phone',
    ];
}
