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
    const Shipping = 'shipping';
    const Billing = 'billing';
}