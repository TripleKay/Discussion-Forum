<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\QuestionViewer;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected $appends = ['time','viewCount'];

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

    public function getTimeAttribute(){
        $time = new Carbon($this->created_at);
        return $time->diffForHumans();
    }

    public function getViewCountAttribute(){
        $viewCount = QuestionViewer::select(DB::raw('COUNT(id) as view_count'))->where('question_id',$this->id)->value('view_count');
        return $viewCount;
    }
}