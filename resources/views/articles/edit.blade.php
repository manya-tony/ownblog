@extends('layouts.app')

@section('title', '記事編集')

@section('content')

<div class="container_s">
    <div class="back_link">
        <a href="{{ route('art.index') }}">← back</a>
    </div>
    <form action="{{ route('art.update', $article->id) }}" method="post" class="addForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <h2 class="addForm_mainTitle">edit</h2>
        @if($errors->any())
            <ul class="err_msg_wrap">
                @foreach($errors->all() as $message)
                    <li class="err_msg">{{ $message }}</li>
                @endforeach
            </ul>
        @endif
        <label class="addForm_title" for="title">
            記事タイトル(50文字以内)
            <textarea name="title" rows="2" maxlength="50" required>{{ old('title', $article->title) }}</textarea>
        </label>
        <label class="addForm_title" for="category_id">
            記事カテゴリ
            <select name="category_id">
                <option value="">なし</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }} >{{ $category->category_name }}</option>
                @endforeach
            </select>
        </label>
        <label class="addForm_title" for="text">
            記事内容
            <textarea name="text" rows="20" required>{{ old('text', $article->text) }}</textarea>
        </label>
        <label class="addForm_title" for="image">
            記事画像変更
            <input type="file" name="image">
        </label>
        <input type="submit" value="edit" />
        <div class="clearBoth"></div>
    </form>
</div>

@endsection