<?php 

namespace App\Enums;

/**
 * Class AddressType
 *
 * @author Wyne Ybanez <wyneybanez@gmail.com>
 * @package App\Enum
 */
enum AddressType: string
{
    case Shipping = 'shipping';
    case Billing = 'billing';
}