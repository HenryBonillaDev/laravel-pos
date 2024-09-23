<?php

namespace Src\Order\Domain\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case InPreparation = 'in_preparation';
    case Prepared = 'prepared';
    case OnDelivery = 'on_delivery';
    case Delivered = 'delivered';
    case Paid = 'paid';
    case Cancelled = 'cancelled';
    case Rejected = 'rejected';
    case OnHold = 'on_hold';
    case Modified = 'modified';
    case Returned = 'returned';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pendiente',
            self::InPreparation => 'En preparación',
            self::Prepared => 'Preparada',
            self::OnDelivery => 'En entrega',
            self::Delivered => 'Entregada',
            self::Paid => 'Pagada',
            self::Cancelled => 'Cancelada',
            self::Rejected => 'Rechazada',
            self::OnHold => 'En espera',
            self::Modified => 'Modificada',
            self::Returned => 'Devuelta',
        };
    }

    public static function labelFor(string $key): ?string
    {
        $status = self::tryFrom($key);

        return $status?->label();
    }

    public static function keyForLabel(string $label): ?string
    {
        foreach (self::cases() as $status) {
            if ($status->label() === $label) {
                return $status->value;
            }
        }

        return null;
    }
}
