<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//DB(diaries)を操作するためのモデル
class Diary extends Model
{
    //日記テーブルとユーザーテーブルの多対多の接続設定
    public function likes()
    {
        //diariesテーブルとusersテーブルはlikesテーブルを介して多対多の関係
        //$this(diaries)とApp\User(users)をlikesを介して繋ぐ
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }
}
