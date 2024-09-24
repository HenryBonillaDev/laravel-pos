<?php

namespace Src\Product\Infrastructure\Repositories;

use Src\Customer\Infrastructure\Persistence\EloquentCustomer;
use Src\Product\Domain\Product;
use Src\Product\Domain\ProductRepository;
use Src\Product\Infrastructure\Persistence\EloquentProduct;

class EloquentProductRepository implements ProductRepository
{

    public function save(Product $product): void
    {
        $eloquentProduct = (new EloquentProduct())->find($product->getId()) ?? new EloquentProduct();
        $eloquentProduct->id = $product->getId();
        $eloquentProduct->name = $product->getName();
        $eloquentProduct->stock = $product->getStock();
        $eloquentProduct->id_category = $product->getIdCategory();
        $eloquentProduct->price = $product->getPrice();
        $eloquentProduct->sale_price = $product->getSalePrice();
        $eloquentProduct->other_price = $product->getOtherPrice();
        $eloquentProduct->state = $product->getState();
        $eloquentProduct->is_drink = $product->isIsDrink();
        $eloquentProduct->save();
    }

    public function findById(string $id): ?Product
    {
        $eloquentProduct = (new EloquentProduct)->find($id);
        if (!$eloquentProduct) {
            return null;
        }

        return new Product(
            $eloquentProduct->id,
            $eloquentProduct->name,
            $eloquentProduct->stock,
            $eloquentProduct->id_category,
            $eloquentProduct->price,
            $eloquentProduct->sale_price,
            $eloquentProduct->other_price,
            $eloquentProduct->state,
            $eloquentProduct->is_drink,
        );
    }

    public function delete(string $id): bool
    {
        return EloquentProduct::destroy($id) > 0;
    }

    public function findByName(string $name): ?Product
    {
        $eloquentProduct = (new EloquentProduct)
    ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($name) . '%'])
    ->first();
        if (!$eloquentProduct) {
            return null;
        }

        return new Product(
            $eloquentProduct->id,
            $eloquentProduct->name,
            $eloquentProduct->stock,
            $eloquentProduct->id_category,
            $eloquentProduct->price,
            $eloquentProduct->sale_price,
            $eloquentProduct->other_price,
            $eloquentProduct->state,
            $eloquentProduct->is_drink,
        );
    }

    public function findAll(): array
    {
        return EloquentProduct::with('category')->where('state', 'A')->get()->toArray();
//        return EloquentProduct::all()->toArray();
    }
}
