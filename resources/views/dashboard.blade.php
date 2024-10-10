@extends('layouts.app')

@section('content')
    <div x-data="{ activeTab: 'dashboard' }" class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-4">
                <h2 class="text-2xl font-bold text-primary">TARA-ATBI</h2>
            </div>
            <div class="p-4">
                <div class="bg-white shadow rounded-lg p-4">
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-20 bg-gray-300 rounded-full mb-4 overflow-hidden">
                            <img src="{{ auth()->user()->photo ? asset('storage/users/' . auth()->user()->photo) : asset('images/default-user-profile-image.png') }}"
                                alt="user_image" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-semibold text-lg">{{ auth()->user()->name }}</h3>
                        <p class="text-sm text-gray-600">{{ auth()->user()->role }}</p>
                    </div>
                </div>
            </div>
            <nav class="mt-6 px-4">
                @php
                    $menuItems = [
                        ['name' => 'Dashboard', 'icon' => 'book', 'tab' => 'dashboard'],
                        ['name' => 'Mentors', 'icon' => 'users', 'tab' => 'mentors'],
                        ['name' => 'Appointments', 'icon' => 'calendar', 'tab' => 'appointments'],
                        ['name' => 'Feedback', 'icon' => 'star', 'tab' => 'feedback'],
                        ['name' => 'Classroom', 'icon' => 'book', 'tab' => 'classroom'],
                        ['name' => 'Documents', 'icon' => 'file-text', 'tab' => 'documents'],
                        ['name' => 'Community', 'icon' => 'message-square', 'tab' => 'community'],
                        ['name' => 'Team Chart', 'icon' => 'git-branch', 'tab' => 'teamchart'],
                        ['name' => 'Settings', 'icon' => 'settings', 'tab' => 'settings'],
                    ];
                @endphp
                @foreach ($menuItems as $item)
                    <button @click="activeTab = '{{ $item['tab'] }}'"
                        class="flex items-center w-full px-4 py-3 mb-2 transition-colors rounded-lg"
                        :class="{ 'bg-blue-500 text-white': activeTab === '{{ $item['tab'] }}', 'text-gray-600 hover:bg-gray-100 hover:text-gray-800': activeTab !== '{{ $item['tab'] }}' }">
                        <i data-lucide="{{ $item['icon'] }}" class="h-5 w-5 mr-3"></i>
                        <span>{{ $item['name'] }}</span>
                    </button>
                @endforeach
            </nav>
            <div class="p-4">
                <hr class="my-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-4 py-2 text-left text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i data-lucide="log-out" class="h-5 w-5 mr-3"></i>
                        <span>Log out</span>
                    </button>
                </form>
            </div>
        </aside>
<div x-data="{ activeTab: 'dashboard' }" class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
    <div class="p-4 flex items-center space-x-2">
    <!-- <img src="" alt="TARA logo" class="w-16 h-16">  -->
    <h4 class="text-2xl font-bold text-primary">TARA-ATBI</h4>
