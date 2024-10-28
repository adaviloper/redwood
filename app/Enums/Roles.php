<?php

namespace App\Enums;

enum Roles: string
{
    use HasValues;

    case ADMIN = 'Admin';

}
