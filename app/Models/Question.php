<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'description',
        'is_fiexed'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function comment(){
        return $this->hasMany(QuestionComment::class,'question_id');
    }

    public function questionSave(){
        return $this->hasMany(QuestionSave::class,'question_id');
    }

    public function tag(){
        return $this->belongsToMany(Tag::class,'question_tags');
    }
}