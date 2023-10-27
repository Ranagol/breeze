<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function comments(){
        return $this->hasMany(Comment::class); //jedan post moze imati vise komentara
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
