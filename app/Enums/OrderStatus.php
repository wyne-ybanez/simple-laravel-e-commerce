<?php

namespace App\Enums;

/**
 * Class OrderStatus
 *
 * @author  Wyne Ybanez <wyneybanez@gmail.com>
 * @package App\Enums
 */
enum OrderStatus: string
{
    case Unpaid = 'unpaid';
    case Paid = 'paid';
    case Cancelled = 'cancelled';
    case Shipped = 'shipped';
    case Incomplete = 'incomplete';
    case Completed = 'completed';

    public static function getStatuses()
    {
        return [
            self::Paid, self::Unpaid, self::Cancelled, self::Shipped, self::Completed, self::Incomplete
        ];
    }
}