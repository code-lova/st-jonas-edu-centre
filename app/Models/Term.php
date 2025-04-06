<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
    protected $table = 'terms';
    protected $fillable = ['session_id', 'name', 'start_date', 'end_date'];

    public function session() {
        return $this->belongsTo(Session::class);
    }

    public function principalComments() {
        return $this->hasMany(PrincipalComment::class);
    }

    public function scores() {
        return $this->hasMany(Score::class);
    }
}
