<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipeBodi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tipe_bodi';
    protected $guarded = ['id'];
}
