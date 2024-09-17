<?php

namespace Src\Product\Domain;

class Product implements \Stringable
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
        $this->price = $price;
        $this->sale_price = $sale_price;
        $this->other_price = $other_price;
        $this->state = $state;
    }

    public static function create(
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
        return new self($id, $name, $stock, $id_category, $price,$sale_price,$other_price,$state);
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
        $this->name = $name;
        $this->stock = $stock;
        $this->id_category = $id_category;
        $this->price = $price;
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

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getStock(): string
    {
        return $this->stock;
    }

    public function setStock(string $stock): void
    {
        $this->stock = $stock;
    }

    public function getIdCategory(): string
    {
        return $this->id_category;
    }

    public function setIdCategory(string $id_category): void
    {
        $this->id_category = $id_category;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getSalePrice(): string
    {
        return $this->sale_price;
    }

    public function setSalePrice(string $sale_price): void
    {
        $this->sale_price = $sale_price;
    }

    public function getOtherPrice(): string
    {
        return $this->other_price;
    }

    public function setOtherPrice(string $other_price): void
    {
        $this->other_price = $other_price;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }


    public function __toString()
    {
        return "hola";// TODO: Implement __toString() method.
    }
}
