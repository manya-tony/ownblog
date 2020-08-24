@extends('layouts.app')

@section('title', 'プロフィール変更')

@section('content')
<div class="container_s">
    <div class="back_link">
        <a href="{{ route('art.index') }}">← back</a>
    </div>
    <!-- プロフィール変更 -->
    <form action="{{ route('mypage.profile.update') }}" method="post" class="addForm">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <h2 class="addForm_mainTitle">profile edit</h2>
        @if($errors->any())
            <ul class="err_msg_wrap">
                @foreach($errors->all() as $message)
                    <li class="err_msg">{{ $message }}</li>
                @endforeach
            </ul>
        @endif
        <label class="addForm_title" for="name">
            name (20文字以内)<br />
            <input type="text" name="name" value="{{ old('name', $user->name) }}" maxlength="20" required />
        </label>
        <label class="addForm_title" for="email">
            email<br />
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required />
        </label>
        <input type="submit" value="edit" />
        <div class="clearBoth"></div>
    </form>
</div>
@endsection