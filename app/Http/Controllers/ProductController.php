<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    // Display all products
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('products.create');
    }

    // Store new product
    public function store(Request $request)
    {
          
        $request->validate([
            'name' => 'required|string|max:255',
          'images' => 'required|array', // 🔥 make required temporarily
    'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

       $imagePaths = [];

if ($request->hasFile('images')) {

    foreach ($request->file('images') as $image) {

        $path = $image->store('products', 'public');
        $imagePaths[] = $path;
    }
}


        $product = Product::create([
    'name' => $request->name,
    'images' => $imagePaths,
    'price' => $request->price,
    'description' => $request->description,
]);



        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    // Show single product
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Show edit form
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
    ]);

    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;

    // If new images uploaded
    if ($request->hasFile('images')) {

        // 🔥 Delete old images from storage
        if (!empty($product->images)) {
            foreach ($product->images as $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        $imagePaths = [];

        foreach ($request->file('images') as $image) {
            $path = $image->store('products', 'public');
            $imagePaths[] = $path;
        }

        $product->images = $imagePaths;
    }

    $product->save();

    return redirect()->route('products.index')
        ->with('success', 'Product updated successfully.');
}

    // Delete product
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
