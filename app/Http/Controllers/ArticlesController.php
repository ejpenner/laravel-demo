<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Article;
use App\Tag;
use Session;
use Validator;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$articles = Article::latest('published_at')->get();
        //$articles = Article::latest('published_at')->where('published_at', '<=', Carbon::now())->get();

        $articles = Article::latest('published_at')->published()->get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::lists('name','id');
        return view('articles.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {

        $article = new Article($request->all());

        $article->setImage($request);
        $article->setThumbnail($request);
        $article->setPublishedAtAttribute(Carbon::now());

        Auth::user()->articles()->save($article);

        $article->tags()->attach($request->input('tag_list'));
        // sending back with message
        Session::flash('success', 'Created Article Successfully');

        // create the new article;
        // return to the index
        return Redirect('articles')->with('message', 'Article created');

    } // end uploader



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    { //277r16095
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $tags = Tag::lists('name','id');
        //$tagsList = $article->tags()->pluck('id');

        //dd($tagsList);
        if(Auth::user()->id == $article->user_id)
        {
            return view('articles.edit', compact('article','tags'));
        } else {
            Session::flash('message', 'You cannot edit this article');
            return Redirect::route('articles.show', $article->id);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->update($request->except('image','published_at')); // first update the texts only

        $imageStatus = $article->updateImage($request);

        if($request->input('tag_list') === null) {
            $tagList = [];
        } else {
            $tagList = $request->input('tag_list');
        }
        $article->tags()->sync($tagList);

        return redirect('articles/'.$article->id.'')->with('message', 'Updated Article Successfully'.$imageStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $deleteText = '';
        if($article->deleteImages()) {
            $deleteText = 'and successfully deleted the files!';
        } else {
            $deleteText = 'and file deletion failed!';
        }
        $article->tags()->detach();
        $article->delete();
        // redirect to the article index


        return Redirect('articles')->with('message','Article deleted, '.$deleteText.'');
    }
}
