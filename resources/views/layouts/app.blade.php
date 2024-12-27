{{-- @vite(['resources/css/app.css','resources/js/app.js'])
<link rel="stylesheet" href="https://rsms.me/inter/inter.css">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

@include('layouts.header')
@include('layouts.sidebar') --}}

<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <title>TUGAS CRUD</title>
</head>
<body>

    <!-- Header -->
    @include('layouts.header')

    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-6 mt-16 ml-64 overflow-auto">
            <!-- Alert Popup -->
            @if ($errors->has('error'))
                <div 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-transition:enter="transition ease-out duration-300" 
                    x-transition:enter-start="opacity-0 translate-y-4" 
                    x-transition:enter-end="opacity-100 translate-y-0" 
                    x-transition:leave="transition ease-in duration-300" 
                    x-transition:leave-start="opacity-100 translate-y-0" 
                    x-transition:leave-end="opacity-0 translate-y-4" 
                    class="fixed top-5 right-5 max-w-sm p-4 bg-red-500 text-white rounded-lg shadow-lg z-50"
                >
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-1.414-1.414L12 9.172l-4.95-4.95-1.414 1.414L9.172 12l-4.95 4.95 1.414 1.414L12 14.828l4.95 4.95 1.414-1.414L14.828 12l4.95-4.95z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">
                                {{ $errors->first('error') }}
                            </p>
                        </div>
                        <button 
                            @click="show = false" 
                            class="ml-auto -mx-1.5 -my-1.5 bg-transparent hover:bg-red-600 rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-500 focus:ring-white"
                        >
                            <span class="sr-only">Close</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-transition:enter="transition ease-out duration-300" 
                    x-transition:enter-start="opacity-0 translate-y-4" 
                    x-transition:enter-end="opacity-100 translate-y-0" 
                    x-transition:leave="transition ease-in duration-300" 
                    x-transition:leave-start="opacity-100 translate-y-0" 
                    x-transition:leave-end="opacity-0 translate-y-4" 
                    class="fixed top-5 right-5 max-w-sm p-4 bg-red-500 text-white rounded-lg shadow-lg z-50"
                >
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-1.414-1.414L12 9.172l-4.95-4.95-1.414 1.414L9.172 12l-4.95 4.95 1.414 1.414L12 14.828l4.95 4.95 1.414-1.414L14.828 12l4.95-4.95z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">
                                {{ session('error') }}
                            </p>
                        </div>
                        <button 
                            @click="show = false" 
                            class="ml-auto -mx-1.5 -my-1.5 bg-transparent hover:bg-red-600 rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-500 focus:ring-white"
                        >
                            <span class="sr-only">Close</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-transition:enter="transition ease-out duration-300" 
                    x-transition:enter-start="opacity-0 translate-y-4" 
                    x-transition:enter-end="opacity-100 translate-y-0" 
                    x-transition:leave="transition ease-in duration-300" 
                    x-transition:leave-start="opacity-100 translate-y-0" 
                    x-transition:leave-end="opacity-0 translate-y-4" 
                    class="fixed top-5 right-5 max-w-sm p-4 bg-green-500 text-white rounded-lg shadow-lg z-50"
                >
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-1.414-1.414L12 9.172l-4.95-4.95-1.414 1.414L9.172 12l-4.95 4.95 1.414 1.414L12 14.828l4.95 4.95 1.414-1.414L14.828 12l4.95-4.95z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">
                                {{ session('success') }}
                            </p>
                        </div>
                        <button 
                            @click="show = false" 
                            class="ml-auto -mx-1.5 -my-1.5 bg-transparent hover:bg-red-600 rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-500 focus:ring-white"
                        >
                            <span class="sr-only">Close</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
            <!-- Dynamic Content -->
            @yield('content')
        </div>
    </div>

</body>
</html>
