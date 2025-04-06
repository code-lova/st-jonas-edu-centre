<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'teacher_id',
        'class_id',
        'subject_id',
        'term_id',
        'session_id',
        'first_test',
        'second_test',
        'exam'
    ];

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function class() {
        return $this->belongsTo(Classes::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function term() {
        return $this->belongsTo(Term::class);
    }

    public function session() {
        return $this->belongsTo(Session::class);
    }
}
