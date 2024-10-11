<div x-data="{ 
    showModal: false, 
    showDiscardModal: false, 
    showConfirmModal: false,
    appointmentTitle: '',
    agenda: '',
    selectedMentor: '',
    appointmentDate: '',
    appointmentTime: ''
}" class="bg-white shadow rounded p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Manage Appointments</h2>
        <button @click="showModal = true" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm flex items-center">
            <i data-lucide="plus" class="h-4 w-4 mr-2 text-white-500"></i>Schedule New Appointment
        </button>
    </div>
    <p class="mb-6">Schedule and manage your appointments with mentors</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach(['John Doe', 'Jane Smith', 'Alex Johnson', 'Emily Brown', 'Michael Lee', 'Sarah Wilson'] as $mentor)
            <div class="bg-white shadow rounded p-5 flex flex-col justify-between h-64">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white text-lg font-bold mr-3">
                                {{ substr($mentor, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-semibold text-sm">{{ $mentor }}</h4>
                                <p class="text-xs text-gray-600">React & Node.js Expert</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">Upcoming</span>
                    </div>
                    <div class="flex flex-col text-sm mb-4">
                        <div class="flex items-center mb-2">
                            <i data-lucide="calendar" class="h-4 w-4 mr-2 text-gray-500"></i>
                            <span>March 15, 2024</span>
                        </div>
                        <div class="flex items-center">
                            <i data-lucide="clock" class="h-4 w-4 mr-2 text-gray-500"></i>
                            <span>2:00 PM - 3:00 PM</span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between">
                    <button class="px-4 py-2 text-sm border border-green-500 text-green-500 rounded hover:bg-green-100">Reschedule</button>
                    <button class="px-4 py-2 text-sm bg-green-500 text-white rounded hover:bg-green-600">Join Meeting</button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Add Appointment Modal -->
    <div x-show="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" x-cloak>
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Schedule New Appointment</h3>
                <div class="mt-2 px-7 py-3">
                    <input x-model="appointmentTitle" type="text" placeholder="Appointment Title" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                    <textarea x-model="agenda" placeholder="Agenda" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"></textarea>
                    <select x-model="selectedMentor" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                        <option value="">Select Mentor</option>
                        @foreach(['John Doe', 'Jane Smith', 'Alex Johnson', 'Emily Brown', 'Michael Lee', 'Sarah Wilson'] as $mentor)
                            <option value="{{ $mentor }}">{{ $mentor }}</option>
                        @endforeach
                    </select>
                    <input x-model="appointmentDate" type="date" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                    <input x-model="appointmentTime" type="time" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1">
                </div>
                <div class="items-center px-4 py-3">
                    <button @click="showDiscardModal = true" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Discard
                    </button>
                    <button @click="showConfirmModal = true" class="mt-3 px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                        Schedule Appointment
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Discard Confirmation Modal -->
    <div x-show="showDiscardModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" x-cloak>
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Your changes will be discarded</h3>
                <div class="items-center px-4 py-3">
                    <button @click="showDiscardModal = false; showModal = false;" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Confirm Discard
                    </button>
                    <button @click="showDiscardModal = false" class="mt-3 px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Confirmation Modal -->
    <div x-show="showConfirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" x-cloak>
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Confirm to schedule appointment</h3>
                <div class="items-center px-4 py-3">
                    <button @click="showConfirmModal = false; showModal = false;" class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                        Confirm Schedule
                    </button>
                    <button @click="showConfirmModal = false" class="mt-3 px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>