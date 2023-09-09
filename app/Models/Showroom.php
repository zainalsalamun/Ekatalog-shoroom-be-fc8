<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Showroom extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'showroom';
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_showroom', 'id_showroom', 'id_user')->withPivot('stat');
    }
}
