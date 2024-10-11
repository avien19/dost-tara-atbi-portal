<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Your logic here
        return view('dashboard');
    }

    private function getUpcomingAppointments()
    {
        return [
            ['title' => 'Meeting with John Doe', 'description' => 'Mentor - React Specialist', 'date' => 'Today, 2:00 PM'],
            ['title' => 'Group Study Session', 'description' => 'Advanced Algorithms', 'date' => 'Tomorrow, 4:00 PM'],
        ];
    }

    private function getRecentFeedback()
    {
        return [
            ['title' => 'React Project', 'rating' => 4.5, 'comment' => 'Great work on component structure and state management!'],
            ['title' => 'Database Design', 'rating' => 4.0, 'comment' => 'Good normalization, consider optimizing queries further.'],
        ];
    }

    private function getSubmissionStatus()
    {
        return [
            ['title' => 'React Fundamentals Project', 'status' => 'Submitted', 'status_class' => 'bg-green-100 text-green-800'],
            ['title' => 'Advanced JavaScript Quiz', 'status' => 'Pending', 'status_class' => 'bg-yellow-100 text-yellow-800'],
            ['title' => 'Node.js API Project', 'status' => 'Not Submitted', 'status_class' => 'bg-red-100 text-red-800'],
        ];
    }
}