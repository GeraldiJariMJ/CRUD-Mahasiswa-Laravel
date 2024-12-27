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
            <a href="{{ url('admin/dosen/daftar') }}" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ml-auto dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Back
            </a>  
            <div class="py-8 px-4 mx-auto max-w-screen-md">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Edit Mahasiswa</h2>
            </div>    
            <div class="p-6 text-gray-900 dark:text-gray-100">      
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <form action="{{ route('mahasiswa.update.dosen', $mahasiswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User ID</label>
                            <input type="number" value="{{ $mahasiswa->user_id }}" placeholder="User ID" name="user_id" id="user_id" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        </div>
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" value="{{ $mahasiswa->name }}" placeholder="nama" name="name" id="name" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="nim" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIM</label>
                            <input type="number" value="{{ $mahasiswa->nim }}" placeholder="NIM" name="nim" id="nim" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tempat Lahir</label>
                            <input type="text" value="{{ $mahasiswa->tempat_lahir }}" placeholder="Tempat Lahir" name="tempat_lahir" id="tempat_lahir" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
                            <input type="date" value="{{ $mahasiswa->tanggal_lahir }}" name="tanggal_lahir" id="tanggal_lahir" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="kelas_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                            <select name="kelas_id" id="kelas_id" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                <!-- Option values should be dynamically loaded from the database -->
                                @foreach ($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}" {{ $mahasiswa->kelas_id == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Submit
                        </button>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>