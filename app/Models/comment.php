<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail',
        'rating',
        'user_id',
        'movie_id'
        
    ];
    public function movie(){
        return $this->belongsTo(Movie::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
