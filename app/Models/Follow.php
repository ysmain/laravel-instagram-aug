<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function follower(){
        return $this->belongsTo(User::class,'follower_id');
        // migration上で指定した同じreferenceが2つある場合、↑使う方を指定する。
        // Userテーブルへfollower_idで参照している。
    }

    public function following(){
        return $this->belongsTo(User::class,'following_id');
    }
}
