<?php

namespace App\Http\Controllers;

use App\Category;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests\CreateArticle;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Auth::user()->categories()->get();
        $articles = Auth::user()
                    ->articles()
                    ->with('category')
                    ->oederBy('updated_at', 'desc')
                    ->get();

        return view('articles.index', compact('categories', 'articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Auth::user()->categories()->get();

        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticle $request)
    {
        $article = new Article();

        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->text = $request->text;
        if ($request->hasFile('image')) {
            $time = time();
            $user_id = Auth::id();
            $path = $request->image->storeAs('public/images', $user_id.'_'.$time.'.jpg');
            $article->image = basename($path);
        }
        
        Auth::user()->articles()->save($article);

        return redirect()->route('art.index')->with('flash_message', '記事を作成しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $article = Article::find($id);
        $user_id = Auth::id();

        if($article && $article->user_id === $user_id) {
            $current_id = $id;
            return view('articles.article', compact('article', 'current_id'));
        } else {
            return redirect()->route('art.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $article = Article::find($id);
        $user_id = Auth::id();

        if($article && $article->user_id === $user_id) {
            $categories = Auth::user()->categories()->get();
            return view('articles.edit', compact('article', 'categories'));
        } else {
            return redirect()->route('art.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateArticle $request, int $id)
    {
        $article = Article::find($id);
        $user_id = Auth::id();

        if($article && $article->user_id === $user_id) {
            $article->title = $request->title;
            $article->category_id = $request->category_id;
            $article->text = $request->text;
            if ($request->hasFile('image')) {
                if($article->image) {
                    $path = storage_path().'/app/public/images/'.$article->image;
                    \File::delete($path);
                }
                $time = time();
                $user_id = Auth::id();
                $path = $request->image->storeAs('public/images', $user_id.'_'.$time.'.jpg');
                $article->image = basename($path);
            }
            $article->save();
        }

        return redirect()->route('art.index')->with('flash_message', '記事を編集しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $article = Article::find($id);
        $user_id = Auth::id();

        if($article && $article->user_id === $user_id) {
            if($article->image) {
                $path = storage_path().'/app/public/images/'.$article->image;
                \File::delete($path);
            }
            $article->delete();
        }

        return redirect()->route('art.index')->with('flash_message', '記事を削除しました');
    }
}
