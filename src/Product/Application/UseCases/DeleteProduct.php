<?php

namespace Src\Product\Application\UseCases;

use Src\Product\Domain\ProductRepository;

class DeleteProduct
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): bool
    {
        $product = $this->repository->findById($id);

        if (!$product) {
            return false;
        }
        $this->repository->delete($product->getId());

        return true;
    }
}
