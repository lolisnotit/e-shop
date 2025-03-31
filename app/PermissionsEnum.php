<?php

namespace App;

use Illuminate\Validation\Rules\Enum;

Enum PermissionsEnum:string
{
    case ApproveVendors ='ApproveVendors';
    case SellProducts ='SellProducts';
    case BuyProducts ='BuyProducts';


}
