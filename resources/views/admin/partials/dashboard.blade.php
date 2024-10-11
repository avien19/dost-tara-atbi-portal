<div x-show="activeTab === 'dashboard'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4">Platform Overview</h3>
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <span class="text-sm font-medium">Total Teams</span>
                <span class="text-2xl font-bold">{{ count($teams) }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm font-medium">Active Students</span>
                <span class="text-2xl font-bold">{{ $teams->sum(function($team) { return count($team['members']); }) }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm font-medium">Classrooms</span>
                <span class="text-2xl font-bold">{{ count($classrooms) }}</span>
            </div>
        </div>
    </div>
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4">Recent Activities</h3>
        <div class="space-y-4">
            <!-- Add recent activities here -->
        </div>
    </div>
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4">Document Submissions</h3>
        <div class="space-y-4">
            @foreach($documents as $doc)
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium">{{ $doc['category'] }}</span>
                    <span class="text-2xl font-bold">{{ $doc['submissions'] }}/{{ $doc['totalTeams'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>