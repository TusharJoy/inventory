<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Market extends Model
{
    use HasFactory;

    protected $primaryKey = 'market_id';

    protected $fillable = [
        'market_name',
        'location',
        'contact_person',
        'contact_number',
        'email',
        'market_status',
        'notes'
    ];

    protected $casts = [
        'market_status' => 'string'
    ];
}
