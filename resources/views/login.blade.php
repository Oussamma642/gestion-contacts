@extends('home-layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-4 sm:p-8 rounded-lg shadow-xl">
        <div>
            <h2 class="mt-6 text-center text-2xl sm:text-3xl font-extrabold text-gray-900">
                Connexion à votre compte
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Ou
                <a href="{{'/register'}}" class="font-medium text-blue-600 hover:text-blue-500">
                    créez un nouveau compte
                </a>
            </p>
        </div>
        <form class="mt-8 space-y-6" action="#" method="POST">
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email" class="sr-only">Adresse email</label>
                    <input id="email" name="email" type="email" required
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                        placeholder="Adresse email">
                </div>
                <div>
                    <label for="password" class="sr-only">Mot de passe</label>
                    <input id="password" name="password" type="password" required
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                        placeholder="Mot de passe">
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                        Se souvenir de moi
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                        Mot de passe oublié ?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-sign-in-alt"></i>
                    </span>
                    Se connecter
                </button>
            </div>
        </form>

        <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">
                        Ou connectez-vous avec
                    </span>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <a href="#"
                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <i class="fab fa-google text-red-600"></i>
                        <span class="ml-2">Google</span>
                    </a>
                </div>
                <div>
                    <a href="#"
                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <i class="fab fa-facebook text-blue-600"></i>
                        <span class="ml-2">Facebook</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection