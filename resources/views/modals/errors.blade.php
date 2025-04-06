<div id="error-notification"
    class="fixed top-4 right-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-lg z-50 max-w-md animate-fadeIn"
    role="alert" aria-live="assertive">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-red-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <strong class="font-medium">Please fix the following issues:</strong>
        </div>
        <button onclick="document.getElementById('error-notification').remove()"
            class="text-red-500 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 rounded-full"
            aria-label="Close">
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <ul class="mt-2 text-sm space-y-1">
        @if(session('error'))
        <li class="flex items-start">
            <span class="mr-1">•</span>
            <span>{{ session('error') }}</span>
        </li>
        @endif

        @foreach($errors->all() as $error)
        <li class="flex items-start">
            <span class="mr-1">•</span>
            <span>{{ $error }}</span>
        </li>
        @endforeach
    </ul>
</div>