<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diary;

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
        return view('diaries.index', [
            //キー => 値
            'diaries' => $diaries
        ]);
    }
}
