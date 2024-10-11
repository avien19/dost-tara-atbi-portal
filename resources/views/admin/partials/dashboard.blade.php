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
                <span class="text-2xl font-bold">{{ array_reduce($teams, function($carry, $team) { return $carry + count($team['members']); }, 0) }}</span>
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
            @foreach ([
                ['action' => "New team registered", 'time' => "5 minutes ago"],
                ['action' => "Pitch deck submitted by Team Alpha", 'time' => "1 hour ago"],
                ['action' => "New mentor request received", 'time' => "2 hours ago"],
                ['action' => "Business model canvas submitted by Team Beta", 'time' => "3 hours ago"],
                ['action' => "New mentor assigned to Team Gamma", 'time' => "5 hours ago"],
            ] as $activity)
                <div class="flex justify-between items-center">
                    <span class="text-sm">{{ $activity['action'] }}</span>
                    <span class="text-xs text-muted-foreground">{{ $activity['time'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4">Document Submissions</h3>
        <div class="space-y-4">
            @foreach ($documents as $doc)
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium">{{ $doc['category'] }}</span>
                    <span class="text-2xl font-bold">{{ $doc['submissions'] }}/{{ $doc['totalTeams'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>