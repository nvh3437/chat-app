<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PermissionRole extends Model
{
    use HasFactory;

    
    protected $table = "avn_permission_roles";
    public $timestamps = false;

    
}
