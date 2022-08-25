<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Question;
use App\Models\QuestionComment;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'last_seen',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['onlineStatus'];

    //questions
    public function question(){
        return $this->hasMany(Question::class,'user_id','id');
    }

    //comment
    public function comment(){
        return $this->hasMany(QuestionComment::class,'user_id','id');
    }

    //user online check
    public function userOnlineCheck(){
        if(Cache::has('user-is-online-' . $this->id)){
            return 'online';
        }else{
            return Carbon::parse($this->last_seen)->diffForHumans();
        }
    }

    //added online status to user
    public function getOnlineStatusAttribute(){
        return $this->userOnlineCheck();
    }
}