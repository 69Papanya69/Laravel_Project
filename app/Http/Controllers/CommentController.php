<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Notifications\NewCommentNotify;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Jobs\VeryLongJob;
use App\Models\Article;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $article = Article::findOrFail($request->article_id);
        $request->validate([
            'name'=>'required|min:3',
            'desc'=>'required|max:256',
        ]);
        $comment = new Comment();
        $comment->name = $request->name;
        $comment->desc = $request->desc;
        $comment->article_id = request('article_id');
        $comment->user_id = Auth::id();
        if ($comment->save()){
            VeryLongJob::dispatch($comment, $article->name);
        return redirect()->back()->with('status', 'Your comment has been added for moderatorion!');}
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
public function show()
{
    $Comments = Comment::all();
    return view('comments.show', [
        'Comments' => $Comments,
    ]);
}
public function accept(Comment $comment)
{
    $users = User::where('id', '!=', $comment->user_id)->get();
        $article = Article::findOrFail($comment->article_id);
    $comment->accept = true;
    if ($comment->save()) Notification::send($users, new NewCommentNotify($article, $comment->name));
    return redirect()->route('comment.show')->with('status', 'Comment accepted');
}

public function reject(Comment $comment)
{
    $comment->accept = false;
    $comment->save();
    return redirect()->route('comment.show')->with('status', 'Comment rejected');
}
}