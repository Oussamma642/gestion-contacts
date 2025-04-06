@extends('dashboard-layouts.app')

@section('content')
<main class="p-3 sm:p-4 lg:p-6">
    <div class="container mx-auto">
        <!-- En-tête avec statistiques -->
        <div class="mt-7 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-4 sm:mb-6">
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-user-friends text-xl sm:text-2xl"></i>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm text-gray-500">Ami</p>
                        <p class="text-base sm:text-lg font-semibold">{{ $stats['ami'] }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-users text-xl sm:text-2xl"></i>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm text-gray-500">Famille</p>
                        <p class="text-base sm:text-lg font-semibold">{{ $stats['famille'] }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="fas fa-briefcase text-xl sm:text-2xl"></i>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm text-gray-500">Professionnels</p>
                        <p class="text-base sm:text-lg font-semibold">{{ $stats['professionnel'] }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-building text-xl sm:text-2xl"></i>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm text-gray-500">Collègues</p>
                        <p class="text-base sm:text-lg font-semibold">{{ $stats['collegue'] }}</p>
                    </div>
                </div>
            </div>
        </div> <!-- Liste des contacts -->
        <div class="bg-white rounded-lg shadow">

            <div class="p-4 sm:p-6 border-b border-gray-200">
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
                    <h2 class="text-lg sm:text-xl font-semibold text-gray-800">Vos contacts récents</h2>
                    <button onclick="openUsersModal()"
                        class="w-full sm:w-auto bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-share-alt mr-2"></i>Partager
                    </button>
                    <a href="{{ route('export.contacts') }}"
                        class="w-full sm:w-auto bg-green-800 text-white px-4 py-2 rounded-lg hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-file-excel mr-2"></i>Export to Excel
                    </a>

                    <button onclick="openAddModal()"
                        class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-plus mr-2"></i>Nouveau contact
                    </button>
                </div>
            </div>

            <form method="POST" action="{{ route('share.contacts') }}">
                @csrf
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
                                </th>
                                <th
                                    class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th
                                    class="hidden sm:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th
                                    class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Téléphone
                                </th>
                                <th
                                    class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Catégorie
                                </th>
                                <th
                                    class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($contacts as $contact)
                            <tr>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" name="contact_ids[]" value="{{ $contact->id }}">
                                </td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10">
                                            <div
                                                class="h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-user text-gray-500 text-sm sm:text-base"></i>
                                            </div>
                                        </div>
                                        <div class="ml-3 sm:ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $contact->name }}</div>
                                            <div class="sm:hidden text-xs text-gray-500">{{ $contact->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $contact->email }}</div>
                                </td>
                                <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $contact->phone }}</div>
                                </td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($contact->category == 'ami') bg-blue-100 text-blue-800
                                        @elseif($contact->category == 'famille') bg-green-100 text-green-800
                                        @elseif($contact->category == 'professionnel') bg-purple-100 text-purple-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ ucfirst($contact->category) }}
                                    </span>
                                </td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="openEditModal({{ $contact->id }})"
                                        class="text-blue-600 hover:text-blue-900 mr-3" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="{{ route('persons.RelatedPersons', $contact->id) }}"
                                        class="text-purple-600 hover:text-purple-900 mr-3" title="Personnes liées">
                                        <i class="fas fa-people-arrows"></i>
                                    </a>
                                    <button onclick="deleteContact({{ $contact->id }})"
                                        class="text-red-600 hover:text-red-900" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    Aucun contact trouvé
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div id="usersModal"
                        class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
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
                    </div>

                </div>
            </form>

        </div>
    </div>
</main>

<!-- Modal d'ajout/modification de contact -->
<div id="contactModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4" id="modalTitle">Nouveau contact</h3>
            <form id="contactForm" method="POST" action="{{ route('contacts.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Nom complet
                    </label>
                    <input type="text" name="name" id="name" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input type="email" name="email" id="email" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        Téléphone
                    </label>
                    <input type="tel" name="phone" id="phone" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                        Catégorie
                    </label>
                    <select name="category" id="category" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="ami">Ami</option>
                        <option value="famille">Famille</option>
                        <option value="professionnel">Professionnel</option>
                        <option value="collegue">Collègue</option>
                    </select>
                </div>
                <div class="mb-4 flex items-center space-x-2">
                    <button
                        class="flex items-center bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-plus mr-2"></i>
                        Related Contacts
                    </button>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('contactModal')"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Annuler
                    </button>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
