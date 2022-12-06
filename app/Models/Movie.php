<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    protected $fillable = [
        'image',
        'name',
        'type_id',
        'detail',
        'link_video',
        'rating'
    ];
    public function type(){
        return $this->belongsTo(type::class);
    }
    public function comments(){
        
        return $this->hasMany(comment::class );
    }
    public function likes(){
        
        return $this->hasMany(likes::class );
    }
    public function clicks(){
        
        return $this->hasMany(clicks::class );
    }

   

}
