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
    menuItems: {{ json_encode($menuItems) }},
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
    @include('admin.partials.sidebar')

    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        @include('admin.partials.header')

            <main class="flex-1 overflow-auto bg-gray-50">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div x-show="activeTab === 'dashboard'">
                @include('admin.partials.dashboard')
            </div>
            <div x-show="activeTab === 'students'">
                @include('admin.partials.students')
            </div>
            <div x-show="activeTab === 'classrooms'">
                @include('admin.partials.classrooms')
            </div>
            <div x-show="activeTab === 'mentorRequests'">
                @include('admin.partials.mentor-requests')
            </div>
            <div x-show="activeTab === 'documents'">
                @include('admin.partials.documents')
            </div>
            <div x-show="activeTab === 'messages'">
                @include('admin.partials.messages')
            </div>
            <div x-show="activeTab === 'mentors'">
                @include('admin.partials.mentors')
            </div>
            <div x-show="activeTab === 'settings'">
                @include('admin.partials.settings')
            </div>
        </div>
    </main>
    </div>
</div>
@endsection