<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Unit()

 */
final class Tax extends Enum
{
    const Tax = ['0' => '%0','1' => '%1','8' => '%8','18' => '%18'];
}
