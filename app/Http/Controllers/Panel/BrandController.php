<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Repositories\Repository;
use App\Models\Brand;
use App\Filters\Filter;
use App\Traits\FilterTrait;

class BrandController extends Controller
{
    use FilterTrait;
    
    protected $brand;
    protected $brands = [];
    protected $filter;

    public function __construct(Brand $brand)
    {
        $this->brand = new Repository($brand);
        $this->filter = new Filter(Brand::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->brands = $this->filter($request, $this->brand, $this->filter);
        if($this->brands)
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => $this->brands,
            ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $brand = new Brand();
        $brand->name = $request->input('brand');
        if($brand->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        if($brands)
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => $brands,
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $brand->name = $request->input('brand');
        if($brand->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if($brand->delete())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }
}
