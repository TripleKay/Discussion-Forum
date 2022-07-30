<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'name',
    ];

    public function question(){
        return $this->belongsToMany(Question::class,'question_tags');
    }
}