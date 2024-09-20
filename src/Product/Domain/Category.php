<?php

namespace Src\Product\Domain;

class Category
{
    private string $id;
    private string $name;

    public function __construct(
        string $id,
        string $name
    )
    {
        $this->id = $id;
        $this->name = $name;

    }

    public static function create(
        string $name,
    ): self
    {
        $id = uuid_create(UUID_TYPE_RANDOM);
        return new self($id, $name);
    }

    public function updateDetails(
        string $name
    ): void
    {
        $this->name = $name;
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

}
