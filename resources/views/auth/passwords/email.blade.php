@extends('layouts.app')

@section('title', 'パスワードリセット')

@section('content')
<div class="container_s">
    <!-- パスワードリセット -->
    <form action="{{ route('password.email') }}" method="post" class="addForm">
        @csrf
        <h2 class="addForm_mainTitle">password reset</h2>
        <p class="addForm_text">ご登録のメールアドレスにパスワード再設定用のメールをお送りします。</p>
        @if($errors->any())
            <ul class="err_msg_wrap">
                @foreach($errors->all() as $message)
                    <li class="err_msg">{{ $message }}</li>
                @endforeach
            </ul>
        @endif
        <label class="addForm_title" for="email">
            email<br />
            <input type="email" name="email" value="{{ old('email') }}" required />
        </label>
        <input type="submit" value="send" />
    </form>
</div>
@endsection
