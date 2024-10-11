<div x-show="activeTab === 'mentors'" class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <template x-for="mentor in mentors" :key="mentor.id">
            <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-lg font-semibold mb-2" x-text="mentor.name"></h3>
                <p class="text-sm text-gray-600 mb-4" x-text="`Expertise: ${mentor.expertise}`"></p>
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium">Teams Mentoring:</span>
                    <span class="text-2xl font-bold" x-text="mentor.teams"></span>
                </div>
                <button class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition-colors duration-300">View Details</button>
            </div>
        </template>
    </div>
    <div class="mt-6">
        <button class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition-colors duration-300">
            <i data-lucide="user-plus" class="inline-block w-4 h-4 mr-2"></i>
            Add New Mentor
        </button>
    </div>
</div>