<?php

namespace Src\Product\Application\UseCases;


use Src\Product\Domain\Category;
use Src\Product\Domain\CategoryRepositoryInterface;

class CreateCategory
{
    private CategoryRepositoryInterface $repository;

    public function __construct( CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $data): Category
    {
        $category = Category::create(
            $data['name']
        );

        $this->repository->save($category);

        return $category;
    }
}
