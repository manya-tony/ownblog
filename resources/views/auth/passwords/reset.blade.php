@extends('layouts.app')

@section('title', 'パスワードリセット')

@section('content')
<div class="container_s">
    <!-- パスワードリセット -->
    <form action="{{ route('password.update') }}" method="post" class="addForm">
        @csrf
        <h2 class="addForm_mainTitle">password reset</h2>
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
        <label class="addForm_title" for="password">
            password (半角英数字記号 8文字以上16文字以内)<br />
            <input type="password" name="password" pattern="^[a-zA-Z0-9-_]+$" minlength="8" maxlength="16" required />
        </label>
        <label class="addForm_title" for="password_confirmation">
            password again<br />
            <input type="password" name="password_confirmation" required />
        </label>
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="submit" value="reset" />
    </form>
</div>
@endsection
