<div class="space-y-6">
    <div>
        <h3 class="text-lg font-semibold mb-2">Profile Information</h3>
        {{-- <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" value="{{auth()->user()->name}}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-0 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" value="{{auth()->user()->email}}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-0 px-3 py-2">
            </div>
        </div> --}}
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="max-w-md mx-auto">
            @csrf
            @method('PATCH')

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                @error('name')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                @error('email')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Profile Picture Upload -->
            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                <input type="file" name="photo" id="photo"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                @error('photo')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white font-semibold rounded-md shadow hover:bg-green-500">
                    Update Profile
                </button>
            </div>
        </form>

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
    <button class="w-full px-4 py-2 bg-green-500 text-white rounded-md">Save Changes</button>
</div>
