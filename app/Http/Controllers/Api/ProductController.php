<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    private $product;

    public function __constructor(Product $product) {
        $this->$product = new $product;
    }

    public function index() {
        $products = Product::all();
        return new ProductCollection($products);
    }

    public function show($id) {
        $product = Product::find($id);

        // return response()->json($product, 200, []);
        return new ProductResource($product);
    }

    public function save(Request $request) {
        $data = $request->all();
        $product = Product::create($data);

        return response()->json($product, 201, []);
    }

    public function update(Request $request) {
        $data = $request->all();

        $product_id = $data['id'];
        $product = Product::find($product_id);

        if(empty($product)) {
            return response()->json(
                [
                    'message' => 'produto nao encontrado'
                ],
                400, []
            );
        }

        $product->update($data);
        return response()->json($product, 201, []);
    }

    public function delete($id) {
        $product = Product::find($id);

        if(empty($product)) {
            return response()->json(
                [
                    'message' => 'produto nao encontrado'
                ],
                400, []
            );
        }

        $product->delete();

        return response()->json(
            [
                'message' => 'Produto excluido com sucesso'
            ],
            200, []
        );
    }
}
