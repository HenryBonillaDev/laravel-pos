<?php

namespace Src\Order\Domain;

use Ramsey\Uuid\Uuid;

class Order
{
    private string $id;
    private string $idCustomer;
    private int $idUser;
    private string $state;
    private string $paymentMethod;
    private int $orderNumber;
    private int $voluntaryTipPercentage;
    private int $voluntaryTipValue;
    private int $tax;

    public function __construct(
        string $id,
        string $idCustomer,
        int    $idUser,
        string $state,
        string $paymentMethod,
        int    $orderNumber,
        int    $voluntaryTipPercentage,
        int    $voluntaryTipValue,
        int    $tax,
    )
    {
        $this->id = $id ?: Uuid::uuid4()->toString();
        $this->idCustomer = $idCustomer;
        $this->idUser = $idUser;
        $this->state = $state;
        $this->paymentMethod = $paymentMethod;
        $this->orderNumber = $orderNumber;
        $this->voluntaryTipPercentage = $voluntaryTipPercentage;
        $this->voluntaryTipValue = $voluntaryTipValue;
        $this->tax = $tax;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getIdCustomer(): string
    {
        return $this->idCustomer;
    }

    public function setIdCustomer(string $idCustomer): void
    {
        $this->idCustomer = $idCustomer;
    }

    public function getIdUser(): int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function getOrderNumber(): int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    public function getVoluntaryTipPercentage(): int
    {
        return $this->voluntaryTipPercentage;
    }

    public function setVoluntaryTipPercentage(int $voluntaryTipPercentage): void
    {
        $this->voluntaryTipPercentage = $voluntaryTipPercentage;
    }

    public function getVoluntaryTipValue(): int
    {
        return $this->voluntaryTipValue;
    }

    public function setVoluntaryTipValue(int $voluntaryTipValue): void
    {
        $this->voluntaryTipValue = $voluntaryTipValue;
    }

    public function getTax(): int
    {
        return $this->tax;
    }

    public function setTax(int $tax): void
    {
        $this->tax = $tax;
    }

}
