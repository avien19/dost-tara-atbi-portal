<div class="bg-white shadow rounded p-6">
    <h2 class="text-2xl font-bold mb-4">Manage Appointments</h2>
    <p class="mb-6">Schedule and manage your appointments with mentors</p>

    <div class="space-y-4">
        @foreach(['John Doe', 'Jane Smith', 'Alex Johnson'] as $mentor)
            <div class="bg-white shadow rounded p-4">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4">
                            {{ substr($mentor, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-semibold">{{ $mentor }}</h4>
                            <p class="text-sm text-gray-600">React & Node.js Expert</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">Upcoming</span>
                </div>
                <div class="flex items-center justify-between text-sm mb-4">
                    <div class="flex items-center">
                        <i data-feather="calendar" class="h-4 w-4 mr-2"></i>
                        <span>March 15, 2024</span>
                    </div>
                    <div class="flex items-center">
                        <i data-feather="clock" class="h-4 w-4 mr-2"></i>
                        <span>2:00 PM - 3:00 PM</span>
                    </div>
                </div>
                <div class="flex justify-between">
                    <button class="px-4 py-2 border border-green-500 text-green-500 rounded hover:bg-green-100">Reschedule</button>
                    <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Join Meeting</button>
                </div>
            </div>
        @endforeach
    </div>
    <button class="mt-6 w-full px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Schedule New Appointment</button>
</div>
