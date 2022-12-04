<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Repositories\Repository;
use App\Models\Article;
use App\Filters\Filter;
use App\Traits\FilterTrait;

class ArticleController extends Controller
{
    use FilterTrait;
    
    protected $article;
    protected $articles = [];
    protected $filter;

    public function __construct(Article $article)
    {
        $this->article = new Repository($article);
        $this->filter = new Filter(Article::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->articles = $this->filter($request, $this->article, $this->filter);
        if($this->articles)
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => $this->articles,
            ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article();
        $article->title = $request->input('title');
        $article->title = $request->input('description');
        $article->author()->associate($request->input('user_id'));
        $article->category()->associate($request->input('category_id'));
        if($request->hasFile('image'))
        {
            $path = Storage::disk('public')->putFile('images/articles', $request->file('image'));
            if (!empty($user->avatar_uri) and file_exists('storage/' . $user->avatar_uri));
            Storage::disk('public')->delete($user->avatar_uri);
            $user->avatar_uri = $path;
        }
        if($article->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        if($article)
            return response()->json([
                'state' => true,
                'message' => 'success',
                'data' => $article,
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->title = $request->input('title');
        $article->title = $request->input('description');
        $article->author()->associate($request->input('user_id'));
        $article->category()->associate($request->input('category_id'));
        if($request->hasFile('image'))
        {
            $path = Storage::disk('public')->putFile('images/articles', $request->file('image'));
            if (!empty($user->avatar_uri) and file_exists('storage/' . $user->avatar_uri));
            Storage::disk('public')->delete($user->avatar_uri);
            $user->avatar_uri = $path;
        }
        if($article->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if($article->delete())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }
}
