<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialWellbeing extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function assessment()
    {
        return $this->hasMany(SocialWellbeingEvaluation::class);
    }
}
