<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipeRodaPenggerak extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tipe_roda_penggerak';
    protected $guarded = ['id'];
}
