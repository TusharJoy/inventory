<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    use HasFactory;

    protected $primaryKey = 'batch_id';

    protected $fillable = [
        'farmer_id',
        'batch_name',
        'start_date',
        'expected_end_date',
        'actual_end_date',
        'batch_status',
        'notes'
    ];

    protected $casts = [
        'start_date' => 'date',
        'expected_end_date' => 'date',
        'actual_end_date' => 'date'
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'farmer_id');
    }

    public function crops()
    {
        return $this->hasMany(Crop::class, 'batch_id');
    }
}
