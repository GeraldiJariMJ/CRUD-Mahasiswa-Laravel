
<link rel="stylesheet" href="https://rsms.me/inter/inter.css">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js">
document.addEventListener("DOMContentLoaded", function(event) {
    document.getElementById('defaultModalButton').click();
});
</script>
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

@include('layouts.app')
@vite(['resources/css/app.css','resources/js/app.js'])
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
       <div class="grid grid-cols-1 gap-4 mb-4">        
           <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if (Auth::user()->role == 'kaprodi')
            <a href="{{ url('admin/edit/'.Auth::user()->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
            <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl md:mb-6">Selamat Datang Di Dashboard Kaprodi</h2>
            @elseif (Auth::user()->role == 2)
            <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl md:mb-6">Selamat Datang Di Dashboard Dosen</h2>
            @elseif (Auth::user()->role == 'mahasiswa')
            <a href="{{ url('mahasiswa/dashboard')}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Back</a>
            <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl md:mb-6">Selamat Datang Di Dashboard Mahasiswa</h2>  
            @endif
            @if (session('success'))
            <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">Item moved successfully.</div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            {{-- {{ session('success') }} --}}
            @endif
               <div class="py-4 md:py-8">
                  <div class="mb-4 grid gap-4 sm:grid-cols-2 sm:gap-8 lg:gap-16">
                  <div class="space-y-4">
                     <div class="flex space-x-4">
                        <img class="h-16 w-16 rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/helene-engels.png" alt="Helene avatar" />
                        <div>
                        <span class="mb-2 inline-block rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300"> PRO Account </span>
                        <h2 class="flex items-center text-xl font-bold leading-none text-gray-900 dark:text-white sm:text-2xl">{{ $mahasiswa->name }}</h2>
                        </div>
                     </div>
                     <dl class="">
                        <dt class="font-semibold text-gray-900 dark:text-white">NIM</dt>
                        <dd class="text-gray-500 dark:text-gray-400">{{ $mahasiswa->nim }}</dd>
                     </dl>
                     <dl>
                        <dt class="font-semibold text-gray-900 dark:text-white">Tempat Lahir</dt>
                        <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                        <svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                        </svg>
                        {{ $mahasiswa->tempat_lahir }}
                        </dd>
                     </dl>
                     <dl>
                        <dt class="font-semibold text-gray-900 dark:text-white">Tanggal Lahir</dt>
                        <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                        <svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                        </svg>
                        {{ $mahasiswa->tanggal_lahir }}
                        </dd>
                     </dl>
                     <dl>
                        <dt class="font-semibold text-gray-900 dark:text-white">Kelas Yang Diambil</dt>
                        <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                        <svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                        </svg>
                        {{ $mahasiswa->kelas_name }}
                        </dd>
                     </dl>
                  </div>
                  <div class="space-y-4">
                     <dl>
                        <dt class="font-semibold text-gray-900 dark:text-white">Account Created At</dt>
                        <dd class="text-gray-500 dark:text-gray-400">{{ Auth::user()->created_at->diffForHumans() }}</dd>
                     </dl>
                     <dl>
                        <dt class="font-semibold text-gray-900 dark:text-white">Status Edit</dt>
                        <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                        <span class="bg-{{ $mahasiswa->edit ? 'green' : 'red' }}-500 text-white py-1 px-2 rounded-full">
                            {{ $mahasiswa->edit ? 'Access Granted - You Can Edit Now' : 'Access Denied' }}
                        </span>
                        
                        <!-- Tampilkan tombol request edit jika mahasiswa belum bisa edit -->

                        {{-- @if ($mahasiswa->edit)
                        <div class="flex justify-center m-5">
                            <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
                            Create product
                            </button>
                        </div>
                            <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <!-- Form untuk mengedit data mahasiswa -->
                                <input type="text" name="name" value="{{ $mahasiswa->name }}">
                                <input type="text" name="nim" value="{{ $mahasiswa->nim }}">
                                <!-- Field lainnya... -->
                                <button type="submit">Simpan</button>
                            </form>
                        @endif --}}
                        </dd>
                     </dl>
                     <div class="space-y-4">
                        @if(!$mahasiswa->edit)
                                <form action="{{ route('request.edit') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ml-auto dark:bg-green-300 dark:hover:bg-blue-700 dark:focus:ring-green-800">Ajukan Permintaan Edit</button>
                                </form>
                        @endif
                        @if ($mahasiswa->edit)
                        <div class="">
                            <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" 
                            class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ml-auto dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">
                                Edit Data Anda
                            </button>
                      </div>
                      <div class="space-y-4">

    </div>

    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Data Mahasiswa
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name" value="{{ $mahasiswa->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                        <div>
                            <label for="nim" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIM</label>
                            <input type="text" name="nim" id="nim" value="{{ $mahasiswa->nim }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                        <div>
                            <label for="nim" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ $mahasiswa->tempat_lahir }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                        <div>
                            <label for="nim" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ $mahasiswa->tanggal_lahir }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                        <!-- Tambahkan field lainnya sesuai kebutuhan -->
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endif

                      </div>
                  </div>
                  
               </div>
           </div>
       </div>
       <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
          <p class="text-2xl text-gray-400 dark:text-gray-500">
             <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
             </svg>
          </p>
       </div>
