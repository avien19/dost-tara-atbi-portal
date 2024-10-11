@extends('layouts.app')

@section('content')
<div x-data="{
    activeTab: 'dashboard',
    selectedTeam: null,
    selectedClassroom: null,
    classrooms: {{ json_encode($classrooms) }},
    teams: {{ json_encode($teams) }},
    mentorRequests: {{ json_encode($mentorRequests) }},
    documents: {{ json_encode($documents) }},
    messages: {{ json_encode($messages) }},
    menuItems: [
        { name: 'Dashboard', icon: 'bar-chart', tab: 'dashboard' },
        { name: 'Students & Teams', icon: 'users', tab: 'students' },
        { name: 'Classrooms', icon: 'school', tab: 'classrooms' },
        { name: 'Mentor Requests', icon: 'user-plus', tab: 'mentorRequests' },
        { name: 'Documents', icon: 'file-text', tab: 'documents' },
        { name: 'Messages', icon: 'message-square', tab: 'messages' },
        { name: 'Settings', icon: 'settings', tab: 'settings' }
    ],
    handleMentorRequestApproval(requestId) {
        const request = this.mentorRequests.find(req => req.id === requestId);
        if (request) {
            const newClassroom = {
                id: this.classrooms.length + 1,
                name: `${request.team} Classroom`,
                team: request.team,
                mentor: request.requestedMentor,
                progress: 0,
                activities: []
            };
            this.classrooms.push(newClassroom);
            this.mentorRequests = this.mentorRequests.filter(req => req.id !== requestId);
        }
    }
}" class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    @include('admin.partials.sidebar', ['menuItems' => $menuItems])

    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        @include('admin.partials.header')

        <main class="flex-1 overflow-auto bg-gray-50">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                @include('admin.partials.dashboard')
                @include('admin.partials.students')
                @include('admin.partials.classrooms')
                @include('admin.partials.mentor-requests')
                @include('admin.partials.documents')
                @include('admin.partials.messages')
                @include('admin.partials.settings')
            </div>
        </main>
    </div>
</div>
@endsection