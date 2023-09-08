<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'role';
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_showroom', 'id_role', 'id_user')->withPivot('stat');
    }
}
