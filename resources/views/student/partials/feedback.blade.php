<div class="space-y-4">
    @foreach(['React Project', 'JavaScript Quiz', 'Node.js API', 'Database Design'] as $index => $assignment)
        <div class="bg-white shadow rounded-lg p-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">{{ $assignment }}</h3>
                <div class="flex items-center space-x-2">
                    <span class="font-bold">{{ 90 - $index * 5 }}%</span>
                    <i data-lucide="star" class="h-5 w-5 text-yellow-400"></i>
                </div>
            </div>
            <p class="text-sm text-gray-600 mt-2">Great work on this assignment! Your understanding of the core concepts is evident. Consider exploring more advanced topics in future projects.</p>
            <button class="mt-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">View Detailed Feedback</button>
        </div>
    @endforeach
</div>
