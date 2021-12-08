<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonCards extends Model
{
                     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson_cards';

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
     'name', 'user_id', 'board_id','description','status','start_time','finished_date'
    ];

    public function board()
    {
      return $this->belongsTo(Board::class);
    }
    public function Users()
    {
      return $this->belongToMany(User::class);
    }

}
