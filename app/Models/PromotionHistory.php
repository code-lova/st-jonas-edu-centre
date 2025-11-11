<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionHistory extends Model
{
    use HasFactory;

    protected $table = 'promotion_history';

    protected $fillable = [
        'batch_id',
        'student_id',
        'from_class_id',
        'to_class_id',
        'previous_last_class_passed',
        'previous_graduation_status',
        'new_graduation_status',
        'operation_type',
        'promoted_at',
        'is_rolled_back',
    ];

    protected $casts = [
        'promoted_at' => 'datetime',
        'is_rolled_back' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function fromClass()
    {
        return $this->belongsTo(Classes::class, 'from_class_id');
    }

    public function toClass()
    {
        return $this->belongsTo(Classes::class, 'to_class_id');
    }

    /**
     * Get the latest promotion batch that can be rolled back
     */
    public static function getLatestRollbackableBatch()
    {
        return self::where('is_rolled_back', false)
                   ->orderBy('promoted_at', 'desc')
                   ->first();
    }

    /**
     * Check if a batch can be rolled back
     */
    public static function canRollback($batchId = null)
    {
        if (!$batchId) {
            $latestBatch = self::getLatestRollbackableBatch();
            $batchId = $latestBatch ? $latestBatch->batch_id : null;
        }

        return $batchId && self::where('batch_id', $batchId)
                               ->where('is_rolled_back', false)
                               ->exists();
    }
}
