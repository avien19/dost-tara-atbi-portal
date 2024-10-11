<div x-show="activeTab === 'mentorRequests'" class="bg-white shadow rounded-lg p-6">
    <h3 class="text-lg font-semibold mb-4">Mentor Requests</h3>
    <p class="text-sm text-gray-600 mb-4">Review and approve mentor requests from students</p>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Team</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requested Mentor</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <template x-for="request in mentorRequests" :key="request.id">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap" x-text="request.student"></td>
                    <td class="px-6 py-4 whitespace-nowrap" x-text="request.team"></td>
                    <td class="px-6 py-4 whitespace-nowrap" x-text="request.requestedMentor"></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                              :class="request.status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800'"
                              x-text="request.status"></span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button @click="handleMentorRequestApproval(request.id)" 
                                class="text-indigo-600 hover:text-indigo-900 mr-2">Approve</button>
                        <button class="text-red-600 hover:text-red-900">Reject</button>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
</div>