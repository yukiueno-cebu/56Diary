<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


     //$fillableここに設定されたカラム以外は値が設定できないようにする
    protected $fillable = [
        'name', 'email', 'password','picture_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function diaries()
    {
        //$this=users テーブル
        //usersテーブルは0以上diariesテーブルのデータを持っている
        return $this->hasMany('App/Diary');
    }
}
