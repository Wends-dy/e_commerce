<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function create(){
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Define validation rules
        $request->validate([
            'product_name' => 'required|string|min:3|unique:products,product_name',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);
    
        // Create a new product with validated data
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public'); // Store image
            $product->image = $path; // Save path to database
        }
    
        $product->save();
    
        return redirect('products/create')->with('success', 'Product created successfully.');
    }

    public function edit(int $id){
        $product = product::find($id);
        return view('products.edit', compact('product'));
    }
    
    public function update(Request $request, $id){
        $request->validate([
            'product_name' => 'string',
            'description' => 'nullable|string',
            'price' => 'numeric|min:0',
            'stock' => 'integer|min:0',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->back()->with('status','Categorie updated');
    }

    public function destroy(int $id)
    {
        // Attempt to find the product by ID
        $product = Product::findOrFail($id);

        // Delete the product
        $product->delete();

        // Redirect back with a success message
        return redirect('products/create')->with('status', 'Product deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('product_name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return view('products.partials.table-rows', compact('products'))->render();
    }
}
