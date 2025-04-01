@extends('dashboard-layouts.app')

@section('content')
<main class="p-3 sm:p-4 lg:p-6">
    <div class="container mx-auto">
        <!-- En-tête avec statistiques -->
        @include('dashboard-layouts.statistiques')
        <!-- Liste des contacts -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-4 sm:p-6 border-b border-gray-200">
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
                    <h2 class="text-lg sm:text-xl font-semibold text-gray-800">Vos contacts récents</h2>
                    <button
                        class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-plus mr-2"></i>Nouveau contact
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom</th>
                            <th
                                class="hidden sm:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email</th>
                            <th
                                class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Téléphone</th>
                            <th
                                class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Catégorie</th>
                            <th
                                class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10">
                                        <div
                                            class="h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-500 text-sm sm:text-base"></i>
                                        </div>
                                    </div>
                                    <div class="ml-3 sm:ml-4">
                                        <div class="text-sm font-medium text-gray-900">John Doe</div>
                                        <div class="sm:hidden text-xs text-gray-500">john@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">john@example.com</div>
                            </td>
                            <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">+33 6 12 34 56 78</div>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Ami
                                </span>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10">
                                        <div
                                            class="h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-500 text-sm sm:text-base"></i>
                                        </div>
                                    </div>
                                    <div class="ml-3 sm:ml-4">
                                        <div class="text-sm font-medium text-gray-900">Marie Dupont</div>
                                        <div class="sm:hidden text-xs text-gray-500">marie@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">marie@example.com</div>
                            </td>
                            <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">+33 6 98 76 54 32</div>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Famille
                                </span>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10">
                                        <div
                                            class="h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-500 text-sm sm:text-base"></i>
                                        </div>
                                    </div>
                                    <div class="ml-3 sm:ml-4">
                                        <div class="text-sm font-medium text-gray-900">Pierre Martin</div>
                                        <div class="sm:hidden text-xs text-gray-500">pierre@example.com
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">pierre@example.com</div>
                            </td>
                            <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">+33 6 44 55 66 77</div>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                    Professionnel
                                </span>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection