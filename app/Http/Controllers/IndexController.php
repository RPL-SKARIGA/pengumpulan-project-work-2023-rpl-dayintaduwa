<?php

namespace App\Http\Controllers;

use App\Models\Index;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $product = DB::table('products')->count();
        $bestseller = DB::table('detail_transactions')
            ->leftJoin('products', 'products.id', '=', 'detail_transactions.product_id')
            ->select('products.id', 'products.name', 'detail_transactions.product_id', DB::raw('SUM(detail_transactions.amount) as qty'))
            ->groupBy('products.id', 'detail_transactions.product_id', 'products.name')
            ->orderBy('qty', 'desc')
            ->first();
        $transaction = DetailTransaction::select(DB::raw('SUM(total) as qty'))
            ->whereRaw('MONTH(created_at) = '.Carbon::now()->month)
            ->first();
        $platform = DB::table('detail_transactions')
            ->leftJoin('transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
            ->select('transactions.id', 'transactions.type', 'detail_transactions.transaction_id', DB::raw('SUM(transactions.type) as qty'))
            ->groupBy('transactions.id', 'detail_transactions.transaction_id', 'transactions.type')
            ->orderBy('qty', 'desc')
            ->first();
        $productsell = DB::table('detail_transactions')
            ->leftJoin('products', 'products.id', '=', 'detail_transactions.product_id')
            ->select('products.id', 'products.name', 'detail_transactions.product_id', DB::raw('SUM(detail_transactions.total) as total'))
            ->groupBy('products.id', 'detail_transactions.product_id', 'products.name')
            ->get();
        
        return view('index', [
            'product' => $product,
            'bestseller' => $bestseller,
            'transaction' => $transaction,
            'platform' => $platform,
            'productsell' => $productsell
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Index  $index
     * @return \Illuminate\Http\Response
     */
    public function show(Index $index)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Index  $index
     * @return \Illuminate\Http\Response
     */
    public function edit(Index $index)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Index  $index
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Index $index)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Index  $index
     * @return \Illuminate\Http\Response
     */
    public function destroy(Index $index)
    {
        return redirect()->to("login");
    }
}
