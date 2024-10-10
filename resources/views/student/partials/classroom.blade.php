<div class="space-y-6">
    @foreach(['Web Development Fundamentals', 'Advanced JavaScript', 'React and Redux', 'Node.js and Express'] as $index => $course)
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold mb-4">{{ $course }}</h3>
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium">Project {{ $index + 1 }}</span>
                    <span class="px-2 py-1 text-xs font-semibold rounded {{ $index % 2 == 0 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $index % 2 == 0 ? 'Submitted' : 'In Progress' }}
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium">Quiz {{ $index + 1 }}</span>
                    <span class="px-2 py-1 text-xs font-semibold rounded {{ $index % 3 == 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $index % 3 == 0 ? 'Completed' : 'Not Started' }}
                    </span>
                </div>
            </div>
            <button class="mt-4 w-full px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Go to Course</button>
        </div>
    @endforeach
</div>
