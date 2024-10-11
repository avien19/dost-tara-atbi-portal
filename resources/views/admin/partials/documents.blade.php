<div x-show="activeTab === 'documents'" class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <template x-for="doc in documents" :key="doc.category">
            <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-lg font-semibold mb-4" x-text="doc.category"></h3>
                <div class="text-4xl font-bold text-center mb-4" x-text="`${doc.submissions}/${doc.totalTeams}`"></div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" :style="`width: ${(doc.submissions / doc.totalTeams) * 100}%`"></div>
                </div>
                <button class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition-colors duration-300">View Submissions</button>
            </div>
        </template>
    </div>
    <div class="mt-6">
        <button @click="$refs.addCategoryDialog.showModal()" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition-colors duration-300">
            <i data-lucide="folder-plus" class="inline-block w-4 h-4 mr-2"></i>
            Add File Category
        </button>
    </div>
    <dialog x-ref="addCategoryDialog" class="p-0 rounded-lg shadow-xl">
        <div class="bg-white p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4">Add New File Category</h3>
            <p class="text-sm text-gray-600 mb-4">Enter the name for the new file category.</p>
            <div class="mb-4">
                <label for="category-name" class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                <input type="text" id="category-name" class="w-full px-3 py-2 border rounded-md">
            </div>
            <div class="flex justify-end space-x-2">
                <button @click="$refs.addCategoryDialog.close()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors duration-300">Cancel</button>
                <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-300">Add Category</button>
            </div>
        </div>
    </dialog>
</div>