<div x-show="activeTab === 'classrooms'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($classrooms as $classroom)
        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
            <h3 class="text-lg font-semibold mb-2">{{ $classroom['name'] }}</h3>
            <p class="text-sm text-gray-600 mb-4">Team: {{ $classroom['team'] }}</p>
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <span>Mentor:</span>
                    <span class="font-medium">{{ $classroom['mentor'] }}</span>
                </div>
                <div class="space-y-1">
                    <div class="flex justify-between text-sm">
                        <span>Progress:</span>
                        <span>{{ $classroom['progress'] }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $classroom['progress'] }}%"></div>
                    </div>
                </div>
            </div>
            <button @click="selectedClassroom = {{ json_encode($classroom) }}" class="mt-4 w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300">View Classroom</button>
        </div>
    @endforeach
</div>

<div x-show="selectedClassroom" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="classroom-modal">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900" x-text="selectedClassroom.name"></h3>
            <div class="mt-2 px-7 py-3">
                <div class="space-y-4">
                    <div>
                        <h4 class="font-semibold mb-2">Classroom Details</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p><span class="font-medium">Team:</span> <span x-text="selectedClassroom.team"></span></p>
                                <p><span class="font-medium">Mentor:</span> <span x-text="selectedClassroom.mentor"></span></p>
                            </div>
                            <div>
                                <p><span class="font-medium">Progress:</span> <span x-text="selectedClassroom.progress + '%'"></span></p>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                    <div class="bg-blue-600 h-2.5 rounded-full" :style="'width: ' + selectedClassroom.progress + '%'"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">Assigned Activities</h4>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submissions</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <template x-for="activity in selectedClassroom.activities">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap" x-text="activity.name"></td>
                                        <td class="px-6 py-4 whitespace-nowrap" x-text="activity.type"></td>
                                        <td class="px-6 py-4 whitespace-nowrap" x-text="activity.dueDate"></td>
                                        <td class="px-6 py-4 whitespace-nowrap" x-text="activity.submissions + '/' + activity.totalStudents"></td>
                                        <td class="px-6 py-4 whitespace-nowrap">