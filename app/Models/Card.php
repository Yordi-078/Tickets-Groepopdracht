<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Board;

class Card extends Model
{
    protected $table = 'cards';
    public $timestamps = true;
    protected $fillable = [
     'name', 'description', 'board_id', 'helper_id', 'status', 'image'
    ];

    public function board()
    {
      return $this->belongsTo(Board::class);
    }
    /** upvotes cards-users */
    public function Users()
    {
        return $this->belongToMany(User::class);
    }
}
