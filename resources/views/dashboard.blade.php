<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - ContactPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }
    </script>
</head>

<body class="bg-gray-100">
    <!-- Barre de navigation supérieure -->
    <nav class="bg-white shadow-lg fixed w-full z-40">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6">
            <div class="flex justify-between items-center h-14 sm:h-16">
                <!-- Bouton menu mobile -->
                <div class="flex lg:hidden">
                    <button type="button" onclick="toggleSidebar()"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <span class="sr-only">Ouvrir le menu</span>
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>

                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-address-book text-2xl sm:text-3xl text-blue-600"></i>
                    </div>
                    <span class="ml-2 text-lg sm:text-xl font-bold text-gray-800">ContactPro</span>
                </div>

                <!-- Menu utilisateur -->
                <div class="flex items-center">
                    <div class="relative">
                        <button type="button"
                            class="flex items-center text-gray-700 hover:text-gray-900 focus:outline-none">
                            <span class="hidden sm:inline-block mr-2">Nom d'utilisateur</span>
                            <button class="text-sm text-gray-600 hover:text-gray-900">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex min-h-screen bg-gray-100 pt-14 sm:pt-16">
        <!-- Menu latéral -->
        <div id="sidebar"
            class="fixed inset-y-0 left-0 pt-14 sm:pt-16 z-30 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out lg:translate-x-0 -translate-x-full">
            <div class="flex flex-col h-full">
                <div class="flex-1 px-2 sm:px-3 py-4 space-y-1">
                    <a href="#"
                        class="flex items-center px-3 sm:px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg bg-blue-50 text-blue-600">
                        <i class="fas fa-home w-5 sm:w-6"></i>
                        <span class="text-sm sm:text-base">Tableau de bord</span>
                    </a>
                    <a href="#" class="flex items-center px-3 sm:px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg">
                        <i class="fas fa-user-friends w-5 sm:w-6"></i>
                        <span class="text-sm sm:text-base">Amis</span>
                    </a>
                    <a href="#" class="flex items-center px-3 sm:px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg">
                        <i class="fas fa-users w-5 sm:w-6"></i>
                        <span class="text-sm sm:text-base">Famille</span>
                    </a>
                    <a href="#" class="flex items-center px-3 sm:px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg">
                        <i class="fas fa-briefcase w-5 sm:w-6"></i>
                        <span class="text-sm sm:text-base">Professionnels</span>
                    </a>
                    <a href="#" class="flex items-center px-3 sm:px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg">
                        <i class="fas fa-building w-5 sm:w-6"></i>
                        <span class="text-sm sm:text-base">Collègues</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="flex-1 lg:pl-64">
            <main class="p-3 sm:p-4 lg:p-6">
                <div class="container mx-auto">
                    <!-- En-tête avec statistiques -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-4 sm:mb-6">
                        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                            <div class="flex items-center">
                                <div class="p-2 sm:p-3 rounded-full bg-blue-100 text-blue-600">
                                    <i class="fas fa-user-friends text-xl sm:text-2xl"></i>
                                </div>
                                <div class="ml-3 sm:ml-4">
                                    <p class="text-xs sm:text-sm text-gray-500">Amis</p>
                                    <p class="text-base sm:text-lg font-semibold">0</p>
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
                                    <p class="text-base sm:text-lg font-semibold">0</p>
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
                                    <p class="text-base sm:text-lg font-semibold">0</p>
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
                                    <p class="text-base sm:text-lg font-semibold">0</p>
                                </div>
                            </div>
                        </div>
                    </div>

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
        </div>
    </div>
</body>

</html>