<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class GraduatedStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'sex',
        'date_of_birth',
        'phone_number',
        'address',
        'profile_pic',
        'student_id',
        'graduated_from_class_id',
        'academic_year',
        'graduation_date',
        'graduation_note',
        'batch_id',
        'processed_by'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'graduation_date' => 'date',
    ];

    /**
     * Get the class the student graduated from
     */
    public function graduatedFromClass()
    {
        return $this->belongsTo(Classes::class, 'graduated_from_class_id');
    }

    /**
     * Get the admin who processed the graduation
     */
    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Get full name attribute
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->firstname} {$this->lastname}"
        );
    }

    /**
     * Scope to filter by academic year
     */
    public function scopeByAcademicYear($query, $year)
    {
        return $query->where('academic_year', $year);
    }

    /**
     * Scope to filter by graduation date range
     */
    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('graduation_date', [$startDate, $endDate]);
    }

    /**
     * Get all available academic years
     */
    public static function getAvailableAcademicYears()
    {
        return self::select('academic_year')
                   ->distinct()
                   ->orderBy('academic_year', 'desc')
                   ->pluck('academic_year');
    }

    /**
     * Get graduation statistics
     */
    public static function getGraduationStats()
    {
        return [
            'total_graduates' => self::count(),
            'current_year_graduates' => self::byAcademicYear(self::getCurrentAcademicYear())->count(),
            'by_year' => self::selectRaw('academic_year, COUNT(*) as count')
                            ->groupBy('academic_year')
                            ->orderBy('academic_year', 'desc')
                            ->get()
        ];
    }

    /**
     * Get current academic year (helper method)
     */
    public static function getCurrentAcademicYear()
    {
        $currentYear = date('Y');
        $currentMonth = date('n');

        // Academic year typically runs September to August
        if ($currentMonth >= 9) {
            return $currentYear . '/' . ($currentYear + 1);
        } else {
            return ($currentYear - 1) . '/' . $currentYear;
        }
    }
}
