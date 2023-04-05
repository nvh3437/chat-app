<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Permission;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected $table = "avn_roles";
    
    public function user_roles()
    {
        return $this->hasMany(UserRole::class);
    }
    public function permission_roles()
    {
        return $this->hasMany(PermissionRole::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'avn_user_roles');
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'avn_permission_roles');
    }
}
