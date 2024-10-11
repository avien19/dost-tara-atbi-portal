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
        $teams = [
            [
                'name' => 'Team Alpha',
                'mentor' => 'John Doe',
                'members' => [
                    ['name' => 'Alice Johnson', 'role' => 'Team Lead'],
                    ['name' => 'Bob Smith', 'role' => 'Developer'],
                    ['name' => 'Charlie Brown', 'role' => 'Designer']
                ],
                'submissions' => [
                    ['name' => 'Pitch Deck', 'progress' => 80],
                    ['name' => 'Business Model', 'progress' => 60],
                    ['name' => 'Financial Projections', 'progress' => 40]
                ]
            ],
            // Add more teams here...
        ];
        $classrooms = [
            [
                'id' => 1,
                'name' => 'Classroom A',
                'team' => 'Team Alpha',
                'mentor' => 'John Doe',
                'progress' => 75,
                'activities' => [
                    ['name' => 'Pitch Practice', 'type' => 'Workshop', 'dueDate' => '2023-06-15', 'submissions' => 3, 'totalStudents' => 5],
                    ['name' => 'Financial Modeling', 'type' => 'Assignment', 'dueDate' => '2023-06-20', 'submissions' => 2, 'totalStudents' => 5]
                ]
            ],
        ];
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
        $mentorRequests = [
            ['id' => 1, 'student' => 'Alice Johnson', 'team' => 'Team Alpha', 'requestedMentor' => 'John Doe', 'status' => 'Pending'],
            ['id' => 2, 'student' => 'Bob Smith', 'team' => 'Team Beta', 'requestedMentor' => 'Jane Smith', 'status' => 'Approved'],
            ['id' => 3, 'student' => 'Charlie Brown', 'team' => 'Team Gamma', 'requestedMentor' => 'Bob Johnson', 'status' => 'Pending'],
        ];
        $messages = Message::latest()->take(5)->get();
        $mentors = [
            ['id' => 1, 'name' => 'John Doe', 'expertise' => 'Business Strategy', 'teams' => 3],
            ['id' => 2, 'name' => 'Jane Smith', 'expertise' => 'Marketing', 'teams' => 2],
            ['id' => 3, 'name' => 'Bob Johnson', 'expertise' => 'Finance', 'teams' => 4],
        ];

        $menuItems = [
            ['name' => 'Dashboard', 'icon' => 'bar-chart', 'tab' => 'dashboard'],
            ['name' => 'Students & Teams', 'icon' => 'users', 'tab' => 'students'],
            ['name' => 'Classrooms', 'icon' => 'school', 'tab' => 'classrooms'],
            ['name' => 'Mentor Requests', 'icon' => 'user-plus', 'tab' => 'mentorRequests'],
            ['name' => 'Documents', 'icon' => 'file-text', 'tab' => 'documents'],
            ['name' => 'Messages', 'icon' => 'message-square', 'tab' => 'messages'],
            ['name' => 'Settings', 'icon' => 'settings', 'tab' => 'settings'],
        ];

        $activeStudents = array_sum(array_map(function($team) {
            return count($team['members']);
        }, $teams));

        return view('admin.dashboard', compact('teams', 'classrooms', 'activeStudents', 'recentActivities', 'documents', 'mentorRequests', 'messages', 'menuItems', 'mentors'));
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