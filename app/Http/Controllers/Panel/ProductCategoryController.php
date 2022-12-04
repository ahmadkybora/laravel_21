<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use App\Repositories\Repository;
use App\Models\ProductCategory;
use App\Filters\Filter;
use App\Traits\FilterTrait;

class ProductCategoryController extends Controller
{
    use FilterTrait;

    protected $product_category;
    protected $product_categories = [];
    protected $filter;

    public function __construct(ProductCategory $product_category)
    {
        $this->product_category = new Repository($product_category);
        $this->filter = new Filter(Bank::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->product_categories = $this->filter($request, $this->bank, $this->filter);
        return response()->json([
            'state' => true,
            'message' => __('general.success'),
            'data' => $this->product_categories,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $request)
    {
        $product_category = new ProductCategory();
        $product_category->brand()->associate($request->input('brand_id'));
        $product_category->title = $request->input('title');
        if($product_category->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $article
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $product_category)
    {
        if($product_category)
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => $product_category,
            ], 200);
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
        $product_category->brand()->associate($request->input('brand_id'));
        $product_category->title = $request->input('title');
        if($product_category->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
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
