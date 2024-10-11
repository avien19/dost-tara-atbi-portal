<div x-data="{ 
    showFilterDropdown: false,
    filterOption: 'all',
    courses: [
        { name: 'Web Development Fundamentals', status: 'In Progress' },
        { name: 'Advanced JavaScript', status: 'Completed' },
        { name: 'React and Redux', status: 'Not Started' },
        { name: 'Node.js and Express', status: 'In Progress' },
        { name: 'Database Design', status: 'Completed' },
        { name: 'UI/UX Principles', status: 'Not Started' }
    ]
}" class="bg-white shadow rounded p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">My Courses</h2>
        <div class="relative">
            <button @click="showFilterDropdown = !showFilterDropdown" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm flex items-center">
                <i data-lucide="filter" class="h-4 w-4 mr-2"></i>Filter Courses
            </button>
            <div x-show="showFilterDropdown" @click.away="showFilterDropdown = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                <div class="py-1">
                    <a href="#" @click.prevent="filterOption = 'all'" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">All Courses</a>
                    <a href="#" @click.prevent="filterOption = 'In Progress'" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">In Progress</a>
                    <a href="#" @click.prevent="filterOption = 'Completed'" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Completed</a>
                    <a href="#" @click.prevent="filterOption = 'Not Started'" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Not Started</a>
                    <a href="#" @click.prevent="filterOption = 'name'" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">By Name</a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <template x-for="(course, index) in courses.filter(c => filterOption === 'all' || filterOption === c.status || (filterOption === 'name' && true)).sort((a, b) => filterOption === 'name' ? a.name.localeCompare(b.name) : 0)" :key="index">
            <div class="bg-white shadow rounded p-4">
                <h3 class="text-lg font-semibold mb-4" x-text="course.name"></h3>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium">Project Status</span>
                        <span class="px-2 py-1 text-xs font-semibold rounded" 
                              :class="{
                                  'bg-green-100 text-green-800': course.status === 'Completed',
                                  'bg-yellow-100 text-yellow-800': course.status === 'In Progress',
                                  'bg-red-100 text-red-800': course.status === 'Not Started'
                              }"
                              x-text="course.status"></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium">Quiz Status</span>
                        <span class="px-2 py-1 text-xs font-semibold rounded" 
                              :class="{
                                  'bg-green-100 text-green-800': course.status === 'Completed',
                                  'bg-yellow-100 text-yellow-800': course.status === 'In Progress',
                                  'bg-red-100 text-red-800': course.status === 'Not Started'
                              }"
                              x-text="course.status"></span>
                    </div>
                </div>
                <button class="mt-4 w-full px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm">Go to Course</button>
            </div>
        </template>
    </div>
</div>
