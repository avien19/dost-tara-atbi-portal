<header class="bg-white shadow-sm z-10">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-gray-900" x-text="activeTab.charAt(0).toUpperCase() + activeTab.slice(1)"></h1>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="search" placeholder="Search..." class="pl-8 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <i data-lucide="search" class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-500"></i>
            </div>
            <button class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i data-lucide="bell" class="h-6 w-6"></i>
            </button>
        </div>
    </div>
</header>