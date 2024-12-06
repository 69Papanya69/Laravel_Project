<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Article $article){
        $request->validate([
            'name'=>'required|min:3',
            'desc'=>'required|max:256',
        ]);
        $comment = new Comment();
        $comment->name = $request->name;
        $comment->desc = $request->desc;
        $comment->article_id = request('article_id');
        $comment->user_id = Auth::id();
        $comment->save();
        return redirect()->back();
    }

    public function edit($id){
        $comment = Comment::findOrFail($id);
        Gate::authorize('update-comment', $comment);
        return view('comments.update',['comment'=>$comment]);
    }
    
    public function update(Request $request, Comment $comment){
        Gate::authorize('update-comment', $comment);
        $request->validate([
            'name'=>'required|min:3',
            'desc'=>'required|max:256',
        ]);
        $comment->name = $request->name;
        $comment->desc = $request->desc;
        $comment->save();
        return redirect()->route('article.show', ['article'=>$comment->article_id]);
    }
    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        Gate::authorize('update_comment', $comment);
        $comment->delete();
        return redirect()->route('article.show', ['article' => $comment->article_id])->with('status', 'Delete success');
}
}