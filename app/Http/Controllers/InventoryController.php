<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $data = [
            'pageTitle' => 'Manage Invertory',
            'products' => $products,
        ];

        return view('back.pages.inventory.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'Manage Invertory',
        ];

        return view('back.pages.inventory.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
             // Validate the incoming data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'slug' => 'nullable|unique:products,slug', 
        'status' => 'required|string|in:active,inactive',
    ]);

    // Generate slug if it's not provided
    $slug = $request->slug ?: Str::slug($request->name);

    // Check if the slug already exists in the database
    $slugExists = Product::where('slug', $slug)->exists();

    if ($slugExists) {
        // Return an error message if slug exists
        return back()->withErrors(['slug' => 'Product with this name already exists. Please choose a different name.']);
    }

    // Create product record
    Product::create([
        'name' => $request->name,
        'slug' => $slug,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'status' => $request->status,
    ]);

    // Redirect or return response
    return redirect()->route('admin.list_inventory')->with('success', 'Product added successfully');
}

    public function generateSlug(Request $request)
    {
        // Get the title from the request
        $title = $request->get('title');

        // Generate the slug from the product name
        $slug = Str::slug($title);

        // Check if the exact slug already exists in the database
        $slugExists = Product::where('slug', $slug)->exists();

        // If the slug already exists, return a response indicating the product exists
        if ($slugExists) {
            return response()->json([
                'status' => false,
                'message' => 'Product with this name already exists. Please choose a different name.'
            ]);
        }

        // If the slug does not exist, return the generated slug
        return response()->json([
            'status' => true,
            'slug' => $slug
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::findOrFail($id);
        $data = [
            'pageTitle' => 'Manage Inventory',
            'products' => $products
        ];

        return view('back.pages.inventory.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Find the product by ID
    $product = Product::findOrFail($id);

    // Validate the incoming data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'nullable|unique:products,slug,' . $id,  
        'status' => 'required|string|in:active,inactive',
        'quantity' => 'required|integer',  
        'price' => 'required|numeric',
        'stock' => 'nullable|integer',  
    ]);

    // Generate the slug if it's not provided
    $slug = $request->slug ?: Str::slug($request->name);

    // Check if the slug already exists in the database
    $slugExists = Product::where('slug', $slug)->where('id', '!=', $id)->exists(); 

    if ($slugExists) {
        return back()->withErrors(['slug' => 'Product with this name already exists. Please choose a different name.']);
    }
    // If stock is provided, add it to the existing quantity
    $newQuantity = $product->quantity + ($request->stock ?? 0);  

    // Update the product with the new values
    $product->update([
        'name' => $request->name,
        'slug' => $slug,
        'price' => $request->price,
        'quantity' => $newQuantity,  // Update the quantity
        'status' => $request->status,
    ]);

    // Redirect to the product list page with a success message
    return redirect()->route('admin.list_inventory')->with('success', 'Product updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        // Redirect back with a success message
        return redirect()->route('admin.list_inventory')->with('success', 'Product deleted successfully.');
    }

}
