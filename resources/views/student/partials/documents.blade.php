<div class="space-y-6">
    @foreach(['Resume', 'Cover Letter', 'Transcript', 'Project Portfolio', 'Certifications'] as $index => $document)
        <div class="bg-white shadow rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i data-lucide="file-text" class="h-5 w-5 mr-2 text-green-500"></i>
                    <h3 class="text-lg font-semibold">{{ $document }}</h3>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="px-2 py-1 text-xs font-semibold rounded 
                        {{ $index % 3 == 0 ? 'bg-green-100 text-green-800' : 
                           ($index % 3 == 1 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                        {{ $index % 3 == 0 ? 'Approved' : 
                           ($index % 3 == 1 ? 'Pending Review' : 'Needs Update') }}
                    </span>
                    <button class="px-2 py-1 text-sm font-medium text-green-600 hover:text-green-800">Actions</button>
                </div>
            </div>
            <p class="text-sm text-gray-600 mt-2">{{ strtolower(str_replace(' ', '_', $document)) }}.pdf</p>
            <p class="text-xs text-gray-400">Last updated: 2 days ago</p>
        </div>
    @endforeach
    <button class="w-full px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
        <i data-lucide="upload" class="h-4 w-4 inline-block mr-2"></i>
        Upload New Document
    </button>
</div>
