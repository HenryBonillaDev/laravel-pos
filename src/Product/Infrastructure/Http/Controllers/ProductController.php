<?php

namespace Src\Product\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;
use Src\Product\Application\UseCases\CreateProduct;
use Src\Product\Application\UseCases\DeleteProduct;
use Src\Product\Application\UseCases\GetProductById;
use Src\Product\Application\UseCases\ListCategories;
use Src\Product\Application\UseCases\ListProducts;
use Src\Product\Application\UseCases\UpdateProduct;
use Src\Product\Domain\Category;

class ProductController extends Controller
{
    private CreateProduct $createProduct;
    private UpdateProduct $updateProduct;
    private DeleteProduct $deleteProduct;
    private GetProductById $getProductById;
    private ListProducts $listProducts;
    private ListCategories $listCategories;

    public function __construct(
        CreateProduct  $createProduct,
        UpdateProduct  $updateProduct,
        DeleteProduct  $deleteProduct,
        GetProductById $getProductById,
        ListProducts   $listProducts,
        ListCategories $listCategories
    )
    {
        $this->createProduct = $createProduct;
        $this->updateProduct = $updateProduct;
        $this->deleteProduct = $deleteProduct;
        $this->getProductById = $getProductById;
        $this->listProducts = $listProducts;
        $this->listCategories = $listCategories;
    }

    public function index(): Response
    {
        $products = $this->listProducts->execute();
        $categories = $this->listCategories->execute();
        return Inertia::render('Products/Index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'stock' => 'required|numeric|min:0',
            'id_category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'numeric|min:0',
            'other_price' => 'numeric|min:0',
            'state' => 'required|string|in:A,D|max:255',
            'is_drink'=>'required|boolean',
        ], [
        'name.required' => 'obligatorio.',
            'stock.required' => 'obligatorio.',
            'price.required' => 'obligatorio.',
            'is_drink.required' => 'obligatorio.'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $str = '';
            foreach ($errors as $messages) {
                foreach ($messages as $message) {
                    $str .= "{$message} \n";
                }
            }
            toast_warning($str);
            return to_route('products.index');
        }
        $this->createProduct->execute($request->all());
        toast_success('Producto creado correctamente');
        return to_route('products.index');
    }

    public function show($id): JsonResponse
    {
        $Product = $this->getProductById->execute($id);
        if (!$Product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($Product);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|numeric|min:0',
            'id_category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'other_price' => 'required|numeric|min:0',
            'state' => 'required|string|in:A,D|max:255',
            'is_drink'=>'required|boolean'
        ]);

        $product = $this->updateProduct->execute($id, $validatedData);
        if (!$product) {
            toast_error('No se pudo actualizar el producto');
        }
        toast_success('Producto actualizado correctamente');
        return to_route('products.index');
    }


    public function destroy($id): Application|Redirector|RedirectResponse
    {
        $deleted = $this->deleteProduct->execute($id);
        if ($deleted) {
            toast_success('Producto eliminado correctamente');
        } else {
            toast_error('Producto no encontrado');
        }
        return to_route('products.index');
    }

    public function getCategories():array
    {
       $categories = $this->listCategories->execute();
       return $categories;
    }
}
