<?php

namespace Src\Product\Application\UseCases;

use Src\Product\Domain\Product;
use Src\Product\Domain\ProductRepository;

class UpdateProduct
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id, array $data): ?Product
    {
        $Product = $this->repository->findById($id);

        if (!$Product) {
            return null;
        }

        $Product->updateDetails(
            $data['name'],
            $data['stock'],
            $data['id_category'],
            $data['price'],
            $data['sale_price'],
            $data['other_price'],
            $data['state'],
            $data['is_drink']
        );

        $this->repository->save($Product);

        return $Product;
    }
}
