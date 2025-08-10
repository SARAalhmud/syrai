<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
       protected $fillable = [
    'user_id',
    'University',
    'University_Major',
    'Acabemic_Year',
    'technica_interests',
    'bio',
    'students_id'
];
public function user(){
    return $this->belongsTo(User::class);
}
   public function projects()
{
    return $this->hasMany(project::class, 'students_id');
}
  public function masej()
{
    return $this->hasMany(masej::class, 'students_id');
}
 public function ratingsReceived()
{
    return $this->hasMany(RatedPerson::class, 'students_id');
}

}
