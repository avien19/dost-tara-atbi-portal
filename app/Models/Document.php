<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'category',
        'user_id',
        'team_id',
        'submission_date',
        'status'
    ];

    protected $casts = [
        'submission_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scope for admin view
    public function scopeForAdminDashboard($query)
    {
        return $query->selectRaw('category, COUNT(*) as submissions, (SELECT COUNT(*) FROM teams) as totalTeams')
                     ->groupBy('category');
    }

    // Scope for student view
    public function scopeForStudent($query, $userId)
    {
        return $query->where('user_id', $userId)->orWhereHas('team', function ($q) use ($userId) {
            $q->whereHas('members', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            });
        });
    }
}