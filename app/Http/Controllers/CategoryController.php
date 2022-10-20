<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')->get();
        $products = DB::table('products')->get();
        return view('categories.index', [ 'categories' => $categories, 'products' => $products, 'categoryId' => 'all' ]);
    }


    public function main_index()
    {
        $categories = DB::table('categories')->get();
        $products = DB::table('products')->get();
        return view('dashboard', [ 'categories' => $categories, 'products' => $products, 'categoryId' => 'all' ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Category::create([
            'name' => $request->input('name')
        ]);
        return redirect('/dashboard/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = DB::table('categories')->get();
        $categoryProducts = Product::where('category_id', 'LIKE',  '%'.$id.'%')
           ->orderBy('name')
           ->take(10)
           ->get();

        return view('dashboard', [ 'categories' => $categories, 'products' => $categoryProducts, 'categoryId' => $id ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        log::info($category);
        $category->name = $request->input('name');
        $category->save();
        return redirect('/dashboard/categories');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/dashboard/categories');
    }
}
