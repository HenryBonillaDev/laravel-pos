<?php

namespace Src\Product\Application\UseCases;

use Src\Product\Domain\ProductRepository;

class ListProducts
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): array
    {
        return $this->repository->findAll();
    }
}
