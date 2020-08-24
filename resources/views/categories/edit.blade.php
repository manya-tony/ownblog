@extends('layouts.app')

@section('title', 'カテゴリ編集')

@section('content')
    <div class="container_s">
        <div class="article_link">
            <a href="{{ route('art.index') }}">← back</a>
        </div>
        <!-- カテゴリー追加 -->
        <form action="{{ route('category.store') }}" method="post" class="addForm mb_50">
            @csrf
            <h2 class="addForm_mainTitle">add category (20文字以内)</h2>
            <input type="text" name="category_name" value="{{ old('category_name') }}" maxlength="20" required />
            <input type="submit" value="add" />
        </form>

        <!-- カテゴリ一覧 -->
        <h2 class="addForm_mainTitle">categories</h2>
        @if($categories)
            <ul class="categoryEditList">
                @foreach($categories as $category)
                    <li>
                        <p>{{ $category->category_name }}</p>
                        <form action="{{ route('category.destroy', $category->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="delete">
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p>まだカテゴリは登録されていません</p>
        @endif
    </div>

@endsection