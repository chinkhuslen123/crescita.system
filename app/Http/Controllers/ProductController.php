<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('category')
            ->orderBy('name')
            ->get();

        return view(
            'products.index',
            compact('products')
        );
    }



    public function create(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $selectedCategory = $request->category_id;


        return view(
            'products.create',
            compact(
                'categories',
                'selectedCategory'
            )
        );
    }



    public function store(Request $request)
    {
        $request->validate([

            'category_id'=>'required|exists:categories,id',

            'name'=>'required|max:255',

            'price'=>'required|numeric',

            'quantity'=>'required|integer|min:0'

        ]);



        Product::create([

            'category_id'=>$request->category_id,

            'name'=>$request->name,

            'price'=>$request->price,

            'quantity'=>$request->quantity,

        ]);



        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Бараа нэмэгдлээ.'
            );
    }





    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();


        return view(
            'products.edit',
            compact(
                'product',
                'categories'
            )
        );
    }





    public function update(Request $request, Product $product)
    {

        $request->validate([

            'category_id'=>'required|exists:categories,id',

            'name'=>'required|max:255',

            'price'=>'required|numeric',

            'quantity'=>'required|integer|min:0'

        ]);



        $product->update([

            'category_id'=>$request->category_id,

            'name'=>$request->name,

            'price'=>$request->price,

            'quantity'=>$request->quantity,

        ]);



        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Бараа шинэчлэгдлээ.'
            );
    }





    public function destroy(Product $product)
    {
        $product->delete();


        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Бараа устлаа.'
            );
    }

}