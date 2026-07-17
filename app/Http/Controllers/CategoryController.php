<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Бүх бүлэг харах
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return view(
            'categories.index',
            compact('categories')
        );
    }



    // Бүлэг нэмэх хуудас
    public function create()
    {
        return view('categories.create');
    }



    // Хадгалах
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50'
        ]);


        $category = Category::firstOrCreate([
    'name' => $request->name
]);

return redirect()->route(
    'products.create',
    ['category_id' => $category->id]
);


        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Бүлэг амжилттай нэмэгдлээ.'
            );
    }




    // Бүлэг доторх бараа харах
    public function show(Category $category)
    {
        $products = $category->products;

        return view(
            'categories.show',
            compact(
                'category',
                'products'
            )
        );
    }




    // Засах хуудас
    public function edit(Category $category)
    {
        return view(
            'categories.edit',
            compact('category')
        );
    }




    // Шинэчлэх
    public function update(
        Request $request,
        Category $category
    )
    {
        $request->validate([
            'name' => 'required|max:50'
        ]);


        $category->update([
            'name' => $request->name
        ]);


        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Бүлэг шинэчлэгдлээ.'
            );
    }




    // Устгах
    public function destroy(Category $category)
    {
        $category->delete();


        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Бүлэг устлаа.'
            );
    }
}