<?php

namespace Src\Product\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Src\Product\Application\UseCases\CreateProduct;
use Src\Product\Application\UseCases\DeleteProduct;
use Src\Product\Application\UseCases\GetProductById;
use Src\Product\Application\UseCases\ListProducts;
use Src\Product\Application\UseCases\UpdateProduct;

class ProductController extends Controller
{
    private CreateProduct $createProduct;
    private UpdateProduct $updateProduct;
    private DeleteProduct $deleteProduct;
    private GetProductById $getProductById;
    private ListProducts $listProducts;

    public function __construct(
        CreateProduct  $createProduct,
        UpdateProduct  $updateProduct,
        DeleteProduct  $deleteProduct,
        GetProductById $getProductById,
        ListProducts   $listProducts
    )
    {
        $this->createProduct = $createProduct;
        $this->updateProduct = $updateProduct;
        $this->deleteProduct = $deleteProduct;
        $this->getProductById = $getProductById;
        $this->listProducts = $listProducts;
    }

    public function index(): Response
    {
        $products = $this->listProducts->execute();
        return Inertia::render('Products/Index', [
            'products' => $products
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|numeric|min:0',
            'id_category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'other_price' => 'required|numeric|min:0',
            'state' => 'required|string|in:A,D|max:255'
        ]);

        $Product = $this->createProduct->execute($validatedData);
        return response()->json($Product, 201);
    }

    public function show($id): JsonResponse
    {
        $Product = $this->getProductById->execute($id);
        if (!$Product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($Product);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|numeric|min:0',
            'id_category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'other_price' => 'required|numeric|min:0',
            'state' => 'required|string|in:A,D|max:255'
        ]);

        $Product = $this->updateProduct->execute($id, $validatedData);
        if (!$Product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($Product);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->deleteProduct->execute($id);
        if (!$deleted) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
