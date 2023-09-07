<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeRodaPenggerak extends Model
{
    use HasFactory;
    protected $table = 'tipe_roda_penggerak';
    protected $guarded = ['id'];
}
