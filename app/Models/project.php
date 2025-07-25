<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    protected $fillable = [
        'experts_id','projectname','projectdescription','projectlink','projectskills','projectimages',    'beginners_id'
    ];

   protected $casts = [
    'projectskills' => 'array',
    'projectimages' => 'array',
];

 public function expert()
    {
        return $this->belongsTo(Expert::class, 'experts_id');
    }
     public function beginner()
    {
        return $this->belongsTo(beginner::class, 'beginners_id');
    }
     public function student()
    {
        return $this->belongsTo(student::class, 'students_id');
    }
      public function company()
    {
        return $this->belongsTo(company::class, 'companies_id');
    }
}

