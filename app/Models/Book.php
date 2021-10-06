<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getReviewsByMale($condition, $value)
    {
        return $this->reviews->where('sex', 'm')
            ->where('age', $condition, $value);
    }

    public function getReviewsByFemale($condition, $value)
    {
        return $this->reviews->where('sex', 'f')
            ->where('age', $condition, $value);
    }
}
