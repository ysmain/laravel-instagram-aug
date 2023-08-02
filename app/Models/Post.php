<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }
// withTrashed()を置くことで論理削除されたユーザーも認識される（ポストー＞ユーザー）。
// これが無いとポストはあるのにユーザーが認識されずエラーになる。
    public function category_post(){
        return $this->hasMany(CategoryPost::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class)->latest();
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function isLiked(){
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
                                                                // ↑存在を確認してTrueかFalseを返す。@ifで使える。
    }


}
