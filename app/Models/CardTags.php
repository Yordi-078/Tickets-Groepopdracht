<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardTags extends Model
{
    protected $table = 'card_tags';
    public $timestamps = false;
    protected $fillable = [
    'tag_id', 'card_id', 'board_id'
    ];
}
