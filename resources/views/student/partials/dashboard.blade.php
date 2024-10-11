<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white shadow rounded-lg p-4">
        <h3 class="text-lg font-semibold mb-2">Upcoming Appointments</h3>
        <ul class="space-y-4">
            <li class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                <div>
                    <p class="font-medium">Meeting with John Doe</p>
                    <p class="text-sm text-gray-500">Mentor - React Specialist</p>
                </div>
                <div class="flex items-center space-x-2">
                    <i data-feather="calendar" class="h-4 w-4 text-primary"></i>
                    <span class="text-sm">Today, 2:00 PM</span>
                    <button class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i data-feather="video" class="h-4 w-4"></i>
                    </button>
                </div>
            </li>
            <li class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                <div>
                    <p class="font-medium">Group Study Session</p>
                    <p class="text-sm text-gray-500">Advanced Algorithms</p>
                </div>
                <div class="flex items-center space-x-2">
                    <i data-feather="calendar" class="h-4 w-4 text-primary"></i>
                    <span class="text-sm">Tomorrow, 4:00 PM</span>
                    <button class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i data-feather="video" class="h-4 w-4"></i>
                    </button>
                </div>
            </li>
        </ul>
        <button class="mt-4 w-full px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            View All Appointments
        </button>
    </div>

    <div class="bg-white shadow rounded-lg p-4">
        <h3 class="text-lg font-semibold mb-2">Recent Feedback</h3>
        <div class="space-y-4">
            <div>
                <div class="flex justify-between items-center mb-2">
                    <h4 class="font-semibold">React Project</h4>
                    <div class="flex items-center">
                        <span class="mr-2 font-medium">4.5</span>
                        <i data-feather="star" class="h-5 w-5 text-yellow-400"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Great work on component structure and state management!</p>
            </div>
            <hr>
            <div>
                <div class="flex justify-between items-center mb-2">
                    <h4 class="font-semibold">Database Design</h4>
                    <div class="flex items-center">
                        <span class="mr-2 font-medium">4.0</span>
                        <i data-feather="star" class="h-5 w-5 text-yellow-400"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Good normalization, consider optimizing queries further.</p>
            </div>
        </div>
     
        <button class="mt-4 w-full px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            View All Feedback
        </button>
    </div>

    <div class="bg-white shadow rounded-lg p-4">
        <h3 class="text-lg font-semibold mb-2">Submission Status</h3>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium">React Fundamentals Project</span>
                <span class="px-4 py-2 text-xs font-semibold rounded bg-green-100 text-green-800">Submitted</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium">Advanced JavaScript Quiz</span>
                <span class="px-4 py-2 text-xs font-semibold rounded bg-yellow-100 text-yellow-800">Pending</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium">Node.js API Project</span>
                <span class="px-4 py-2 text-xs font-semibold rounded bg-red-100 text-red-800">Not Submitted</span>
            </div>
        </div>
        <button class="mt-4 w-full px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            View All Assignments
        </button>
    </div>
</div>