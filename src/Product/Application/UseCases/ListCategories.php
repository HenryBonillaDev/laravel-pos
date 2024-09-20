<?php

namespace Src\Product\Application\UseCases;

use Src\Product\Domain\CategoryRepositoryInterface;

class ListCategories
{
    private CategoryRepositoryInterface $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): array
    {
        return $this->repository->findAll();
    }
}
