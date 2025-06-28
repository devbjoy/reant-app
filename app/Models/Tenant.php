<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tenant extends Authenticatable
{
    use SoftDeletes;

    protected $guarded = [];
    protected $table = 'tenants';
}
