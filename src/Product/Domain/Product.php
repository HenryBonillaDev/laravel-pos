<?php

namespace Src\Product\Domain;

class Product implements \Stringable
{
    private string $id;
    private string $name;
    private string $stock;
    private string $id_category;
    private float $price;
    private float $sale_price;
    private float $other_price;
    private string $state;
    private bool $is_drink;
    private array $categories;


    public function __construct(
        string $id,
        string $name,
        string $stock,
        string $id_category,
        float $price,
        float $sale_price,
        float $other_price,
        string $state,
        bool $is_drink
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
        $this->is_drink = $is_drink;

    }

    public function addCategory(Category $category): void
    {
        $this->categories[] = $category;
    }

    public static function create(
        string $name,
        string $stock,
        string $id_category,
        float $price,
        float $sale_price,
        float $other_price,
        string $state,
        bool $is_drink

    ): self
    {
        $id = uuid_create(UUID_TYPE_RANDOM);
        return new self($id, $name, $stock, $id_category, $price,$sale_price,$other_price,$state, $is_drink);
    }

    public function updateDetails(
        string $name,
        string $stock,
        string $id_category,
        float $price,
        float $sale_price,
        float $other_price,
        string $state,
        bool $is_drink
    ): void
    {
        $this->name = $name;
        $this->stock = $stock;
        $this->id_category = $id_category;
        $this->price = $price;
        $this->sale_price = $sale_price;
        $this->other_price = $other_price;
        $this->state = $state;
        $this->is_drink=$is_drink;
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

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getSalePrice(): float
    {
        return $this->sale_price;
    }

    public function setSalePrice(float $sale_price): void
    {
        $this->sale_price = $sale_price;
    }

    public function getOtherPrice(): float
    {
        return $this->other_price;
    }

    public function setOtherPrice(float $other_price): void
    {
        $this->other_price = $other_price;
    }

    public function isIsDrink(): bool
    {
        return $this->is_drink;
    }

    public function setIsDrink(bool $is_drink): void
    {
        $this->is_drink = $is_drink;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }


    public function __toString()
    {
        return "hola";// TODO: Implement __toString() method.
    }
}
