<?php

namespace Src\Order\Domain;

interface OrderRepositoryInterface
{
    public function save(Order $order): void;

    public function findById(string $id): ?Order;

    public function delete(string $id): bool;

    public function findAll(): array;
}
