<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transmisi extends Model
{
    use HasFactory;
    protected $table = 'transmisi';
    protected $guarded = ['id'];
}
