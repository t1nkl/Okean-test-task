<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner',
        'status',
        'services',
    ];
    protected $casts = [
        'services' => 'array',
    ];
}
