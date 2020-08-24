@extends('layouts.app')

@section('title', '記事作成')

@section('content')
    <div class="container_s">
        <div class="back_link">
            <a href="{{ route('art.index') }}">← back</a>
        </div>
        <!-- 記事追加 -->
        <form action="{{  route('art.store') }}" method="post" class="addForm" enctype="multipart/form-data">
            @csrf
            <h2 class="addForm_mainTitle">add article</h2>
            @if($errors->any())
                <ul class="err_msg_wrap">
                    @foreach($errors->all() as $message)
                        <li class="err_msg">{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
            <label class="addForm_title" for="title">
                記事タイトル(50文字以内)
                <textarea name="title" rows="2" maxlength="50" required></textarea>
            </label>
            <label class="addForm_title" for="category_id">
                記事カテゴリ
                <select name="category_id">
                    <option value="">なし</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="addForm_title" for="text">
                記事内容
                <textarea name="text" rows="20" required></textarea>
            </label>
            <label class="addForm_title" for="image">
                記事画像
                <input type="file" name="image">
            </label>
            <input type="submit" value="add" />
            <div class="clearBoth"></div>
        </form>
    </div>
@endsection