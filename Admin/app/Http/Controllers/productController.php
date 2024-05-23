<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\product;

class productController extends Controller
{

    
    public function CP(){
        return view('admin.createProduct');
    }

    public function LP(){
        return view('admin.listProduct');
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

        return redirect()->route('show');
    }

    public function show(){
        $products = product::all();
        return view('admin.listProduct', compact('products'));
    }

    public function destroy(string $id){
        $product = product::find($id);
        $product->delete();
        return back();
    }

    
    public function edit(string $id){
        $product = product::find($id);
        return view('admin.editProduct', ['item'=> $product]);
    }

    public function update(Request $request, string $id){
        $product = product::find($id);

        if($product){
            $file = $request->file('ProductMedia');
            if ($file) {
                $FileName = time().'.'.$request->file('ProductMedia')->getClientOriginalExtension();
                $file->move(public_path('assets/img'), $FileName);
                $product->ProductMedia = $FileName;
            }
            
            $product->ProductName = $request->input('ProductName');
            $product->ProductDesc = $request->input('ProductDesc');
            $product->ProductQuantity = $request->input('ProductQuantity');
            $product->ProductPrice = $request->input('ProductPrice');
            
            
            $product->save();
    
            // Additional logic or redirection after successful data storage
    
            return redirect()->route('show');
        }
    }
}
