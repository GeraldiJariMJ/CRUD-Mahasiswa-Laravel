@vite(['resources/css/app.css','resources/js/app.js'])
<link rel="stylesheet" href="https://rsms.me/inter/inter.css">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

@include('layouts.app')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
       <div class="grid grid-cols-1 gap-4 mb-4">        
         <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <a href="{{ url('admin/daftar') }}" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ml-auto dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Back
            </a>      
            <div class="p-6 text-gray-900 dark:text-gray-100">      
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <form action="#" method="POST" enctype="multipart/form-data" class="max-w mx-auto">
                        {{ csrf_field() }}
                        <div>
                            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" placeholder="nama" name="name" id="small-input" value="{{ $getRecord->name }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Kelas</label>
                            <input type="number" placeholder="9999999" name="jumlah" id="small-input" value="{{ $getRecord->jumlah }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>