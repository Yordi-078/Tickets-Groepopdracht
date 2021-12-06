<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonUpvotes extends Model
{
                    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson_upvotes';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
     'card_id', 'user_id'
    ];

}
