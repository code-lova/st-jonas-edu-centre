<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;
    protected $table = 'student_attendances';
    protected $fillable = [
        'teacher_id',
        'student_id',
        'class_id',
        'term_id',
        'term_id',
        'session_id',
        'times_present'
    ];


    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher(){
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
