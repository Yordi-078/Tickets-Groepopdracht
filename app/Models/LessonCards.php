<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonCards extends Model
{
  
    protected $table = 'lesson_cards';
    public $timestamps = false;
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
