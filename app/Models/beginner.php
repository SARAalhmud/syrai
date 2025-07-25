<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class beginner extends Model
{
   protected $fillable=[
    'user_id',
     'field_of_interest',
      'Current_level',
      'learning_goals',
      'bio'
   ];
   public function User(){
    return $this->belongsTo(User::class);
   }
   public function projects()
{
    return $this->hasMany(project::class, 'beginners_id');
}

}
