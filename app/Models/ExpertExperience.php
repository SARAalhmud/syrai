<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertExperience extends Model
{
    use HasFactory;
  protected $fillable = [
'expert_id',
'name_compani',
'texte',
'spec',
'yers_start',
'yers_end'
  ];
   public function expert()
    {
        return $this->belongsTo(Expert::class, 'expert_id');
    }

}
