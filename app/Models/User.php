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
        'graduation_status',
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

    public function scores() {
        return $this->hasMany(Score::class, 'student_id');
    }

    public function attendance() {
        return $this->hasMany(StudentAttendance::class, 'student_id');
    }

    public function teacherComment() {
        return $this->hasMany(TeacherComment::class, 'student_id');
    }

    /**
     * Get the class hierarchy for automatic promotion
     * Class progression order based on the school structure
     */
    public static function getClassHierarchy()
    {
        return [
            17 => 16, // CRECHE → PRE KG
            16 => 4,  // PRE KG → KG 1
            4 => 5,   // KG 1 → KG 2
            5 => 6,   // KG 2 → KG 3
            6 => 7,   // KG 3 → PRIMARY 1
            7 => 8,   // PRIMARY 1 → PRIMARY 2
            8 => 9,   // PRIMARY 2 → PRIMARY 3
            9 => 10,  // PRIMARY 3 → PRIMARY 4
            10 => 11, // PRIMARY 4 → PRIMARY 5
            11 => 12, // PRIMARY 5 → PRIMARY 6
            12 => 1,  // PRIMARY 6 → JSS 1
            1 => 2,   // JSS 1 → JSS 2
            2 => 3,   // JSS 2 → JSS 3
            3 => 13,  // JSS 3 → SS 1
            13 => 14, // SS 1 → SS 2
            14 => 15, // SS 2 → SS 3
            15 => null, // SS 3 → GRADUATION (no next class)
        ];
    }

    /**
     * Get the next class for a given class ID
     */
    public static function getNextClass($classId)
    {
        $hierarchy = self::getClassHierarchy();
        return $hierarchy[$classId] ?? null;
    }

    /**
     * Check if a class is the final class (SS 3)
     */
    public static function isFinalClass($classId)
    {
        return $classId == 15; // SS 3
    }

}
