<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{

    //日記テーブルとユーザーテーブルの多対多の接続設定
    //
    public function likes()
    {
        //diaryテーブルとusersテーブルは
        //likesテーブルを介して多対多の関係性である（withTimestamps）は接続とは関係がない。
        return $this->belongsToMany('App\User','likes')
        ->withTimestamps();
    }
}
