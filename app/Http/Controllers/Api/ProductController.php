<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Controller for managing products.
 * @group products
 * APIs for managing products
 */

class ProductController extends Controller
{
    /**
     *
     * Display a listing of the resource.
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
     * @bodyParam name string required The name of the product. Example: "New Product"
     * @bodyParam description string required The description of the product. Example: "This is a new product."
     * @bodyParam price numeric required The price of the product. Example: 19.99
     * @bodyParam stock integer required The stock quantity of the product. Example: 100
     * @bodyParam featured boolean Whether the product is featured. Example: false
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
     *
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
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
