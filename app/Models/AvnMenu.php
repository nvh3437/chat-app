<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class AvnMenu extends Model
{
	protected $table = 'avn_menu';
    use HasFactory;
  public function permissions()
  {
    return $this->hasMany(Permission::class, 'menu_id');
  }
  public function childrens()
  {
    return $this->hasMany(AvnMenu::class, 'parent', 'id')->orderBy('order','asc');
  }
}
