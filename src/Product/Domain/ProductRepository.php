<?php

namespace Src\Product\Domain;

interface ProductRepository
{
    public function save(Product $Product): void;

    public function findById(string $id): ?Product;

    public function delete(string $id): bool;

    public function findByName(string $email): ?Product;

    public function findAll(): array;
}
