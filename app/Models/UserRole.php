<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    const TEACHER_ROLE = 2;
    

    protected $table = 'user_roles';
    public $timestamps = true;
    protected $fillable = [
     'name'
    ];

    public function user()
    {
      return $this->belongsToMany(User::class);
    }

}
