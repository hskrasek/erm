<?php

declare(strict_types=1);

namespace App\Enum;

enum Cardinality: int
{
    case ZERO = 0;

    case ONE = 1;

    case MANY = -1;
}
