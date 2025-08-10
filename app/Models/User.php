<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'first_name',
        'last_name',
        'email',
        'password',
        'Governorate',
        'Phone_Number',
        'type',
        'social_links',
         'skills',
         'image',
         'cv_path'
    ];

    protected $casts = [
    'skills' => 'array',
    'social_links' => 'array',
];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

public function expert(){
    return $this->hasOne(Expert::class);
}
public function beginner(){
    return $this->hasOne(beginner::class);
}
public function compan()
{
    return $this->hasOne(Company::class, 'user_id');  // تأكد إن اسم العمود هو user_id
}

public function  student(){
    return $this->hasOne(student::class);
}

}
