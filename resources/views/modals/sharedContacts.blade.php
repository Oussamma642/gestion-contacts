    <div class="relative top-20 mx-auto p-5 border w-[600px] h-[500px] shadow-lg rounded-md bg-white">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Shared Contacts</h3>
        <div class="overflow-y-auto h-[380px]">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact
                        </th>
                        <th
                            class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sender
                        </th>
                        <th
                            class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody id="sharedContactsTable" class="bg-white divide-y divide-gray-200">
                    <!-- Shared Contacts will be dynamically inserted here -->
                </tbody>

            </table>
        </div>



        <div class="flex justify-end mt-1">
            <button type="button" onclick="closeModal('sharedContactsModal')"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Close
            </button>
        </div>

    </div>