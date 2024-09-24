<?php

namespace Src\Order\Domain;

use Ramsey\Uuid\Uuid;
use Src\Customer\Domain\Customer;
use Src\User\Domain\User;

class Order
{
    private string $id;
    private Customer $customer;
    private User $user;
    private string $state;
    private string $paymentMethod;
    private int $orderNumber;
    private int $voluntaryTipPercentage;
    private int $voluntaryTipValue;
    private int $tax;

    /**
     * @var OrderItem[]|null
     */
    private ?array $items;

    public function __construct(
        string   $id,
        Customer $customer,
        User     $user,
        string   $state,
        string   $paymentMethod,
        int      $orderNumber,
        int      $voluntaryTipPercentage,
        int      $voluntaryTipValue,
        int      $tax,
        ?array   $items = null
    )
    {
        $this->id = $id ?: Uuid::uuid4()->toString();
        $this->customer = $customer;
        $this->user = $user;
        $this->state = $state;
        $this->paymentMethod = $paymentMethod;
        $this->orderNumber = $orderNumber;
        $this->voluntaryTipPercentage = $voluntaryTipPercentage;
        $this->voluntaryTipValue = $voluntaryTipValue;
        $this->tax = $tax;
        $this->items = $items;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
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

    public function getItems(): ?array
    {
        return $this->items;
    }

    public function setItems(?array $items): void
    {
        $this->items = $items;
    }

    public function addItem($item): void
    {
        if ($this->items === null) {
            $this->items = [];
        }
        $this->items[] = $item;
    }

    public function removeItem($item): void
    {
        if (($key = array_search($item, $this->items)) !== false) {
            unset($this->items[$key]);
        }
    }
}
