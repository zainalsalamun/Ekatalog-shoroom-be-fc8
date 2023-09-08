<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BahanBakar extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'bahan_bakar';
    protected $guarded = ['id'];
}
