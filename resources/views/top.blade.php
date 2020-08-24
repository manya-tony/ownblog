@extends('layouts.app')

@section('title', 'わたしだけが見られるわたしだけのためのブログサービス')

@section('content')
    <div class="container_s">
        <div class="top">
            <!-- タイトル -->
            <h1>OWN <span>Blog</span></h1>
            <h2>わたしだけが見られる<br />わたしだけのためのブログサービス</h2>
            
            <!-- リンク -->
            <ul>
                <li><a href="{{ route('login') }}">login</a></li>
                <li><a href="{{ route('register') }}">register</a></li>
            </ul>
        </div>
    </div>
@endsection