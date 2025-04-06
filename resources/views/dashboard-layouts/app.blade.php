<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - ContactPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }

    .animate-fadeOut {
        animation: fadeOut 0.5s ease-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }

        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }
    </style>

    <script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }
    </script>

</head>

<body class="bg-gray-100">
    @include('dashboard-layouts.nav')

    <div class="flex min-h-screen bg-gray-100 pt-14 sm:pt-16">
        @include('dashboard-layouts.menu')

        <div class="flex-1 lg:pl-64">
            @yield('content')
        </div>
    </div>

    @include('dashboard-layouts.scripts')
</body>

</html>