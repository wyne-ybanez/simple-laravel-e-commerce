<?php
/**
 * User: Wyne
 * Date: 06/30/2022
 * Time: 9:34 AM
 */

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