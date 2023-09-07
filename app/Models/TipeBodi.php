<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeBodi extends Model
{
    use HasFactory;
    protected $table = 'tipe_bodi';
    protected $guarded = ['id'];
}
