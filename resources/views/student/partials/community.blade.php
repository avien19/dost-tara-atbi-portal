<div class="space-y-6">
    <div>
        <textarea placeholder="Start a new discussion or ask a question..." class="w-full p-2 border rounded-md"></textarea>
        <div class="flex justify-between items-center mt-2">
            <div class="space-x-2">
                <button class="px-3 py-1 text-sm bg-gray-200 rounded-md">Add Topic</button>
                <button class="px-3 py-1 text-sm bg-gray-200 rounded-md">Attach File</button>
            </div>
            <button class="px-4 py-2 bg-blue-500 text-white rounded-md">Post</button>
        </div>
    </div>
    <hr>
    <div class="space-y-4">
        @foreach(range(1, 5) as $index)
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center space-x-2 mb-2">
                    <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
                    <div>
                        <p class="font-semibold">User {{ $index }}</p>
                        <p class="text-sm text-gray-500">2 hours ago</p>
                    </div>
                </div>
                <h3 class="text-lg font-semibold mb-2">Discussion Topic {{ $index }}</h3>
                <p class="mb-4">This is a sample forum post. It can be about anything related to the course or general discussions about programming and computer science.</p>
                <div class="flex items-center space-x-4">
                    <button class="text-sm text-blue-500">Reply</button>
                    <button class="text-sm text-blue-500">Like</button>
                    <span class="text-sm text-gray-500">5 replies • 12 likes</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
