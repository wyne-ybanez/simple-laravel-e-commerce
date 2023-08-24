<?php
namespace App\Enums;

/**
 * Class CustomerStatus
 *
 * @author  Wyne Ybanez <wyneybanez@gmail.com>
 * @package App\Enums
 */
enum CustomerStatus: string
{
    case Active = 'active';
    case Disabled = 'disabled';
}
