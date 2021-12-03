<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Board;

class Card extends Model
{
                 /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cards';

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
     'name', 'description','board_id'
    ];

    public function board(){
      return $this->belongsTo(Board::class);
    }

    public function sortCard(){
      $sortCards = $this->hasMany(Card::class)->orderBy('created_at');
    }
}
