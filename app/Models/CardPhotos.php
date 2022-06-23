<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardPhotos extends Model
{
    protected $table = 'card_photos';
    public $timestamps = false;
    protected $fillable = [
    'card_id', 'photo_id'
    ];
}
