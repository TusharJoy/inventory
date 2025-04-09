<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory;

    protected $primaryKey = 'warehouse_id';

    protected $fillable = [
        'street',
        'city',
        'zip_code',
        'capacity',
        'storage_type'
    ];

    protected $casts = [
        'capacity' => 'decimal:2'
    ];
}
