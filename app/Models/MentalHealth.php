<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentalHealth extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'question' => 'string',
    ];

    public function assessment()
    {
        return $this->hasMany(MentalHealthEvaluation::class);
    }
}
