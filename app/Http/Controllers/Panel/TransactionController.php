<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Repositories\Repository;
use App\Models\Transaction;
use App\Traits\FilterTrait;

class TransactionController extends Controller
{
    use FilterTrait;

    protected $transaction;
    protected $transactions = [];
    protected $filter;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = new Repository($transaction);
        // $this->filter = new Filter($user);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->transactions = $this->filter($request, $this->transaction, $this->filter);
        return response()->json([
            'state' => true,
            'message' => __('general.success'),
            'data' => $this->transactions,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $transaction = new Transaction();
        $transaction->owner()->associate($request->input('user_id'));
        $transaction->bank()->associate($request->input('bank_id'));
        $transaction->transaction_code = $request->input('transaction_code');
        $transaction->amount = $request->input('amount');
        if($transaction->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        if($transaction)
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => $this->transaction,
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $transaction->owner()->associate($request->input('user_id'));
        $transaction->bank()->associate($request->input('bank_id'));
        $transaction->transaction_code = $request->input('transaction_code');
        $transaction->amount = $request->input('amount');
        if($transaction->save())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        if($transaction->delete())
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => '',
            ], 200);
    }
}
