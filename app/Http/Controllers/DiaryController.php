<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Diaryモデルを使用する宣言

use App\Diary;
use App\Http\Requests\CreateDiary;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{

    //一覧画面を表示する

    public function index()
    {
        //diariesデーブルのデータを全件取得する。
        //取得した結果を画面で確認。

        $diaries = Diary::all();
        // dd($diaries);
        //dd();var_dump と dieが同時に実行される
        //views/diaries/index.blade.phpを表示
        //フォルダ名.ファイル名(blade.phpは覗く)
        return view('diaries.index',[
            'diaries' => $diaries
            //.キー =>値
        ]);
    }
    //日記の作成画面を表示する
    public function create()
    {
        return view('diaries.create');
    }
    //新しい日記の保存をする画面
    public function store(CreateDiary $request)
    {
        //Diaryモデルのインスタンスを作成
        $diary = new Diary();

        //Diaryモデルを使って、DBに日記を保存
       //$diary->カラム名 = カラム　に設定したい値
        $diary->title = $request->title;
        $diary->body = $request->body;

        $diary->user_id = Auth::user()->id;

        //DBに保存実行
        $diary->save();
        //一覧ページにリダイレクト
        return redirect()->route('diary.index');

    }

    //日記を削除する為のメソッド
    public function destroy (int $id)
    {

        //diaryモデルを使用してIDが一致する日記の取得
        $diary = Diary::find($id);
        //取得した日記の削除
        $diary->delete();
        //一覧画面にリダイレクト
        return redirect()->route('diary.index');
    }

    //編集画面を表示する
    public function edit(int $id)
    {
        // 受け取ったIDを元に日記を取得する
        $diary = Diary::find($id);
        //編集画面を返す。同時に画面に取得した日記を渡す。

        return view('diaries.edit',[
            'diary' => $diary
            //.キー =>値
        ]);
    }
    //日記を更新し、一覧画面にリダイレクトする
    //-$id:編集対象の日記のID
    //-$request:リクエストの内容。ここに画面で入力された文字が格納されている。

    public function update(int $id, Creatediary $request)
    {
    //受け取ったIDを元に日記を取得
    $diary = Diary::find($id);
    //取得した日記のタイトル、本文を書き換える
    //Diaryモデルを使って、DBに日記を保存
       //$diary->カラム名 = カラム　に設定したい値
       $diary->title = $request->title;
       $diary->body = $request->body;

       //DBに保存実行
       $diary->save();
    
    //一眼ページにリダイレクト
    return redirect()->route('diary.index');
    
    }
}
