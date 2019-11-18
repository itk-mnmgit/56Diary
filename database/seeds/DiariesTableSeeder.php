<?php

// use = require_once

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DiariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //配列でサンプルデータ作成
        $diaries = [
            [
                'title' => '初めてのLaravel',
                'body' => '土曜の午後、暇だぁ〜',
            ],
            [
                'title' => '初めての英語',
                'body' => 'Hello, world.',
            ],
            [
                'title' => '初めてのRsan',
                'body' => '日曜の午後、暇だぁ〜',
            ]
        ];
        //IDが一番若いユーザーを取得
        $user = DB::table('users')->first();

        //配列をループで回して、テーブルにINSERTする
        foreach ($diaries as $diary)
        {
            DB::table('diaries')->insert([
                'title' => $diary['title'],
                'body' => $diary['body'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'user_id' => $user->id,
                //現在時刻を取得 Carbon::now()
            ]);
        }
    }
}
