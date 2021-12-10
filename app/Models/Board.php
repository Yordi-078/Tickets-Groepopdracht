<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Card;

class Board extends Model
{
    use HasFactory;
    protected $table = 'boards';
    public $timestamps = true;
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
    public function Users()
    {
        return $this->belongToMany(User::class);
    }
}
