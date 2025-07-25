<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jop extends Model
{
    use HasFactory;
        protected $fillable = [
            'jobTitle',
            'companyName',
            'jobType',
            'jobLocation',
            'experienceLevel',
            'salaryRange',
            'jobCategory',
            'jobDescription',
            'jobRequirements',
            'contactEmail',
'experts_id',
'companies_id',
'is_closed'

        ];


        public function expert()
    {
        return $this->belongsTo(Expert::class, 'experts_id');
    }

      public function company()
    {
        return $this->belongsTo(company::class, 'companies_id');
    }
}
