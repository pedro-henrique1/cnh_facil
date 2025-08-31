<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'target_value',
        'reward_xp',
    ];

    public function userMissions(): HasMany
    {
        return $this->hasMany(UserMission::class);
    }
}
