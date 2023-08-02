<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $table = 'category_posts';
    // モデルとテーブルの名前が異なるときには、このようにテーブル名を明確に設定できる。
    public $timestamps = false;
    // ↑migratationでtimestampsを消した場合に入力する。しないとエラーが出る。
    protected $fillable = [
        'post_id',
        'category_id'
    ];


    public function category(){
        return $this->belongsTo(Category::class);
    }

}
