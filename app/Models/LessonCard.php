<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonCard extends Model
{
    //protected $casts = [ 'finished_date' => 'datetime', ];
    protected $dates = ['finished_date'];

    protected $table = 'lesson_cards';
    public $timestamps = true;
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


    public function sfdg()
    {
      
    }

}
