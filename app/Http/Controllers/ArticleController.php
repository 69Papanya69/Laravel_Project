<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(6);
        return view('article.index', ['articles' => $articles]);
    }

    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', [self::class]);
        $request->validate([
            'date' => 'date',
            'name' => 'required|min:5|max:100',
            'desc' => 'required|min:5',
        ]);
        $article = new Article;
        $article->date = $request->date;
        $article->name = $request->name;
        $article->desc = $request->desc;
        $article->user_id = 1;
        $article->save();
        return redirect('/article');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $user = User::findOrFail($article->user_id);
        // Получение комментариев статьи с автором
        $comments = $article->comments()->with('user')->get();
        return view('article.show', [
            'article' => $article,
            'user' => $user,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('article.update', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        Gate::authorize('update', $article->id);
        // $response = Gate::inspect('update', $article->id);
        $request->validate([
            'date' => 'date',
            'name' => 'required|min:5|max:100',
            'desc' => 'required|min:5',
        ]);
        $article->date = $request->date;
        $article->name = $request->name;
        $article->desc = $request->desc;
        $article->user_id = 1;
        if ($article->save())
            return redirect('/article')->with('status', 'Update succsess!');
        else
            return redirect('')->route('article.edit', ['article' => $article->id])->with('status', 'Update failed! Please try again.');
        ;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        Gate::authorize('delete', [self::class]);
        if ($article->delete())
            return redirect('/article')->with('status', value: 'Delete succsess!');
        else
            return redirect('')->route('article.show', ['article' => $article->id])->with('status', 'Delete failed! Please try again.');
    }
}