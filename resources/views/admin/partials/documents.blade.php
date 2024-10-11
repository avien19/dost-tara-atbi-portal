<div x-show="activeTab === 'documents'" class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($documents as $doc)
            <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-lg font-semibold mb-4">{{ $doc['category'] }}</h3>
                <div class="text-4xl font-bold text-center mb-4">
                    {{ $doc['submissions'] }}/{{ $doc['totalTeams'] }}
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ($doc['submissions'] / $doc['totalTeams']) * 100 }}%"></div>
                </div>
                <button class="mt-4 w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300">View Submissions</button>
            </div>
        @endforeach
    </div>
    <div class="mt-6">
        <button class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-300">
            <i data-lucide="folder" class="inline-block w-4 h-4 mr-2"></i>
            Add File Category
        </button>
    </div>
</div>