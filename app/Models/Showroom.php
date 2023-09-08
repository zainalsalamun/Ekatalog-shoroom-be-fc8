<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Showroom extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'showroom';
    protected $guarded = ['id'];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_showroom', 'id_showroom', 'id_user')->withPivot('stat');
    }
}
