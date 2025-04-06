@extends('dashboard-layouts.app')

@section('content')
<main class="p-3 sm:p-4 lg:p-6">

    @if(session('error') || $errors->any())
    @include('modals.errors')
    @endif


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
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
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
                                <button type="button" onclick="openEditModal({{ $contact->id }})"
                                    class="text-blue-600 hover:text-blue-900 mr-3" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="{{ route('persons.RelatedPersons', $contact->id) }}"
                                    class="text-purple-600 hover:text-purple-900 mr-3" title="Personnes liées">
                                    <i class="fas fa-people-arrows"></i>
                                </a>
                                <button type="button" onclick="deleteContact({{ $contact->id }})"
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
                    @include('modals.usersModal')
                </div>

            </div>
        </form>

    </div>
    </div>
</main>

<!-- Modal d'ajout/modification de contact -->
<div id="contactModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    @include('modals.contactModals')
</div>

<!-- Modal for the shared contacts -->
<div id="sharedContactsModal"
    class="fixed inset-0 bg-gray-600  bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    @include('modals.sharedContacts')
</div>

<div class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50"
    id="acceptSharedContactModal">
    @include('modals.acceptSharedContact')
</div>

@endsection