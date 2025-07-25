<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
   protected $fillable = [
    'user_id',
    'job_title_en',
    'specialization',
    'years_of_experience',
    'availability',
    'bio',
    'yers_end',
    'yers_start',
    'spec',
    'texte',
    'name_compani'
];
public function user(){
    return $this->belongsTo(User::class);
}
public function experiences()
{
    return $this->hasMany(ExpertExperience::class, 'expert_id');
}
public function projects()
{
    return $this->hasMany(project::class, 'experts_id');
}
public function jops()
{
    return $this->hasMany(jop::class, 'experts_id');
}
}
