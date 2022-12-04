<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BankRequest;
use App\Repositories\Repository;
use App\Models\Bank;
use App\Filters\Filter;
use App\Traits\FilterTrait;

class BankController extends Controller
{
    use FilterTrait;
    
    protected $bank;
    protected $banks = [];
    protected $filter;

    public function __construct(Bank $bank)
    {
        $this->bank = new Repository($bank);
        $this->filter = new Filter(Bank::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->banks = $this->filter($request, $this->bank, $this->filter);
        if($this->banks)
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => $this->banks,
            ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BankRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankRequest $request)
    {
        $bank = new Bank();
        $bank->title = $request->input('title');
        $bank->account_number = $request->input('account_number');
        if($bank->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        if($bank)
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => $bank,
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BankRequest  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(BankRequest $request, Bank $bank)
    {
        $bank->title = $request->input('title');
        $bank->account_number = $request->input('account_number');
        if($bank->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        if($bank->delete())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }
}
