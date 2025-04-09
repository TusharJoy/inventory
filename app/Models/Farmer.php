<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Farmer extends Model
{
    use HasFactory;

    protected $primaryKey = 'farmer_id';

    protected $fillable = [
        'name',
        'street',
        'city',
        'zip_code'
    ];
}
