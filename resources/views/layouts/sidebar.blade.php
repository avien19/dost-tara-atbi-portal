<aside class="w-64 bg-white shadow-lg h-screen">
    <div class="p-4">
        <h2 class="text-2xl font-bold text-blue-600">TARA-ATBI</h2>
    </div>
    <div class="p-4">
        <div class="bg-gray-100 rounded-lg p-4 text-center">
            <img src="https://via.placeholder.com/80" alt="Paul Elizalde" class="w-20 h-20 rounded-full mx-auto mb-2">
            <h3 class="font-semibold text-lg">Paul Elizalde</h3>
            <p class="text-sm text-gray-600">Computer Science</p>
        </div>
    </div>
    <nav class="mt-6">
        @php
        $menuItems = [
            ['name' => 'Dashboard', 'icon' => 'book', 'tab' => 'dashboard'],
            ['name' => 'Mentors', 'icon' => 'users', 'tab' => 'mentors'],
            ['name' => 'Appointments', 'icon' => 'calendar', 'tab' => 'appointments'],
            ['name' => 'Feedback', 'icon' => 'star', 'tab' => 'feedback'],
            ['name' => 'Classroom', 'icon' => 'book', 'tab' => 'classroom'],
            ['name' => 'Documents', 'icon' => 'file-text', 'tab' => 'documents'],
            ['name' => 'Community', 'icon' => 'message-square', 'tab' => 'community'],
            ['name' => 'Team Chart', 'icon' => 'git-branch', 'tab' => 'teamchart'],
            ['name' => 'Settings', 'icon' => 'settings', 'tab' => 'settings'],
        ];
        @endphp

        @foreach($menuItems as $item)
            <button
                @click="$dispatch('tab-changed', '{{ $item['tab'] }}')"
                class="flex items-center w-full px-6 py-3 text-left"
                :class="{'bg-blue-500 text-white': activeTab === '{{ $item['tab'] }}', 'text-gray-600 hover:bg-gray-100': activeTab !== '{{ $item['tab'] }}'}"
            >
                <i data-lucide="{{ $item['icon'] }}" class="h-5 w-5 mr-3"></i>
                <span>{{ $item['name'] }}</span>
            </button>
        @endforeach
    </nav>
</aside>