<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <template x-for="team in teams" :key="team.name">
            <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold" x-text="team.name"></h3>
                    <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full" x-text="`${team.members.length} members`"></span>
                </div>
                <p class="text-sm text-gray-600 mb-4" x-text="`Mentor: ${team.mentor}`"></p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <template x-for="member in team.members" :key="member.name">
                        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-medium" x-text="member.name.split(' ').map(n => n[0]).join('')"></div>
                    </template>
                </div>
                <div class="space-y-2">
                    <p class="text-sm font-medium">Submission Progress:</p>
                    <template x-for="submission in team.submissions" :key="submission.name">
                        <div class="flex items-center justify-between">
                            <span class="text-sm" x-text="submission.name"></span>
                            <div class="w-1/2 bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" :style="`width: ${submission.progress}%`"></div>
                            </div>
                            <span class="text-sm font-medium" x-text="`${submission.progress}%`"></span>
                        </div>
                    </template>
                </div>
                <button @click="selectedTeam = team" class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition-colors duration-300">Manage Team</button>
            </div>
        </template>
    </div>

    <div x-show="selectedTeam" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" x-cloak>
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2" x-text="selectedTeam.name + ' Details'"></h3>
                <div class="mt-2 px-7 py-3">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-semibold mb-2">Team Members</h4>
                            <template x-for="member in selectedTeam.members" :key="member.name">
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
                            <template x-for="submission in selectedTeam.submissions" :key="submission.name">
                                <div class="flex justify-between items-center mb-2">
                                    <span x-text="submission.name"></span>
                                    <div class="w-1/3 bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" :style="`width: ${submission.progress}%`"></div>
                                    </div>
                                    <span x-text="`${submission.progress}%`"></span>
                                    <button class="px-3 py-1 bg-gray-200 text-gray-800 text-xs font-medium rounded hover:bg-gray-300 transition-colors duration-300">View</button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="items-center px-4 py-3">
                    <button @click="selectedTeam = null" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>