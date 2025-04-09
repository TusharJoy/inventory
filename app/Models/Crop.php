<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Crop extends Model
{
    use HasFactory;

    protected $primaryKey = 'crop_id';
    public $incrementing = false;

    protected $fillable = [
        'batch_id',
        'crop_name',
        'crop_type',
        'crop_variety',
        'growing_season',
        'planting_date',
        'expected_harvest_date',
        'actual_harvest_date',
        'yield_amount',
        'yield_unit',
        'crop_status',
        'notes'
    ];

    protected $casts = [
        'planting_date' => 'date',
        'expected_harvest_date' => 'date',
        'actual_harvest_date' => 'date',
        'yield_amount' => 'decimal:2'
    ];

    /**
     * Get the batch that owns the crop.
     */
    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'batch_id', 'batch_id');
    }
}
