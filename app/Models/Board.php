<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Card;

class Board extends Model
{
              /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'boards';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
 
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'madeby_id', 'description'
    ];

    public function Cards()
    {
        return $this->hasMany(Card::class)->orderBy('created_at', 'desc');;
    }

    public function LessonCards()
    {
        return $this->hasMany(LessonCards::class);
    }
}
