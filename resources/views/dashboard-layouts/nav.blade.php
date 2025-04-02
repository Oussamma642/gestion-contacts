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
                        <span class="hidden sm:inline-block mr-2">{{Auth::user()->name}}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>

                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>