<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherComment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'class_id', 'term_id', 'session_id', 'comment'];

    public function student() {
        return $this->belongsTo(User::class, 'user_id');
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
