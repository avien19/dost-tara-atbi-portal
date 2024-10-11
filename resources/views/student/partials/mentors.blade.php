<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Find a Mentor</h2>
    <p class="mb-6">Search for mentors or view recommendations based on your interests</p>

    <div class="flex mb-6">
        <input type="text" placeholder="Search mentors by name, skill, or expertise..." class="flex-grow px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-0">
        <button class="bg-green-500 text-white px-4 py-2 rounded-r-md">
            <i data-lucide="search" class="h-4 w-4"></i>
        </button>
    </div>

    <h3 class="text-xl font-semibold mb-4">Recommended Mentors</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach(['John Doe', 'Jane Smith', 'Alex Johnson', 'Emily Brown', 'Michael Lee', 'Sarah Wilson'] as $mentor)
            <div class="bg-white shadow rounded-lg p-4">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4">
                        {{ substr($mentor, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-semibold">{{ $mentor }}</h4>
                        <p class="text-sm text-gray-600">Expert in React, Node.js</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-4">5 years of industry experience. Passionate about teaching and mentoring junior developers.</p>
                <div class="flex justify-between">
                    <button class="px-4 py-2 border border-green-500 text-green-500 rounded hover:bg-green-100">View Profile</button>
                    <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Request Session</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
