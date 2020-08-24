@extends('layouts.app')

@section('title')
{{ $article->title }}@endsection

@section('content')
    <div class="container_s">
        <!-- 記事詳細 -->
        <div class="article">
            <div class="article-link">
                <div class="article-link_left">
                    <a href="{{ route('art.index') }}">← back</a>
                </div>
                <div class="article-link_right">
                    <form action="{{ route('art.destroy', $current_id) }}" method="POST" name="delete">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" value="delete" class="js-delete-aleart">
                    </form>
                    <span>/</span>
                    <a href="{{ route('art.edit', $current_id) }}">edit</a>
                </div>
            </div>
            <div class="article-imgWrap">
                @if($article->image)
                    <img class="article-img" src="{{ asset('storage/app/public/images/'.$article->image) }}" alt="{{ $article->title }}">
                @else
                    <img class="article-img" src="{{ asset('images/sample.png') }}" alt="{{ $article->title }}">
                @endif
            </div>
            <h1 class="article-title">{{ $article->title }}</h1>
            <p class="article-day">{{ $article->updated_at }}<span class="article-category">{{ optional($article->category)->category_name }}</span></p>
            <p class="article-text">{{ $article->text }}</p>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function(){
            $('.js-delete-aleart').on('click', function(){
                var result = window.confirm('削除してもよろしいですか？');
                if(result){
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
@endsection