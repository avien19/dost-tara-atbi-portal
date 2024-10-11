@extends('layouts.app')

@section('content')
<div x-data="{ activeTab: 'dashboard', showLogoutModal: false, showNotifications: false, showMessagePanel: false }" class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
    <div class="p-4 flex items-center space-x-2">
    <!-- <img src="" alt="TARA logo" class="w-16 h-16">  -->
    <h4 class="text-2xl font-bold text-primary">TARA-ATBI</h4>
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
                    <div class="relative">
                        <button @click="showNotifications = !showNotifications" class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <i data-lucide="bell" class="h-6 w-6"></i>
                            <!-- Notification Badge -->
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full">
                                2 <!-- Replace with actual notification count -->
                            </span>
                        </button>
                        <!-- Notification Panel -->
                        <div x-show="showNotifications" 
                             @click.away="showNotifications = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg overflow-hidden z-50">
                            <div class="py-2">
                                <div class="px-4 py-4 text-md font-bold text-gray-700 bg-gray-100">
                                    Notifications
                                </div>
                                <!-- Sample notifications -->
                                <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100">
                                    <p class="font-medium">New message</p>
                                    <p class="text-xs text-gray-500">You have a new message from your mentor.</p>
                                </a>
                                <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100">
                                    <p class="font-medium">Appointment reminder</p>
                                    <p class="text-xs text-gray-500">Your appointment is scheduled for tomorrow at 2 PM.</p>
                                </a>
                                <div class="px-4 py-2 text-sm text-center">
                                    <a href="#" class="text-green-600 hover:text-green-800">View all notifications</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button @click="showMessagePanel = true" class="flex items-center space-x-2 px-4 py-2 text-sm text-white bg-green-500 hover:bg-green-600 rounded-lg transition duration-150 ease-in-out">
                        <i data-lucide="message-square" class="h-5 w-5"></i>
                        <span>Message Admin</span>
                    </button>


                    <button @click="showLogoutModal = true" class="flex items-center px-2 py-2 text-left text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i data-lucide="log-out" class="h-5 w-5"></i>
                    </button>
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

    <!-- Backdrop -->
    <div x-show="showMessagePanel" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="showMessagePanel = false"
         class="fixed inset-0 bg-black bg-opacity-50 z-40">
    </div>

    <!-- Message Panel -->
    <div x-show="showMessagePanel" 
         x-transition:enter="transform transition ease-in-out duration-300"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transform transition ease-in-out duration-300"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="translate-y-full"
         @click.away="showMessagePanel = false"
         class="fixed bottom-5 right-5 w-100 h-96 bg-white shadow-xl overflow-hidden z-50 rounded-lg flex flex-col">
        <div class="p-4 border-b">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold">Message Admin</h2>
                <button @click="showMessagePanel = false" class="text-gray-500 hover:text-gray-700">
                    <i data-lucide="x" class="h-5 w-5"></i>
                </button>
            </div>
        </div>
        <div class="flex-grow overflow-y-auto p-4 space-y-4">
            <!-- Message history -->
            <div class="flex items-start space-x-3">
                <img src="https://via.placeholder.com/40" alt="Admin" class="w-10 h-10 rounded-full">
                <div class="bg-gray-100 p-3 rounded-lg">
                    <p class="text-sm">Hello! How can I help you today?</p>
                </div>
            </div>
            <div class="flex items-start space-x-3 justify-end">
                <div class="bg-green-100 p-3 rounded-lg max-w-[80%]">
                    <p class="text-sm">Hi, I have a question about my account.</p>
                </div>
                <img src="https://via.placeholder.com/40" alt="You" class="w-10 h-10 rounded-full flex-shrink-0">
            </div>
        </div>
        <div class="p-4 border-t">
            <div class="flex items-center space-x-2">
            <textarea class="flex-grow p-2 border border-gray-300 rounded-lg focus:outline-none" rows="2" placeholder="Type your message..."></textarea>

                <button class="p-2 bg-green-500 text-white rounded-full hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                    <i data-lucide="send" class="h-5 w-5"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div x-show="showLogoutModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showLogoutModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="showLogoutModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i data-lucide="alert-triangle" class="h-6 w-6 text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Confirm Logout
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to log out? 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Logout
                        </button>
                    </form>
                    <button @click="showLogoutModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection