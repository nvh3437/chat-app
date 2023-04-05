<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileBackup extends Model
{
    use HasFactory;
    protected $table = 'avn_file_backups';
}
