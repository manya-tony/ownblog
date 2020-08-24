@extends('layouts.app')

@section('title', 'パスワード変更')

@section('content')
<div class="container_s">
    <div class="back_link">
        <a href="{{ route('art.index') }}">← back</a>
    </div>
    <!-- パスワード変更 -->
    <form action="{{ route('mypage.password.update') }}" method="post" class="addForm">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <h2 class="addForm_mainTitle">password change</h2>
        @if($errors->any())
            <ul class="err_msg_wrap">
                @foreach($errors->all() as $message)
                    <li class="err_msg">{{ $message }}</li>
                @endforeach
            </ul>
        @endif
        <label class="addForm_title" for="current_password">
            current password<br />
            <input type="password" name="current_password" minlength="8" maxlength="16" required />
        </label>
        <label class="addForm_title" for="password">
            new password (半角英数字記号 8文字以上16文字以内)<br />
            <input type="password" name="password" pattern="^[a-zA-Z0-9-_]+$" minlength="8" maxlength="16" required />
        </label>
        <label class="addForm_title" for="password_confirmation">
            password again<br />
            <input type="password" name="password_confirmation" minlength="8" maxlength="16" required />
        </label>
        <input type="submit" value="change" />
        <div class="clearBoth"></div>
    </form>
</div>
@endsection