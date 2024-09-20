<?php

namespace Src\Product\Infrastructure\Repositories;

use Src\Product\Domain\Category;
use Src\Product\Domain\CategoryRepositoryInterface;
use Src\Product\Infrastructure\Persistence\EloquentCategory;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{

    public function save(Category $category): void
    {
        $eloquentCategory = (new EloquentCategory())->find($category->getId()) ?? new EloquentCategory();
        $eloquentCategory->id = $category->getId()();
        $eloquentCategory->name = $category->getName();
        $eloquentCategory->save();
    }

    public function findById(string $id): ?Category
    {
        $eloquentProduct = (new EloquentCategory())->find($id);
        if (!$eloquentProduct) {
            return null;
        }

        return new Category(
            $eloquentProduct->id,
            $eloquentProduct->name,
        );
    }

    public function delete(string $id): bool
    {
        return EloquentCategory::destroy($id) > 0;
    }

    public function findByName(string $name): ?Category
    {
        $eloquentProduct = (new EloquentCategory())
    ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($name) . '%'])
    ->first();
        if (!$eloquentProduct) {
            return null;
        }

        return new Category(
            $eloquentProduct->id,
            $eloquentProduct->name
        );
    }

    public function findAll(): array
    {
        return EloquentCategory::all()->toArray();
    }
}