function openUsersModal() {
    // Show the modal only if at least one contact is selected
    const selectedContacts = document.querySelectorAll('input[name="contact_ids[]"]:checked');
    if (selectedContacts.length === 0) {
        alert('Please select at least one contact to share.');
        return;
    }

    // Fetch the authenticated user's ID (you need to pass it from your backend to the frontend)
    const authUserId = document.getElementById('authUserId').value; // Example of how to pass it to your frontend

    // Show the modal
    document.getElementById('usersModal').classList.remove('hidden');

    // Fetch the users
    fetch('/users')
        .then(response => response.json())
        .then(users => {
            const userDropdown = document.getElementById('userDropdown');
            userDropdown.innerHTML = ''; // Clear any existing options

            // Populate the dropdown with user data, excluding the authenticated user
            users.forEach(user => {
                if (user.id !== parseInt(authUserId)) {
                    userDropdown.innerHTML += `
                        <option value="${user.id}">${user.name} (${user.email})</option>
                    `;
                }
            });
        })
        .catch(error => {
            console.error('Error fetching users:', error);
        });
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

function toggleSelectAllUsers(source) {
    const checkboxes = document.querySelectorAll('input[name="user_ids[]"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = source.checked;
    });
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

function toggleSelectAll(source) {
    const checkboxes = document.querySelectorAll('input[name="contact_ids[]"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = source.checked;
    });
}

// Add this function and event listeners
function setupCheckboxListeners() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const individualCheckboxes = document.querySelectorAll('input[name="contact_ids[]"]');

    // Add event listeners to each individual checkbox
    individualCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            // If any checkbox is unchecked, uncheck the "select all" checkbox
            if (!checkbox.checked) {
                selectAllCheckbox.checked = false;
            }
            // If all checkboxes are checked, check the "select all" checkbox
            else if (Array.from(individualCheckboxes).every(cb => cb.checked)) {
                selectAllCheckbox.checked = true;
            }
        });
    });
}

// Call this when the page loads
document.addEventListener('DOMContentLoaded', setupCheckboxListeners);

function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Nouveau contact';
    document.getElementById('contactForm').reset();
    document.getElementById('contactForm').action = "{{ route('contacts.store') }}";
    document.getElementById('contactModal').classList.remove('hidden');
}

function openEditModal(contactId) {
    document.getElementById('modalTitle').textContent = 'Modifier le contact';

    // Ajuster le formulaire pour la méthode PUT
    const form = document.getElementById('contactForm');
    form.action = `/contacts/${contactId}`;

    // Ajouter le method spoofing pour PUT
    let methodInput = document.querySelector('input[name="_method"]');
    if (!methodInput) {
        methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        form.appendChild(methodInput);
    }
    methodInput.value = 'PUT';

    // Charger les données du contact
    fetch(`/contacts/${contactId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('name').value = data.name;
            document.getElementById('email').value = data.email;
            document.getElementById('phone').value = data.phone;
            document.getElementById('category').value = data.category;
            document.getElementById('contactModal').classList.remove('hidden');
        });
}

function closeModal(modelType) {
    document.getElementById(modelType).classList.add('hidden');
}

function deleteContact(contactId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')) {
        // Créer un formulaire pour la soumission
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/contacts/${contactId}`;

        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';

        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';

        form.appendChild(csrfInput);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }
}

function showRelatedPersons(contactId) {
    // Cette fonction afficherait normalement une fenêtre modale ou redirigerait
    // vers une page montrant les personnes liées au contact
    alert(`Affichage des personnes liées au contact #${contactId}`);
    // Ici vous pourriez implémenter un appel fetch pour récupérer et afficher
    // les personnes liées à ce contact
}
</script>
@endsection