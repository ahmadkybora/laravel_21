<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCategoryRequest;
use App\Repositories\Repository;
use App\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{
    protected $category;
    protected $filter;
    public function __construct(ArticleCategory $category)
    {
        $this->category = new Repository($category);
        // $this->filter = new Filter($user);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'state' => true,
            'message' => __('general.success'),
            'data' => $this->category->all(),
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArticleCategory  $article
     * @return \Illuminate\Http\Response
     */
    public function show(ArticleCategory $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArticleCategory  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleCategory $category)
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
    public function update(ArticleCategoryRequest $request, ArticleCategory $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArticleCategory  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleCategory $article)
    {
        //
    }
}
