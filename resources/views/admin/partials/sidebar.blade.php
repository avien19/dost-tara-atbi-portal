<aside class="w-64 bg-white shadow-lg">
    <div class="p-4">
        <h2 class="text-2xl font-bold text-primary">TARA-ATBI</h2>
        <p class="text-sm text-muted-foreground">Admin Dashboard</p>
    </div>
    <div class="p-4">
        <div class="bg-white shadow rounded-lg p-4 flex flex-col items-center">
            <div class="w-20 h-20 rounded-full bg-gray-200 mb-4"></div>
            <h3 class="font-semibold text-lg">Admin User</h3>
            <p class="text-sm text-muted-foreground">System Administrator</p>
        </div>
    </div>
    <div class="flex-grow">
        <nav class="mt-6 px-4">
            @foreach ($menuItems as $item)
                <button
                    @click="activeTab = '{{ $item['tab'] }}'"
                    class="flex items-center w-full px-4 py-3 mb-2 transition-colors rounded-lg"
                    :class="activeTab === '{{ $item['tab'] }}' ? 'bg-primary text-primary-foreground' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-800'"
                >
                    <i data-lucide="{{ $item['icon'] }}" class="h-5 w-5 mr-3"></i>
                    <span>{{ $item['name'] }}</span>
                </button>
            @endforeach
        </nav>
    </div>
    <div class="p-4">
        <hr class="my-4">
        <button class="flex items-center w-full px-4 py-2 text-left text-gray-600 hover:bg-gray-100 hover:text-gray-800 rounded-lg">
            <i data-lucide="log-out" class="h-5 w-5 mr-3"></i>
            <span>Log out</span>
        </button>
    </div>
</aside>