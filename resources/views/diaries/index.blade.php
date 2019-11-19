<!-- layout.blade.phpを読み込む -->
@extends('layouts.app')

@section('title', '一覧')

@section('content')
<div class="text-center">
    <a href="{{ route('diary.create') }}" class="btn btn-secondary">新規投稿</a>
</div>
<div class="d-flex justify-content-around">
    @foreach($diaries as $diary)
    <div class="m-4 p-4 border border-secondary ">
        <p>{{$diary->title}}</p>
        <p>{{$diary->body}}</p>
        <p>{{$diary->created_at}}</p>

        {{-- Auth::check : ログインしていたらtrue, それ以外はfalse --}}
        {{-- ログインユーザのID == 投稿者ユーザID --}}
        @if (Auth::check() && Auth::user()->id == $diary->user_id)
            <a href="{{ route('diary.edit', ['id' => $diary->id]) }}" class="btn btn-success">編集</a>
            <form action="{{ route('diary.destroy', ['id' => $diary->id]) }}" method='POST' class='d-inline'>
            @csrf
            <!-- 送信方法はdeleteだよ -->
            @method('delete')
                <button class='btn btn-danger'>削除</button>
            </form>
        @endif

    </div>
    @endforeach
</div>
@endsection
