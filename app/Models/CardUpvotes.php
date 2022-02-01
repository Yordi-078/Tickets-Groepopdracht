<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardUpvotes extends Model
{
    protected $table = 'card_upvotes';
    public $timestamps = false;
    protected $fillable = [
     'card_id', 'user_id'
    ];

}
