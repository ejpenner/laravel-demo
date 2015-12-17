<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Article;
use App\Comment;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Session;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except'=>['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article)
    {
        return redirect('articles/'.$article->id.'');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Article $article, User $user)
    {
        return view('comments.create', compact('article','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Article $article, Request $request)
    {
        $comment = new Comment($request->all());
        $comment->setUserIdAttribute();
        $comment->setPublishedAtToNow();
        //DB::table('comments')->insert(['user_id'=>Auth::user()->id, 'article_id'=>$article->id, 'body'=>$request->body, 'published_at'=>Carbon::now() ]);

        $article->comments()->save($comment);

        return Redirect::route('articles.show', $article->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return Redirect::route('articles.show', $article->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article, Comment $comment)
    {
        if ($comment->user_id == Auth::user()->id)
        {
            return view('comments.edit', compact('comment', 'article'));
        } else {
            Session::flash('message', 'You cannot edit this comment');
            return Redirect::route('articles.show',$article->id);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article, Comment $comment)
    {
            $comment->update($request->all());

            Session::flash('success', 'Comment edited');

            return Redirect::route('articles.show',$article->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article, Comment $comment)
    {
       // $article->comments()->where('id', $comment->id)->delete();
        $article->comments()->delete();

        Session::flash('success', 'Comment deleted');

        return Redirect::route('articles.show',$article->id);
    }
}
