<div class="space-y-6">
    <div>
        <h3 class="text-lg font-semibold mb-2">Profile Information</h3>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" value="{{auth()->user()->name}}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" value="{{auth()->user()->email}}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>
    </div>
    <hr>
    <div>
        <h3 class="text-lg font-semibold mb-2">Notification Preferences</h3>
        <div class="space-y-2">
            <div class="flex items-center justify-between">
                <span>Email Notifications</span>
                <button class="px-3 py-1 text-sm bg-gray-200 rounded-md">Manage</button>
            </div>
            <div class="flex items-center justify-between">
                <span>SMS Notifications</span>
                <button class="px-3 py-1 text-sm bg-gray-200 rounded-md">Manage</button>
            </div>
        </div>
    </div>
    <hr>
    <div>
        <h3 class="text-lg font-semibold mb-2">Privacy Settings</h3>
        <div class="space-y-2">
            <div class="flex items-center justify-between">
                <span>Profile Visibility</span>
                <button class="px-3 py-1 text-sm bg-gray-200 rounded-md">Adjust</button>
            </div>
            <div class="flex items-center justify-between">
                <span>Data Sharing Preferences</span>
                <button class="px-3 py-1 text-sm bg-gray-200 rounded-md">Manage</button>
            </div>
        </div>
    </div>
    <button class="w-full px-4 py-2 bg-blue-500 text-white rounded-md">Save Changes</button>
</div>