</div>

        <div class="p-4">
            <div class="bg-white shadow rounded-lg p-4">
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 bg-gray-300 rounded-full mb-4"></div>
                    <h3 class="font-semibold text-lg">{{auth()->user()->name}}</h3>
                    <p class="text-sm text-gray-600">{{auth()->user()->role}}</p>
                </div>
            </div>
        </div>
        <nav class="mt-6 px-4">
            @php
            $menuItems = [
                ['name' => 'Dashboard', 'icon' => 'book', 'tab' => 'dashboard'],
                ['name' => 'Mentors', 'icon' => 'users', 'tab' => 'mentors'],
                ['name' => 'Appointments', 'icon' => 'calendar', 'tab' => 'appointments'],
                ['name' => 'Feedback', 'icon' => 'star', 'tab' => 'feedback'],
                ['name' => 'Classroom', 'icon' => 'book', 'tab' => 'classroom'],
                ['name' => 'Documents', 'icon' => 'file-text', 'tab' => 'documents'],
                ['name' => 'Community', 'icon' => 'message-square', 'tab' => 'community'],
                ['name' => 'Team Chart', 'icon' => 'git-branch', 'tab' => 'teamchart'],
                ['name' => 'Settings', 'icon' => 'settings', 'tab' => 'settings'],
            ];
            @endphp
            @foreach($menuItems as $item)
                <button
                    @click="activeTab = '{{ $item['tab'] }}'"
                    class="flex items-center w-full px-2 py-2 mb-2 transition-colors rounded-lg"
                    :class="{'bg-green-500 text-white': activeTab === '{{ $item['tab'] }}', 'text-gray-600 hover:bg-gray-100 hover:text-gray-800': activeTab !== '{{ $item['tab'] }}'}"
                >
                    <i data-lucide="{{ $item['icon'] }}" class="h-5 w-5 mr-3"></i>
                    <span>{{ $item['name'] }}</span>
                </button>
            @endforeach
        </nav>
        <div class="p-4">
            <hr class="my-4">
            <!-- <form method="POST" action="{{ route('logout') }}">
                @csrf
            <button type="submit" class="flex items-center w-full px-4 py-2 text-left text-gray-600 hover:bg-gray-100 rounded-lg">
                <i data-lucide="log-out" class="h-5 w-5 mr-3"></i>
                <span>Log out</span>
            </button>
            </form> -->
        </div>
    </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm z-10">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <h1 class="text-2xl font-semibold text-gray-900"
                        x-text="activeTab.charAt(0).toUpperCase() + activeTab.slice(1)"></h1>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="search" placeholder="Search..."
                                class="pl-8 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <i data-lucide="search" class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-500"></i>
                        </div>
                        <button
                            class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i data-lucide="bell" class="h-6 w-6"></i>
                        </button>
                        <button
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i data-lucide="message-square" class="h-4 w-4 mr-2"></i>
                            Message Admin
                        </button>
                    </div>
                </div>
            </header>
    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white shadow-sm z-10">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900" x-text="activeTab.charAt(0).toUpperCase() + activeTab.slice(1)"></h1>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="search" placeholder="Search..." class="pl-8 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <i data-lucide="search" class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-500"></i>
                    </div>
                    <button class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i data-lucide="bell" class="h-6 w-6"></i>
                    </button>
                    <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-500 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
    <i data-lucide="message-square" class="h-4 w-4 mr-2"></i>
    Message Admin
</button>


                    <form method="POST" action="{{ route('logout') }}">
                @csrf
            <button type="submit" class="flex items-center w-full px-4 py-2 text-left text-gray-600 hover:bg-gray-100 rounded-lg">
                <i data-lucide="log-out" class="h-5 w-5"></i>

            </button>
            </form>
                </div>
            </div>
        </header>

            <main class="flex-1 overflow-auto bg-gray-50">
                <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                    <div x-show="activeTab === 'dashboard'">
                        @include('student.partials.dashboard')
                    </div>
                    <div x-show="activeTab === 'mentors'">
                        @include('student.partials.mentors')
                    </div>
                    <div x-show="activeTab === 'appointments'">
                        @include('student.partials.appointments')
                    </div>
                    <div x-show="activeTab === 'feedback'">
                        @include('student.partials.feedback')
                    </div>
                    <div x-show="activeTab === 'classroom'">
                        @include('student.partials.classroom')
                    </div>
                    <div x-show="activeTab === 'documents'">
                        @include('student.partials.documents')
                    </div>
                    <div x-show="activeTab === 'community'">
                        @include('student.partials.community')
                    </div>
                    <div x-show="activeTab === 'teamchart'">
                        @include('student.partials.teamchart')
                    </div>
                    <div x-show="activeTab === 'settings'">
                        @include('student.partials.settings')
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
