<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = DB::table('products')
        ->when($request->search, function ($query) use ($request) {
            return $query->where('products.name', 'like', '%'.$request->search.'%');
        })
        ->join('categories', 'category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category_name')
        ->orderBy('products.name')
        ->paginate(10);

        return view('pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return view('pages.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        if($request->hasFile('image')) {
            $filename = time().'.'.$request->image->extension();
            $path = 'storage/product/'.$filename;
            $request->image->storeAs('public/product', $filename);
        } else {
            $path = "";
        }

        $product = new Product;
        $product->name = $request->name;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->image = $path;
        $product->save();

        // $data['image'] = $request->file('image')->store('assets/product', 'public');
        // Product::create($data);
        return redirect()->route('product.index')->with('success', 'Product successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($product_id)
    {
        $product = Product::findOrFail($product_id);
        $categories = Category::get();

        return view('pages.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $product_id)
    {
        $product = Product::findOrFail($product_id);

        if($request->hasFile('image')) {
            $filename = time().'.'.$request->image->extension();
            $path = 'storage/product/'.$filename;
            $request->image->storeAs('public/product', $filename);
        } else {
            $path = $product->image;
        }

        $product->name = $request->name;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->image = $path;
        $product->update();

        return redirect()->route('product.index')->with('success', 'Product successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id)
    {
        $product = Product::findOrFail($product_id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted.');
    }
}
