<?php

namespace Src\Product\Application\UseCases;

use Src\Product\Domain\Product;
use Src\Product\Domain\ProductRepository;

class CreateProduct
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $data): Product
    {
        $Product = Product::create(
            $data['name'],
            $data['stock'],
            $data['id_category'],
            $data['price'],
            $data['sale_price'],
            $data['other_price'],
            $data['state']
        );

        $this->repository->save($Product);

        return $Product;
    }
}
