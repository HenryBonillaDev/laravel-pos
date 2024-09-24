<?php

namespace Src\Order\Domain;

use PhpParser\Node\Expr\Cast\Double;

class OrderItem
{
    private string $id;
    private double $salePrice;
    private ?string $comment;

    public function __construct(string $id, int $salePrice, ?string $comment)
    {
        $this->id = $id;
        $this->salePrice = $salePrice;
        $this->comment = $comment;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getSalePrice(): float
    {
        return $this->salePrice;
    }

    public function setSalePrice(float $salePrice): void
    {
        $this->salePrice = $salePrice;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

}
