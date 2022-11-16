<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use App\Repositories\Repository;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    protected $product_category;
    protected $filter;
    public function __construct(ProductCategory $product_category)
    {
        $this->product_category = new Repository($product_category);
        // $this->filter = new Filter($user);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json([
            'state' => true,
            'message' => __('general.success'),
            'data' => $this->product_category->all(),
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
     * @param  \App\Http\Requests\ProductCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $article
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $product_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $product_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductCategoryRequest  $request
     * @param  \App\Models\ProductCategory  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $request, ProductCategory $product_category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $product_category)
    {
        if($product_category->delete())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }
}
