<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Classroom;
use App\Models\MentorRequest;
use App\Models\Document;
use App\Models\Message;

class AdminController extends Controller
{
    public function dashboard()
    {
        $teams = Team::with('members')->get();
        $classrooms = Classroom::all();
        $activeStudents = $teams->sum(function($team) {
            return $team->members->count();
        });
        $recentActivities = [
            ['action' => 'New team registered', 'time' => '5 minutes ago'],
            ['action' => 'Pitch deck submitted by Team Alpha', 'time' => '1 hour ago'],
            ['action' => 'New mentor request received', 'time' => '2 hours ago'],
            ['action' => 'Business model canvas submitted by Team Beta', 'time' => '3 hours ago'],
            ['action' => 'New mentor assigned to Team Gamma', 'time' => '5 hours ago'],
        ];
        $documents = [
            ['category' => 'Pitch Deck', 'submissions' => 18, 'totalTeams' => 25],
            ['category' => 'Business Model', 'submissions' => 22, 'totalTeams' => 25],
            ['category' => 'Financial Projections', 'submissions' => 15, 'totalTeams' => 25],
        ];
        $mentorRequests = MentorRequest::all();
        $messages = Message::latest()->take(5)->get();

        $menuItems = [
            ['name' => 'Dashboard', 'icon' => 'bar-chart', 'tab' => 'dashboard'],
            ['name' => 'Students & Teams', 'icon' => 'users', 'tab' => 'students'],
            ['name' => 'Classrooms', 'icon' => 'school', 'tab' => 'classrooms'],
            ['name' => 'Mentor Requests', 'icon' => 'user-plus', 'tab' => 'mentorRequests'],
            ['name' => 'Documents', 'icon' => 'file-text', 'tab' => 'documents'],
            ['name' => 'Messages', 'icon' => 'message-square', 'tab' => 'messages'],
            ['name' => 'Settings', 'icon' => 'settings', 'tab' => 'settings'],
        ];

        return view('admin.dashboard', compact('teams', 'classrooms', 'activeStudents', 'recentActivities', 'documents', 'mentorRequests', 'messages', 'menuItems'));
    }

    public function index()
    {
        $menuItems = [
            ['name' => 'Dashboard', 'icon' => 'bar-chart', 'tab' => 'dashboard'],
            ['name' => 'Students & Teams', 'icon' => 'users', 'tab' => 'students'],
            ['name' => 'Classrooms', 'icon' => 'school', 'tab' => 'classrooms'],
            ['name' => 'Mentor Requests', 'icon' => 'user-plus', 'tab' => 'mentorRequests'],
            ['name' => 'Documents', 'icon' => 'file-text', 'tab' => 'documents'],
            ['name' => 'Messages', 'icon' => 'message-square', 'tab' => 'messages'],
            ['name' => 'Settings', 'icon' => 'settings', 'tab' => 'settings'],
        ];

        $teams = Team::with('members')->get();
        $classrooms = Classroom::all();
        $activeStudents = $teams->sum(function($team) {
            return $team->members->count();
        });
        $recentActivities = [
            ['action' => 'New team registered', 'time' => '5 minutes ago'],
            ['action' => 'Pitch deck submitted by Team Alpha', 'time' => '1 hour ago'],
            ['action' => 'New mentor request received', 'time' => '2 hours ago'],
            ['action' => 'Business model canvas submitted by Team Beta', 'time' => '3 hours ago'],
            ['action' => 'New mentor assigned to Team Gamma', 'time' => '5 hours ago'],
        ];
        $documents = [
            ['category' => 'Pitch Deck', 'submissions' => 18, 'totalTeams' => 25],
            ['category' => 'Business Model', 'submissions' => 22, 'totalTeams' => 25],
            ['category' => 'Financial Projections', 'submissions' => 15, 'totalTeams' => 25],
        ];
        $mentorRequests = MentorRequest::all();
        $messages = Message::latest()->take(5)->get();

        return view('admin.dashboard', compact('menuItems', 'classrooms', 'teams', 'mentorRequests', 'documents', 'messages'));
    }

    // Add other methods as needed
}