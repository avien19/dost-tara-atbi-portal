<div x-show="activeTab === 'students'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($teams as $team)
        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
            <h3 class="text-lg font-semibold mb-2 flex justify-between items-center">
                <span>{{ $team['name'] }}</span>
                <span class="text-sm font-medium px-2 py-1 bg-gray-100 rounded-full">{{ count($team['members']) }} members</span>
            </h3>
            <p class="text-sm text-gray-600 mb-4">Mentor: {{ $team['mentor'] }}</p>
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach ($team['members'] as $member)
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-medium">
                        {{ substr($member['name'], 0, 2) }}
                    </div>
                @endforeach
            </div>
            <div class="space-y-2">
                <p class="text-sm font-medium">Submission Progress:</p>
                @foreach ($team['submissions'] as $submission)
                    <div class="flex items-center justify-between">
                        <span class="text-sm">{{ $submission['name'] }}</span>
                        <div class="w-1/2 bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $submission['progress'] }}%"></div>
                        </div>
                        <span class="text-sm font-medium">{{ $submission['progress'] }}%</span>
                    </div>
                @endforeach
            </div>
            <button @click="selectedTeam = {{ json_encode($team) }}" class="mt-4 w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300">View Details</button>
        </div>
    @endforeach
</div>

<div x-show="selectedTeam" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="team-modal">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900" x-text="selectedTeam.name + ' Details'"></h3>
            <div class="mt-2 px-7 py-3">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h4 class="font-semibold mb-2">Team Members</h4>
                        <template x-for="member in selectedTeam.members">
                            <div class="flex items-center space-x-2 mb-2">
                                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-medium" x-text="member.name.split(' ').map(n => n[0]).join('')"></div>
                                <div>
                                    <p class="font-medium" x-text="member.name"></p>
                                    <p class="text-sm text-gray-600" x-text="member.role"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">Submissions</h4>
                        <template x-for="submission in selectedTeam.submissions">
                            <div class="flex justify-between items-center mb-2">
                                <span x-text="submission.name"></span>
                                <div class="w-1/3 bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" :style="'width: ' + submission.progress + '%'"></div>
                                </div>
                                <span x-text="submission.progress + '%'"></span>
                                <button class="px-2 py-1 bg-gray-200 text-sm rounded">View</button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            <div class="items-center px-4 py-3">
                <button id="ok-btn" @click="selectedTeam = null" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>