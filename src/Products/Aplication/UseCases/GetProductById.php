<?php

namespace Src\Product\Application\UseCases;

use Src\Product\Domain\Product;
use Src\Product\Domain\ProductRepository;

class GetProductById
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): ?Product
    {
        return $this->repository->findById($id);
    }
}
