<?php

namespace Src\Product\Domain;

class Product
{
    private string $id;
    private string $name;
    private string $stock;
    private string $id_category;
    private string $price;
    private string $sale_price;
    private string $other_price;
    private string $state;


    public function __construct(
        string $id,
        string $name,
        string $stock,
        string $id_category,
        string $price,
        string $sale_price,
        string $other_price,
        string $state,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->stock = $stock;
        $this->id_category = $id_category;
        $this->sale_price = $sale_price;
        $this->other_price = $other_price;
        $this->state = $state;
    }

    public static function create(
        string $id,
        string $name,
        string $stock,
        string $id_category,
        string $price,
        string $sale_price,
        string $other_price,
        string $state
    ): self
    {
        $id = uuid_create(UUID_TYPE_RANDOM);
        return new self($id, $name, $lastName, $docType, $dni, $email);
    }

    public function updateDetails(
        string $name,
        string $stock,
        string $id_category,
        string $price,
        string $sale_price,
        string $other_price,
        string $state
    ): void
    {
        $this->id = $id;
        $this->name = $name;
        $this->stock = $stock;
        $this->id_category = $id_category;
        $this->sale_price = $sale_price;
        $this->other_price = $other_price;
        $this->state = $state;
    }

    private static function validate(
        string $name,
        string $stock,
        string $id_category,
        string $price,
        string $sale_price,
        string $other_price,
        string $state
    ): void
    {
        if (empty($name) || empty($stock) || empty($id_category) || empty($price) || empty($sale_price) ||empty($other_price) ||empty($state)) {
            throw new \InvalidArgumentException('Todos los campos son obligatorios.');
        }

    }


}
