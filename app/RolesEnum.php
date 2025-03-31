<?php

namespace App;

use Illuminate\Validation\Rules\Enum;

Enum RolesEnum:string
{
    case Admin = 'Admin';
    case Vendor = 'Vendor';
    case User = 'User';
}
