<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$products = Product::from('products as p')      
        // ->join('categories as c', 'p.category_id', '=', 'c.id')
        // ->join('brands as b', 'p.brand_id', '=', 'b.id')
        // ->select('p.*', 'c.name as category_name' , 'b.name as brand_name')
        //->get();
        // $products = Product::with('brand')
        // ->orderBy('id', 'desc')
        // ->get();
        // // dd($products);
        // return view('admin.pages.product.index', compact('products'));
        $products = Product::with('category')
            ->orderBy('id', 'desc')
            ->get();
        // dd($products);
        return view('admin.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $brands = Brand::orderBy('name', 'asc')->get();
        return view('admin.pages.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|min:3',
            // 'image' => 'required|array',
            // 'image*' => 'image|mimes:jpeg,png,jpg|max:2048|min:10',
            'image' => 'mimes:png,jpg,jpeg,svg|max:500',
        ],[
            'name.min' => 'Minimum 3 characters required',
            'image.mimes' => 'Image type should be png,jpg,jpeg,svg',
            'image.max' => 'Oops! Too large file. Image size should be less than 500KB',
        ]);
        if($request->hasFile('image'))
        {
            // dd('Image uploaded');
            // dd($imgName =  time().'.'. $request->image->extension());
            // dd($imgName =  time().'.'. $request->image->getClientOriginalExtension());
            $imgName =  time().'.'. $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imgName);

            Product::create([
                'name'          => $request->name,
                'price'         => $request->price,
                'quantity'      => $request->quantity,
                'reorder_level' => $request->reorder_level,
                'description'   => $request->description, 
                'category_id'   => $request->category_id,
                'brand_id'      => $request->brand_id,
                'active'        => $request->active ? 1 : 0,
                'image'         =>  'uploads/'. $imgName
            ]);
            return redirect()->route('products.index')->with('success', 'Product created successfully');

        }else{
            // dd('Image not uploaded');
            Product::create([
                'name'          => $request->name,
                'price'         => $request->price,
                'quantity'      => $request->quantity,
                'reorder_level' => $request->reorder_level,
                'description'   => $request->description, 
                'category_id'   => $request->category_id,
                'brand_id'      => $request->brand_id,
                'active'        => $request->active ? 1 : 0,
            ]);
            return redirect()->route('products.index')->with('success', 'Product created successfully');
        }
        
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.pages.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
