<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Repositories\Repository;
use App\Models\Product;
use App\Traits\FilterTrait;

class ProductController extends Controller
{
    use FilterTrait;

    protected $product;
    protected $products = [];
    protected $filter;

    public function __construct(Product $product)
    {
        $this->product = new Repository($product);
        // $this->filter = new Filter($user);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->products = $this->filter($request, $this->bank, $this->filter);
        return response()->json([
            'state' => true,
            'message' => __('general.success'),
            'data' => $this->products,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->category()->associate($request->input('category_id'));
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        if($request->hasFile('image'))
        {
            $path = Storage::disk('public')->putFile('images/products', $request->file('image'));
            if (!empty($product->image) and file_exists('storage/' . $product->image));
            Storage::disk('public')->delete($product->image);
            $product->image = $path;
        }
        if($product->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if($product)
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->category()->associate($request->input('category_id'));
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        if($request->hasFile('image'))
        {
            $path = Storage::disk('public')->putFile('images/products', $request->file('image'));
            if (!empty($product->image) and file_exists('storage/' . $product->image));
            Storage::disk('public')->delete($product->image);
            $product->image = $path;
        }
        if($product->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->delete())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }
}
