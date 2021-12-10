<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonUpvotes extends Model
{
    protected $table = 'lesson_upvotes';
    public $timestamps = false;
    protected $fillable = [
     'card_id', 'user_id'
    ];

}
