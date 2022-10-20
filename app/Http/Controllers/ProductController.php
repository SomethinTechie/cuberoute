<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
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
        $categories = DB::table('categories')->get();
        return view('products.create', [ 'categories' => $categories, 'successmessage' => '' ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $productInputs = $request->only(['category_id', 'name', 'title', 'description', 'keywords']);
        $variationsInputs = $request->except(['category_id', 'name', 'title', 'description', 'keywords', '_token']);
        
        log::info($variationsInputs);
        $request->validate([
            'category_id' => ['required', 'integer',],
            'name' => ['required', 'string', 'max:255', 'unique:products'],
            'title' => ['required', 'string','max:255'],
            'description' => ['required', 'string', 'max:255'],
            'keywords' => ['required', 'string', 'max:255'],
        ]);

        $product = Product::create([
            'category_id' => $productInputs['category_id'],
            'name' => $productInputs['name'],
            'title' => $productInputs['title'],
            'description' => $productInputs['description'],
            'keywords' => $productInputs['keywords'],
        ]);
        $categoryIds = NULL;
        foreach ($variationsInputs as $id => $value) {
            if (is_int($id)) {
                $categoryIds = $categoryIds.'0'.$id;
            } else {
                ProductVariation::create([
                    'product_id' => $product->id,
                    'variationName' => $id,
                    'value' => $value,
                ]);

            }        }
        $product->category_id = '0'.$categoryIds.'0';
        $product->save();

        return redirect('dashboard/product/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $sameCategoryProducts = Product::where('category_id', 'LIKE',  '%'.$product->category_id.'%')
           ->orderBy('name')
           ->whereNotIn('id', [$product->id])
           ->take(5)
           ->get();

        $categories = Category::where('id', 'LIKE',  '%'.$product->category_id.'%')->get();

        $productVariations = ProductVariation::where('product_id', $product->id)
           ->orderBy('variationName')
           ->take(5)
           ->get();

        return view('products.show', ['product' => $product, 'sameCategoryProducts' => $sameCategoryProducts, 'productVariations' => $productVariations, 'categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $sameCategoryProducts = Product::where('category_id', $product->category_id)
           ->orderBy('name')
           ->whereNotIn('id', [$product->id])
           ->take(5)
           ->get();

        $categories = Category::where('id', 'LIKE',  '%'.'6'.'%')->get();

        $productVariations = ProductVariation::where('product_id', $product->id)
           ->orderBy('variationName')
           ->take(5)
           ->get();

        return view('products.edit', ['product' => $product, 'sameCategoryProducts' => $sameCategoryProducts, 'productVariations' => $productVariations, 'categories' => $categories]);
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
        $productInputs = $request->only(['name', 'title', 'description', 'keywords']);
        $categoryInput = $request->only(['category_name']);
        $variationInputs = $request->except(['category_id', 'name', 'title', 'description', 'keywords','_token','category_name']);
        $product = Product::where('name', $productInputs['name'])->first();
        //Edit product
        $product->name = $productInputs['name'];
        $product->title = $productInputs['title'];
        $product->description = $productInputs['description'];
        $product->keywords = $productInputs['keywords'];
        $product->save();

        if ($categoryInput) {
            $product->category->name = $categoryInput['category_name'];
            $product->category->save();
        }
        
        // //Edit variations
        foreach ($variationInputs as $id => $value) {
            $variantion = ProductVariation::where([['variationName', '=', $id], ['product_id', '=', $product->id]])->first();
            $variantion->value = $value;
            $variantion->save();
        }
        return redirect('/dashboard/product/edit/'.$product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
 
        $product->delete();
        return redirect('dashboard/');
    }
}
