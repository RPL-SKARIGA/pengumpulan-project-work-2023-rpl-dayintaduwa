<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();

        return view('transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = DB::table('products')
        ->select('products.id', 'stocks.stock', 'products.name','products.price')
        ->join('stocks', 'stocks.product_id', 'products.id')
        ->get();

        return view('transaction.create', compact('products')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'buyer_name' => 'required',
            'type' => 'required',
            'product_id.*' => 'required',
            'amount.*' => 'required',
        ]);

        $transaction = Transaction::create([
            'buyer_name' => $request->buyer_name,
            'type' => $request->type,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        foreach ($request->product_id as $key => $value) {
            ${$key} = Stock::where('product_id', $value)->firstOrFail();

            if(${$key}->stock >= $request->amount[$key]) {
                // $request->validate([
                //     'buyer_name' => 'required',
                //     'type' => 'required',
                // ]);

                $detail = DetailTransaction::create([
                    'transaction_id' => $transaction['id'],
                    'product_id' => $request->product_id[$key],
                    'amount' => $request->amount[$key],
                    'price' => $request->price[$key],
                    'total' => $request->total[$key],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
        
                ${$key}->update([
                    'stock' => ${$key}->stock - $request->amount[$key],
                    'updated_by' => auth()->user()->id,
                    'product_id' => $request->product_id[$key], 
                ]);
            }
        }
        return redirect()->route('transaction.index')->with('success','Transaction has been created successfully.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $transaction = DB::table('transactions')
        ->select('transactions.id', 'transactions.buyer_name', 'transactions.type', 'detail_transactions.product_id', 'detail_transactions.amount', 'detail_transactions.price', 'detail_transactions.total', 'products.name as product_name')
        ->join('detail_transactions', 'detail_transactions.transaction_id', 'transactions.id')
        ->join('products', 'detail_transactions.product_id', 'products.id')
        ->where(['transactions.id' => $id])
        ->get();

        return view('transaction.detail', ['transaction' => $transaction]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $transaction = Transaction::findOrFail($id);
        $transaction = DB::table('transactions')
        ->select('transactions.id', 'transactions.buyer_name', 'transactions.type', 'detail_transactions.product_id', 'detail_transactions.amount', 'detail_transactions.price', 'detail_transactions.total')
        ->join('detail_transactions', 'detail_transactions.transaction_id', 'transactions.id')
        ->where(['transactions.id' => $id])
        ->get();

        $products = DB::table('products')
        ->select('products.id', 'stocks.stock', 'products.name','products.price')
        ->join('stocks', 'stocks.product_id', 'products.id')
        ->get();

        return view('transaction.update', ['transaction' => $transaction, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'buyer_name' => 'required',
            'type' => 'required',
            'product_id.*' => 'required',
            'amount.*' => 'required',
        ]);
        
        $transaction = Transaction::findOrFail($id);
        $detail = DetailTransaction::where('transaction_id', $id)->get();

        $transaction->update([
            'buyer_name' => $request->buyer_name,
            'type' => $request->type,
            'updated_at' => Carbon::now(),
        ]);

        foreach ($request->product_id as $key => $value) {
            ${$key} = Stock::where('product_id', $value)->firstOrFail();

            if(${$key}->stock >= $request->amount[$key]) {
                // $request->validate([
                //     'buyer_name' => 'required',
                //     'type' => 'required',
                // ]);

                $viewDetail = DetailTransaction::where([['transaction_id', $id], ['product_id', $request->product_id[$key]]])->get();
                DetailTransaction::where([['transaction_id', $id], ['product_id', $request->product_id[$key]]])->update([
                    'amount' => $request->amount[$key],
                    'price' => $request->price[$key],
                    'total' => $request->total[$key],
                    'updated_at' => Carbon::now(),
                ]);
                
                ${$key}->update([
                    'stock' => ${$key}->stock + $viewDetail[0]->amount - $request->amount[$key],
                    'updated_by' => auth()->user()->id,
                    'product_id' => $request->product_id[$key], 
                ]);
            }
        }
        return redirect()->route('transaction.index')->with('success','Product has been updatedsuccessfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $detail = DetailTransaction::where('transaction_id', $id)->firstOrFail();
        $stock = Stock::where('product_id', $detail->product_id)->firstOrFail();

        if ($transaction->delete()) {
            $stock->update([
                'stock' => $stock->stock + $detail->amount,
                'updated_by' => auth()->user()->id,
            ]);

            return redirect()->route('transaction.index')->with('success', 'Deleted!');
        }

        return redirect()->route('transaction.index')->with('error', 'Sorry, unable to delete this!');        
    }
}
