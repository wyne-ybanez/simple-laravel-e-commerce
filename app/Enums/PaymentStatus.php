<?php

namespace App\Enums;


/**
 * Class PaymentStatus
 *
 * @author  Wyne Ybanez <wyneybanez@gmail.com>
 * @package App\Enums
 */
enum PaymentStatus: string
{
    case Pending = 'pending';
    case Paid = 'paid';
    case Failed = 'failed';
}