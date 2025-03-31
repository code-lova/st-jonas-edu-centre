<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';
    protected $fillable = ['subject_name', 'class_id'];

    public function class(){
        return $this->belongsTo(Classes::class,'class_id', 'id');
    }

    public function teachers(){
        return $this->belongsToMany(User::class, 'teacher_subjects', 'subject_id', 'user_id');
    }

}
