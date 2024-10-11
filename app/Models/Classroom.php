<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'team_id', 'mentor_id', 'progress'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}