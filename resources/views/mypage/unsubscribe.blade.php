@extends('layouts.app')

@section('title', '退会')

@section('content')
<div class="container_s">
    <div class="back_link">
        <a href="{{ route('art.index') }}">← back</a>
    </div>
    <!-- 退会 -->
    <form action="{{ route('mypage.unsubscribe') }}" method="post" class="addForm">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <h2 class="addForm_mainTitle">unsubscribe</h2>
        <p>退会します。よろしいですか？</p>
        <input type="submit" value="unsubscribe" />
        <div class="clearBoth"></div>
    </form>
</div>
@endsection