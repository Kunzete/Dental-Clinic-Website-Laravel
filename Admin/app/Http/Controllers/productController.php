<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\product;

class productController extends Controller
{

    
    public function CP(){
        return view('createProduct');
    }

    public function LP(){
        return view('listProduct');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ProductName' => 'required|max:32',
            'ProductDesc' => 'required|string|max:200',
            'ProductQuantity' => 'required|integer|min:1|max:255',
            'ProductPrice' => 'required|integer',
            'ProductMedia' => 'required'
        ]);


        $product = new product();
        $product->ProductName = $request->input('ProductName');
        $product->ProductDesc = $request->input('ProductDesc');
        $product->ProductQuantity = $request->input('ProductQuantity');
        $product->ProductPrice = $request->input('ProductPrice');
        
        $FileName = time().'.'.$request->file('ProductMedia')->getClientOriginalExtension();
        $request->file('ProductMedia')->move(public_path('assets/img'), $FileName);
        
        $product->ProductMedia = $FileName;
        $product->save();

        // Additional logic or redirection after successful data storage

        return redirect()->route('createProduct')->with('success', 'Product stored successfully!');
    }

    public function show(){
        $products = product::all();
        return view('listProduct', compact('products'));
    }
}
