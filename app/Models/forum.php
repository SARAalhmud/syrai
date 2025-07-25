<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class forum extends Model
{
    use HasFactory;
       protected $fillable = [
            'section',
            'title',
            'content',
            'keywords',
            'views',
            'replies_count',

'experts_id',
'companies_id',
'beginners_id',
'students_id',
'user_id',
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
 public function getAuthorFirstNameAttribute()
{
    if ($this->expert) {
        return $this->expert->user->first_name ?? 'مستخدم غير معروف';
    }
    if ($this->student) {
        return $this->student->user->first_name ?? 'مستخدم غير معروف';
    }
    if ($this->beginner) {
        return $this->beginner->user->first_name ?? 'مستخدم غير معروف';
    }
    if ($this->company) {
        return $this->company->user->first_name ?? 'مستخدم غير معروف';
    }

    return 'مستخدم غير معروف';
}



}

