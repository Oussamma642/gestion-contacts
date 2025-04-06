<div id="usersModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4" id="modalTitle">Envoyer</h3>
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

<script>
function openUsersModal() {
    document.getElementById('usersModal').classList.remove('hidden');
}
</script>