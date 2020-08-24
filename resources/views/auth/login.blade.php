@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div class="container_s">
    <!-- ログイン -->
    <form action="{{ route('login') }}" method="post" class="addForm mb_30">
        @csrf
        <h2 class="addForm_mainTitle">login</h2>
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
            password<br />
            <input type="password" name="password" minlength="8" maxlength="16" required />
        </label>
        <input type="submit" value="login" />
        <div class="clearBoth"></div>
    </form>
    <a class="addForm_link" href="{{ route('password.request') }}">パスワードをお忘れのかたはコチラ</a>
</div>
@endsection