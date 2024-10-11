<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $classrooms = [
            [
                'id' => 1,
                'name' => 'Web Development Fundamentals',
                'team' => 'Team Alpha',
                'mentor' => 'John Doe',
                'progress' => 75,
                'activities' => [
                    ['name' => 'HTML & CSS Basics', 'type' => 'Assignment', 'dueDate' => '2023-06-15', 'submissions' => 3, 'totalStudents' => 3],
                    ['name' => 'JavaScript Fundamentals', 'type' => 'Quiz', 'dueDate' => '2023-06-20', 'submissions' => 2, 'totalStudents' => 3],
                    ['name' => 'Responsive Design Project', 'type' => 'Project', 'dueDate' => '2023-06-25', 'submissions' => 3, 'totalStudents' => 3],
                ]
            ],
            // Add more classrooms...
        ];

        $teams = [
            [
                'name' => 'Team Alpha',
                'mentor' => 'John Doe',
                'members' => [
                    ['name' => 'Alice Johnson', 'role' => 'Team Lead'],
                    ['name' => 'Bob Smith', 'role' => 'Developer'],
                    ['name' => 'Charlie Brown', 'role' => 'Designer'],
                ],
                'submissions' => [
                    ['name' => 'Pitch Deck', 'progress' => 80],
                    ['name' => 'Business Model', 'progress' => 60],
                    ['name' => 'Financial Projections', 'progress' => 40],
                ],
            ],
            // Add more teams...
        ];

        $mentorRequests = [
            ['id' => 1, 'student' => 'Emma Watson', 'team' => 'Team Delta', 'requestedMentor' => 'David Beckham', 'status' => 'Pending'],
            ['id' => 2, 'student' => 'Tom Hardy', 'team' => 'Team Epsilon', 'requestedMentor' => 'Angelina Jolie', 'status' => 'Pending'],
            ['id' => 3, 'student' => 'Scarlett Johansson', 'team' => 'Team Zeta', 'requestedMentor' => 'Robert Downey Jr.', 'status' => 'Pending'],
        ];

        $documents = [
            ['category' => 'Pitch Deck', 'submissions' => 18, 'totalTeams' => 25],
            ['category' => 'Business Model', 'submissions' => 22, 'totalTeams' => 25],
            ['category' => 'Financial Projections', 'submissions' => 15, 'totalTeams' => 25],
        ];

        $messages = [
            ['from' => 'Alice Johnson', 'subject' => 'Question about course material', 'date' => '2023-05-20', 'status' => 'Unread'],
            ['from' => 'Bob Smith', 'subject' => 'Mentor application follow-up', 'date' => '2023-05-19', 'status' => 'Read'],
            ['from' => 'Charlie Brown', 'subject' => 'Technical issue report', 'date' => '2023-05-18', 'status' => 'Unread'],
            ['from' => 'Diana Ross', 'subject' => 'Feedback on recent webinar', 'date' => '2023-05-17', 'status' => 'Read'],
            ['from' => 'Edward Norton', 'subject' => 'Request for additional resources', 'date' => '2023-05-16', 'status' => 'Read'],
        ];

        $menuItems = [
            ['name' => 'Dashboard', 'icon' => 'bar-chart', 'tab' => 'dashboard'],
            ['name' => 'Students & Teams', 'icon' => 'users', 'tab' => 'students'],
            ['name' => 'Classrooms', 'icon' => 'school', 'tab' => 'classrooms'],
            ['name' => 'Mentor Requests', 'icon' => 'user-plus', 'tab' => 'mentorRequests'],
            ['name' => 'Documents', 'icon' => 'file-text', 'tab' => 'documents'],
            ['name' => 'Messages', 'icon' => 'message-square', 'tab' => 'messages'],
            ['name' => 'Settings', 'icon' => 'settings', 'tab' => 'settings']
        ];

        $mentorRequests = [
            [
                'id' => 1,
                'student' => 'Alice Johnson',
                'team' => 'Team Alpha',
                'requestedMentor' => 'John Doe',
                'status' => 'Pending'
            ],
            // Add more mentor requests as needed
        ];

        return view('admin.dashboard', compact('classrooms', 'teams', 'mentorRequests', 'documents', 'messages', 'menuItems'));
    }

    public function handleMentorRequestApproval(Request $request, $requestId)
    {
        // Implement the logic to approve mentor requests
        // This is where you would update the database
        return response()->json(['success' => true]);
    }
}