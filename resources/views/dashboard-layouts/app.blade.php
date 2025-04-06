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

    @include('dashboard-layouts.nav')

    <div class="flex min-h-screen bg-gray-100 pt-14 sm:pt-16">
        <!-- Menu latéral -->
        @include('dashboard-layouts.menu')

        <!-- Contenu principal -->
        <div class="flex-1 lg:pl-64">
            @yield('content')
        </div>
    </div>

    <!-- <script src="{{ asset('js/dashboard.js') }}"></script> -->
</body>

</html>