<div class="bg-white shadow rounded-lg p-6">
    <h3 class="text-lg font-semibold mb-4">System Settings</h3>
    <p class="text-sm text-gray-600 mb-4">Configure global settings for the TARA-ATBI platform</p>
    <div class="space-y-6">
        <div>
            <h4 class="text-md font-semibold mb-2">General Settings</h4>
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <span>Platform Name</span>
                    <input type="text" value="TARA-ATBI" class="px-3 py-2 border rounded-md w-64">
                </div>
                <div class="flex justify-between items-center">
                    <span>Contact Email</span>
                    <input type="email" value="admin@tara-atbi.com" class="px-3 py-2 border rounded-md w-64">
                </div>
            </div>
        </div>
        <hr>
        <div>
            <h4 class="text-md font-semibold mb-2">Team Settings</h4>
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <span>Maximum Team Size</span>
                    <input type="number" value="5" class="px-3 py-2 border rounded-md w-64">
                </div>
                <div class="flex justify-between items-center">
                    <span>Allow Team Self-Formation</span>
                    <select class="px-3 py-2 border rounded-md w-64">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div>
            <h4 class="text-md font-semibold mb-2">Document Submission Settings</h4>
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <span>Default Submission Deadline (days)</span>
                    <input type="number" value="7" class="px-3 py-2 border rounded-md w-64">
                </div>
                <div class="flex justify-between items-center">
                    <span>Allow Late Submissions</span>
                    <select class="px-3 py-2 border rounded-md w-64">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-6">
        <button class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-300">Save All Settings</button>
    </div>
</div>