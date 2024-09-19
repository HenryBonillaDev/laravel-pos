<?php

namespace Src\Product\Domain;

interface CategoryRepositoryInterface
{
    public function save(Category $Category): void;

    public function findById(string $id): ?Category;

    public function delete(string $id): bool;

    public function findByName(string $email): ?Category;

    public function findAll(): array;
}
