<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorRequest extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'team_id', 'requested_mentor_id', 'status'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function requestedMentor()
    {
        return $this->belongsTo(User::class, 'requested_mentor_id');
    }
}