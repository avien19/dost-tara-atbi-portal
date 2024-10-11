<div x-show="activeTab === 'messages'" class="bg-white shadow rounded-lg p-6">
    <h3 class="text-lg font-semibold mb-4">Message Center</h3>
    <p class="text-sm text-gray-600 mb-4">Manage communications with students and mentors</p>
    <div class="flex justify-between items-center mb-4">
        <input type="text" placeholder="Search messages..." class="px-4 py-2 border rounded-md w-64">
        <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300">
            <i data-lucide="message-square" class="inline-block w-4 h-4 mr-2"></i>
            Compose Message
        </button>
    </div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">From</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($messages as $message)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $message['from'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $message['subject'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $message['date'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $message['status'] === 'Unread' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                            {{ $message['status'] }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-indigo-600 hover:text-indigo-900">View</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>