<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Controller for managing products.
 *
 * @group products
 * APIs for managing products
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @response 200 {
     *   "data": [
     *   {
     *    "id": 1,
     *    "name": "Sample Product",
     *    "description": "This is a sample product.",
     *    "price": "19.99",
     *    "stock": 100,
     *    "featured": false,
     *    "created_at": "2024-01-01T12:00:00Z",
     *    "updated_at": "2024-01-01T12:00:00Z"
     *   }
     *   ]
     * }
     * @response 500 {"message": "Server Error"}
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @bodyParam name string required The name of the product. Example: "New Product"
     * @bodyParam description string required The description of the product. Example: "This is a new product."
     * @bodyParam price numeric required The price of the product. Example: 19.99
     * @bodyParam stock integer required The stock quantity of the product. Example: 100
     * @bodyParam featured boolean Whether the product is featured. Example: false
     *
     * @response 201 {
     *   "id": 1,
     *   "name": "New Product",
     *   "description": "This is a new product.",
     *   "price": "19.99",
     *   "stock": 100,
     *   "featured": false,
     *   "created_at": "2024-01-01T12:00:00Z",
     *   "updated_at": "2024-01-01T12:00:00Z"
     * }
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {"name": ["The name field is required."]}
     * }
     * @response 500 {"message": "Server Error"}
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
            'featured' => 'nullable|boolean',
        ]);
        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @response 200 {
     *   "id": 1,
     *   "name": "Sample Product",
     *   "description": "This is a sample product.",
     *   "price": "19.99",
     *   "stock": 100,
     *   "featured": false,
     *   "created_at": "2024-01-01T12:00:00Z",
     *   "updated_at": "2024-01-01T12:00:00Z"
     * }
     * @response 404 {"message": "No query results for model [App\\Models\\Product] 999"}
     * @response 500 {"message": "Server Error"}
     */
    public function show(string $id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @bodyParam name string The name of the product. Example: "Updated Product"
     * @bodyParam description string The description of the product. Example: "This is an updated product."
     * @bodyParam price numeric The price of the product. Example: 29.99
     * @bodyParam stock integer The stock quantity of the product. Example: 150
     * @bodyParam featured boolean Whether the product is featured. Example: true
     */
    public function update(Request $request, string $id)
    {
        // Load the product with the id $id and update only the fields present in the request-
        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'description', 'price', 'stock', 'featured']));

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @response 204 No Content
     * @response 404 {"message": "Product Not Found"}
     * @response 500 {"message": "Server Error"}
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        // conditional statement
        if (! $product) {
            return response()->json([
                'message' => 'Product Not Found',
            ], 404);
        }
        $product->delete();

        return response()->noContent();
    }
}
