@extends('home-layouts.app')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Bienvenue sur ContactPro</h1>
        <p class="text-gray-600 mb-4">
            Gérez vos contacts professionnels de manière simple et efficace.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-blue-50 p-6 rounded-lg">
                <i class="fas fa-users text-3xl text-blue-600 mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-900">Gestion des Contacts</h3>
                <p class="text-gray-600">Organisez et gérez tous vos contacts en un seul endroit.</p>
            </div>
            <div class="bg-green-50 p-6 rounded-lg">
                <i class="fas fa-search text-3xl text-green-600 mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-900">Recherche Rapide</h3>
                <p class="text-gray-600">Trouvez rapidement les informations dont vous avez besoin.</p>
            </div>
            <div class="bg-purple-50 p-6 rounded-lg">
                <i class="fas fa-shield-alt text-3xl text-purple-600 mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-900">Sécurité</h3>
                <p class="text-gray-600">Vos données sont protégées et sécurisées.</p>
            </div>
        </div>
    </div>
</div>
@endsection