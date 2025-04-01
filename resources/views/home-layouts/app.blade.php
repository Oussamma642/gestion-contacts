<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Contacts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
    function toggleMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }
    </script>
</head>

<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{'/'}}"><i class="fas fa-address-book text-3xl text-blue-600"></i></a>
                    </div>
                    <a href="{{'/'}}" class="ml-2 text-xl font-bold text-gray-800">ContactPro</a>
                </div>

                <!-- Menu de navigation Desktop -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{'/'}}"
                            class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Accueil</a>
                        <a href="#"
                            class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Contacts</a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">À
                            propos</a>
                        <a href="{{'/login'}}"
                            class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Contactez-nous</a>
                    </div>
                </div>

                <!-- Bouton de connexion Desktop -->
                <div class="hidden md:block">
                    <a href="{{'/login'}}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">
                        Connexion
                    </a>
                </div>

                <!-- Bouton menu mobile -->
                <div class="md:hidden">
                    <button type="button" onclick="toggleMenu()"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <span class="sr-only">Ouvrir le menu</span>
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu mobile -->
        <div id="mobile-menu" class="hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#"
                    class="text-gray-600 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Accueil</a>
                <a href="#"
                    class="text-gray-600 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Contacts</a>
                <a href="#" class="text-gray-600 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">À
                    propos</a>
                <a href="#"
                    class="text-gray-600 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Contactez-nous</a>
                <a href="#"
                    class="bg-blue-600 text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700">
                    Connexion
                </a>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <!-- Pied de page -->
    <footer class="bg-white shadow-lg mt-8">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 text-sm">
                © 2024 ContactPro. Tous droits réservés.
            </p>
        </div>
    </footer>
</body>

</html>