<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    public function post(){
        return $this->hasMany(Post::class);
    }
    // gets all the users followrs
    //フォローされてる人
    public function followers(){
        return $this->hasMany(Follow::class,'following_id');
    //  following_idをもとにfollowerを探す。
    }
    //フォローしている人
    public function following(){
        return $this->hasMany(Follow::class,'follower_id');
}
    //自分がフォローしている人を見つける(フォロワーの中に自分を含む人)
    public function isFollowed(){
        return $this->followers()->where('follower_id',Auth::User()->id)->exists();
    }





}
