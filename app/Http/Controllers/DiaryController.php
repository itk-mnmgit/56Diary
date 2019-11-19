<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diary;
use App\Http\Requests\CreateDiary;

use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    public function index(){
        //diariesテーブルのdataを全件取得
        //取得した結果を画面で確認

        $diaries = Diary::all();
        // $diaries = Diary::where('title', 1)->first();
        // dd($diaries);
        //dd() var_dump と die が同時に実行される

        // views/diaries/index.blade.phpを表示
        //フォルダ名.ファイル名(blade.phpはいらない)
        //['キー' => 値]
        return view('diaries.index', ['diaries' => $diaries]);
    }

//日記の作成画面を表示する
    public function create()
    {
        return view('diaries.create');
    }

//新しい画面を保存する画面
    public function store(CreateDiary $request)
    {
        //Diaryモデルもインスタンスを作成
        $diary = new Diary();
        //Diaryモデルを使って、DBに日記を保存
        // dd($request->title);
        //インスタンス($diary)と繋がってるDB(diaries)のカラム(title)にrequestで得たtitleをぶち込む
        $diary->title = $request->title;
        $diary->body = $request->body;
        $diary->user_id = Auth::user()->id;
        //DBに保存
        $diary->save();

        //一覧ページにリダイレクト
        return redirect()->route('diary.index');
    }

    public function destroy(int $id)
    {
        //Diaryモデルを使用して、IDが一致する日記の取得
        $diary = Diary::find($id);

        //ログインユーザーが日記の投稿者かチェックする
        if(Auth::user()->id != $diary->user_id){
            // 投稿者のIDとログインユーザーのIDが違う場合
            abort(403);
        }

        //取得した日記の削除
        $diary->delete();
        //一覧画面にリダイレクト
        return redirect()->route('diary.index');
    }

    public function edit(Diary $diary)
    {
        //ログインユーザーが日記の投稿者かチェックする
        if(Auth::user()->id != $diary->user_id){
            // 投稿者のIDとログインユーザーのIDが違う場合
            abort(403);
        }
        // $diary = Diary::find($id);

        return view('diaries.edit', ['diary' => $diary]);
    }
    // 日記を更新し、一覧画面にリダイレクトする
    //$id : 編集対象の日記のID
    //$request : リクエストの内容。ここに画面で入力された内容が格納されている。
    public function update(int $id, CreateDiary $request)
    {
        //受け取ったIDを元に日記を取得
        $diary = Diary::find($id);

        //ログインユーザーが日記の投稿者かチェックする
        if(Auth::user()->id != $diary->user_id){
            // 投稿者のIDとログインユーザーのIDが違う場合
            abort(403);
        }

        //取得した日記のタイトル、本文を置き換える
        $diary->title = $request->title;
        $diary->body = $request->body;
        //DBに保存
        $diary->save();
        //一覧ページにリダイレクト
        return redirect()->route('diary.index');


    }
}
