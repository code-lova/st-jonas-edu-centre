<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'username',
        'email',
        'phone',
        'whatsApp_contact',
        'password',
        'role',
        'sex',
        'date_of_birth',
        'passport',
        'place_of_birth',
        'blood_group',
        'genotype',
        'residential_address',
        'local_govt_origin',
        'religion',
        'nationality',
        'previous_school',
        'last_class_passed',
        'current_class_applying',
        'class_teacher',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function healthInfo(){
        return $this->hasOne(Healthinfo::class, 'user_id', 'id');
    }

    public function parentInfo(){
        return $this->hasOne(ParentInfo::class, 'user_id', 'id');
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class, 'teacher_subjects', 'user_id', 'subject_id');
    }

    public function class(){
        return $this->belongsTo(Classes::class,'class_teacher', 'id');
    }

    public function currentClassApplying(){
        return $this->belongsTo(Classes::class, 'current_class_applying', 'id');
    }

    public function lastClassPassed(){
        return $this->belongsTo(Classes::class, 'last_class_passed', 'id');
    }

    public function comments(){
        return $this->hasOne(PrincipalComment::class, 'user_id', 'id');

    }

}
