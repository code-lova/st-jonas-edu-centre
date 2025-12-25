<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherComment extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'teacher_id', 'class_id', 'term_id', 'session_id', 'comment'];

    public function student() {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function class() {
        return $this->belongsTo(Classes::class);
    }

    public function term() {
        return $this->belongsTo(Term::class);
    }

    public function session() {
        return $this->belongsTo(Session::class);
    }
}
