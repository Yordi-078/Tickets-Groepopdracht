<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardUser extends Model
{
    protected $table = 'board_user';
    public $timestamps = false;
    protected $fillable = [
     'board_id', 'user_id'
    ];
    protected $primaryKey = 'post_id';
}
