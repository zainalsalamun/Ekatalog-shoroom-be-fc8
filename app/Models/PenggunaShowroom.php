<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaShowroom extends Model
{
    use HasFactory;
    protected $table = 'pengguna_showroom';
    protected $guarded = ['id'];
}
