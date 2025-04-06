<div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
    <div class="mt-3">

        <h3 class="text-lg font-medium text-gray-900 mb-4" id="modalTitle">Select Users</h3>

        <!-- Auth user -->
        <input type="hidden" id="authUserId" value="{{ auth()->id() }}">

        <!-- Users Dropdown -->
        <label for="receiver_id" class="block text-sm font-medium text-gray-700">Users</label>
        <select name="receiver_id" id="userDropdown"
            class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <!-- Users will be dynamically inserted here -->
        </select>
        <!-- Modal Actions -->
        <div class="flex justify-end mt-4">
            <button type="button" onclick="closeModal('usersModal')"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Annuler
            </button>
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Envoyer
            </button>
        </div>
    </div>
</div>