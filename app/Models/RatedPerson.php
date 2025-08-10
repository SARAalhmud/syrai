<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatedPerson extends Model
{
    use HasFactory;
 protected $fillable = [
        'rater_id',
        'rated_id',
        'rated_type',
        'rating_value',
        'comment',
    ];


    // علاقة المقيّم (الشخص اللي عمل التقييم)
  public function rated()
{
    return $this->morphTo();
}

public function rater()
{
    return $this->belongsTo(User::class, 'rater_id');
}
}



