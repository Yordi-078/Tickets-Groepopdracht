<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
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
