<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
      protected $fillable = [
    'user_id',
    'Company_Name',
    'Business_sector',
    'Company_Size',
    'bio',
    'CompanyServices'
];
  protected $casts = [
    'CompanyServices' => 'array',

];
public function user()
{
    return $this->belongsTo(User::class);
}

public function projects()
{
    return $this->hasMany(project::class, 'companies_id');
}
public function jops()
{
    return $this->hasMany(jop::class, 'companies_id');
}
  public function masej()
{
    return $this->hasMany(masej::class, 'companies_id');
}


public function ratingsReceived()
{
    return $this->hasMany(RatedPerson::class, 'companies_id');
}

}
