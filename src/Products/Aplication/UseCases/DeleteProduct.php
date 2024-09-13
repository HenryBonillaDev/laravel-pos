<?php

namespace Src\Product\Application\UseCases;

use Src\Product\Domain\ProductRepository;

class DeleteProduct
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): bool
    {
        $Product = $this->repository->findById($id);

        if (!$Product) {
            return false;
        }
        $this->repository->delete($Product->id());

        return true;
    }
}
