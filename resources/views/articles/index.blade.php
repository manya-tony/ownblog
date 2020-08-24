@extends('layouts.app')

@section('title')
{{ Auth::user()->name }}さんのブログ@endsection

@section('content')

    <div id="app">
        <example-component :categories="{{ $categories }}" :articles="{{ $articles }}"></example-component>
    </div>
    
@endsection