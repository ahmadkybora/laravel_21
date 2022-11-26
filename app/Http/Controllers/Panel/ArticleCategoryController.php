<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCategoryRequest;
use App\Repositories\Repository;
use App\Models\ArticleCategory;
use App\Filters\Filter;
use App\Traits\FilterTrait;

class ArticleCategoryController extends Controller
{
    use FilterTrait;

    protected $article_category;
    protected $article_categories = [];
    protected $filter;
    public function __construct(ArticleCategory $article_category)
    {
        $this->article_category = new Repository($article_category);
        $this->filter = new Filter(ArticleCategory::class);
        // $this->filter = new Filter($user);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request->query('include'))
        //     $this->article_categories = $this->filter->filterByRelationship($request);

        // if($request->query('fields'))
        //     $this->article_categories = $this->filter->filterByMultiColumn($request);

        $this->article_categories = $this->filter($request, $this->article_category, $this->filter);

        return response()->json([
            'state' => true,
            'message' => __('general.success'),
            'data' => $this->article_categories,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ArticleCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleCategoryRequest $request)
    {
        // $this->article_category->create($request->only($this->article_category->getModel()));

        $article_category = new ArticleCategory();
        $article_category->title = $request->input('title');
        $article_category->author()->associate(1);
        if($article_category->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArticleCategory  $article
     * @return \Illuminate\Http\Response
     */
    public function show(ArticleCategory $article_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArticleCategory  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleCategory $article_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ArticleCategoryRequest  $request
     * @param  \App\Models\ArticleCategory  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleCategoryRequest $request, ArticleCategory $article_category)
    {
        $article_category->title = $request->input('title');
        $article_category->author()->associate(1);
        if($article_category->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArticleCategory  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleCategory $article_category)
    {
        // dd($article_category->id);
        // if($this->article_category->delete($article_category->id))
        if($article_category->delete())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }
}
