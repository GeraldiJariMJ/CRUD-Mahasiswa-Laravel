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
            {{-- <a href="{{ url('mahasiswa/show/'.Auth::user()->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> --}}
            <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl md:mb-6">Selamat Datang Di Dashboard Mahasiswa</h2>  
            @endif
               {{-- <div class="py-4 md:py-8">
                  <div class="mb-4 grid gap-4 sm:grid-cols-2 sm:gap-8 lg:gap-16">
                  <div class="space-y-4">
                     <div class="flex space-x-4">
                        <img class="h-16 w-16 rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/helene-engels.png" alt="Helene avatar" />
                        <div>
                        <span class="mb-2 inline-block rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300"> PRO Account </span>
                        <h2 class="flex items-center text-xl font-bold leading-none text-gray-900 dark:text-white sm:text-2xl">{{ Auth::user()->name }}</h2>
                        </div>
                     </div>
                     <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                        <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Read more
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                     <dl class="">
                        <dt class="font-semibold text-gray-900 dark:text-white">Email Address</dt>
                        <dd class="text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</dd>
                     </dl>
                     <dl>
                        <dt class="font-semibold text-gray-900 dark:text-white">Account Name</dt>
                        <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                        <svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                        </svg>
                        2 Miles Drive, NJ 071, New York, United States of America
                        </dd>
                     </dl>
                     <dl>
                        <dt class="font-semibold text-gray-900 dark:text-white">Delivery Address</dt>
                        <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                        <svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                        </svg>
                        9th St. PATH Station, New York, United States of America
                        </dd>
                     </dl>
                  </div>
                  <div class="space-y-4">
                     <dl>
                        <dt class="font-semibold text-gray-900 dark:text-white">Account Created At</dt>
                        <dd class="text-gray-500 dark:text-gray-400">{{ Auth::user()->created_at->diffForHumans() }}</dd>
                     </dl>
                     <dl>
                        <dt class="font-semibold text-gray-900 dark:text-white">Favorite pick-up point</dt>
                        <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                        <svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                           <path
                              stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 12c.263 0 .524-.06.767-.175a2 2 0 0 0 .65-.491c.186-.21.333-.46.433-.734.1-.274.15-.568.15-.864a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 12 9.736a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 16 9.736c0 .295.052.588.152.861s.248.521.434.73a2 2 0 0 0 .649.488 1.809 1.809 0 0 0 1.53 0 2.03 2.03 0 0 0 .65-.488c.185-.209.332-.457.433-.73.1-.273.152-.566.152-.861 0-.974-1.108-3.85-1.618-5.121A.983.983 0 0 0 17.466 4H6.456a.986.986 0 0 0-.93.645C5.045 5.962 4 8.905 4 9.736c.023.59.241 1.148.611 1.567.37.418.865.667 1.389.697Zm0 0c.328 0 .651-.091.94-.266A2.1 2.1 0 0 0 7.66 11h.681a2.1 2.1 0 0 0 .718.734c.29.175.613.266.942.266.328 0 .651-.091.94-.266.29-.174.537-.427.719-.734h.681a2.1 2.1 0 0 0 .719.734c.289.175.612.266.94.266.329 0 .652-.091.942-.266.29-.174.536-.427.718-.734h.681c.183.307.43.56.719.734.29.174.613.266.941.266a1.819 1.819 0 0 0 1.06-.351M6 12a1.766 1.766 0 0 1-1.163-.476M5 12v7a1 1 0 0 0 1 1h2v-5h3v5h7a1 1 0 0 0 1-1v-7m-5 3v2h2v-2h-2Z"
                           />
                        </svg>
                        Herald Square, 2, New York, United States of America
                        </dd>
                     </dl>
                     <dl>
                        <dt class="font-semibold text-gray-900 dark:text-white">My Companies</dt>
                        <dd class="text-gray-500 dark:text-gray-400">FLOWBITE LLC, Fiscal code: 18673557</dd>
                     </dl>
                     <dl>
                        <dt class="mb-1 font-semibold text-gray-900 dark:text-white">Payment Methods</dt>
                        <dd class="flex items-center space-x-4 text-gray-500 dark:text-gray-400">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-700">
                           <img class="h-4 w-auto dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa.svg" alt="" />
                           <img class="hidden h-4 w-auto dark:flex" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa-dark.svg" alt="" />
                        </div>
                        <div>
                           <div class="text-sm">
                              <p class="mb-0.5 font-medium text-gray-900 dark:text-white">Visa ending in 7658</p>
                              <p class="font-normal text-gray-500 dark:text-gray-400">Expiry 10/2024</p>
                           </div>
                        </div>
                        </dd>
                     </dl>
                  </div>
               </div> --}}
               <div class="flex space-x-4">
                <!-- Card 1 -->
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-l font-bold tracking-tight text-gray-900 dark:text-white">INFORMASI PERKULIAHAN</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Informasi Daftar Kelas. Informasi Daftar Kelas. Informasi Daftar Kelas. </p>
                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Read more
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            
                <!-- Card 2 -->
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-l font-bold tracking-tight text-gray-900 dark:text-white">EDIT DATA ANDA</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Form untuk edit data profil. Pastikan anda sudah mendapatkan izin terlebih dahulu.</p>
                    <a href="{{ url('mahasiswa/show/'.Auth::user()->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</a>
                </div>
            </div>
            
           </div>
       </div>
      



