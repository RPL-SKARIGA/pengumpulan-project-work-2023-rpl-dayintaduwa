<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::hasUser()) {
            return redirect()->to('login')->withErrors('Login gagal!');
        }
    
        // $stocks = Stock::all();
        $stocks = DB::table('stocks')
        ->select('stocks.id', 'stocks.stock', 'products.name AS product_name', 'users.name')
        ->join('products', 'stocks.product_id', 'products.id')
        ->join('users', 'stocks.updated_by', 'users.id')
        ->get();

        return view('stock.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        
        return view('stock.create', compact('products'));
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //validate form
        $request->validate([
            'stock' => 'required',
            'product_id' => 'required'
        ]);
        
        $stock = Stock::where('product_id', $request->product_id)->first();
        
        
        if ($stock) {
            $stock->update([
                'stock' => $request->stock + $stock->stock,
                'updated_by' => auth()->user()->id,
                'product_id' => $request->product_id, 
            ]); 
            return redirect()->route('stock.index')->with('success','Product has been updatedsuccessfully.');
        }
        Stock::create([
            'stock' => $request->stock,
            'updated_by' => auth()->user()->id,
            'product_id' => $request->product_id,   
        ]);
        
        return redirect()->route('stock.index')->with('success','Product has been created successfully.');
    }
    
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $stock = Stock::findOrFail($id);
        $stock = DB::table('stocks')
        ->select('stocks.id', 'stocks.stock', 'products.name AS product_name', 'users.name')
        ->join('products', 'stocks.product_id', 'products.id')
        ->join('users', 'stocks.updated_by', 'users.id')
        ->where(['stocks.id' => $id])
        ->get();

        return view('stock.detail', [ 'stock' => $stock[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = DB::table('stocks')
        ->select('stocks.id', 'stocks.stock', 'stocks.product_id', 'products.name AS product_name', 'users.name')
        ->join('products', 'stocks.product_id', 'products.id')
        ->join('users', 'stocks.updated_by', 'users.id')
        ->where(['stocks.id' => $id])
        ->get();
        
        $products = Product::all();
        
        return view('stock.update', ['products' => $products, 'stock' => $stock[0]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required',
            'product_id' => 'required'
        ]);
        
        $stock = Stock::findOrFail($id);

        if ($stock->update([
            'stock' => $request->stock,
            'updated_by' => auth()->user()->id,
            'product_id' => $request->product_id, 
        ])) {
            return redirect()->route('stock.index')->with('success','Product has been updatedsuccessfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);

        if ($stock->delete()) {
            return redirect()->route('stock.index')->with('success', 'Deleted!');
        }

        return redirect()->route('stock.index')->with('error', 'Sorry, unable to delete this!');
    }
}
