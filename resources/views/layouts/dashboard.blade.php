@extends('layouts.app')

@section('content')
<div x-data="{ activeTab: 'dashboard' }">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div x-show="activeTab === 'dashboard'">
            <!-- Dashboard content -->
            @include('partials.dashboard')
        </div>

        <div x-show="activeTab === 'mentors'">
            <!-- Mentors content -->
            @include('partials.mentors')
        </div>

        <div x-show="activeTab === 'appointments'">
            <!-- Appointments content -->
            @include('partials.appointments')
        </div>

        <div x-show="activeTab === 'feedback'">
            <!-- Feedback content -->
            @include('partials.feedback')
        </div>

        <div x-show="activeTab === 'classroom'">
            <!-- Classroom content -->
            @include('partials.classroom')
        </div>

        <div x-show="activeTab === 'documents'">
            <!-- Documents content -->
            @include('partials.documents')
        </div>

        <div x-show="activeTab === 'community'">
            <!-- Community content -->
            @include('partials.community')
        </div>

        <div x-show="activeTab === 'teamchart'">
            <!-- Team Chart content -->
            @include('partials.teamchart')
        </div>

        <div x-show="activeTab === 'settings'">
            <!-- Settings content -->
            @include('partials.settings')
        </div>
    </div>
</div>
@endsection