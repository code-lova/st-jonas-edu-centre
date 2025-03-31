<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSubjects extends Model
{
    use HasFactory;
    protected $table = 'teacher_subjects';
    protected $fillable = ['user_id', 'subject_id', 'class_id'];



    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function teacher(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
