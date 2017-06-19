<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Admin extends Model Implements Illuminate\Contracts\Auth\Authenticatable
{
    //
    use Authenticatable;
}
