<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Requests\WalletRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Repository;
use App\Models\Wallet;
use App\Traits\FilterTrait;

class WalletController extends Controller
{
    use FilterTrait;

    protected $wallet;
    protected $wallets = [];
    protected $filter;
    public function __construct(Wallet $wallet)
    {
        $this->wallet = new Repository($wallet);
        // $this->filter = new Filter($filter);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->wallets = $this->filter($request, $this->wallet, $this->filter);
        return response()->json([
            'state' => true,
            'message' => __('general.success'),
            'data' => $this->wallets,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWalletRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWalletRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet)
    {
        if($wallet)
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => $wallet,
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWalletRequest  $request
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWalletRequest $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
