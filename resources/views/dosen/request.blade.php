@include('layouts.app')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="grid grid-cols-1 gap-4 mb-4">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Permintaan Izin Mahasiswa
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Daftar permintaan izin dari mahasiswa yang perlu diproses oleh dosen.</p>
                </caption>
                @if ($requests->isEmpty())
                    <p class="text-center text-gray-500 dark:text-gray-400">Tidak ada permintaan izin saat ini.</p>
                @else
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama Mahasiswa</th>
                                <th scope="col" class="px-6 py-3">Kelas</th>
                                <th scope="col" class="px-6 py-3">Keterangan</th>
                                <th scope="col" class="px-6 py-3">Tanggal</th>
                                <th scope="col" class="px-6 py-3"><span class="sr-only">Aksi</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $request->mahasiswa->user->name }}</td>
                                    <td class="px-6 py-4">{{ $request->kelas->name }}</td>
                                    <td class="px-6 py-4">{{ $request->keterangan }}</td>
                                    <td class="px-6 py-4">{{ $request->created_at->format('d-m-Y H:i') }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('dosen.approve', $request->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">Setujui</button>
                                        </form>
                                        <form action="{{ route('dosen.denied', $request->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="text-white bg-red-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">Tolak</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
            <p class="text-2xl text-gray-400 dark:text-gray-500">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                </svg>
            </p>
        </div>
    </div>
</div>

{{-- 
@if ($requests->isEmpty())
    <p>Tidak ada request izin saat ini.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>Kelas</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
                <tr>
                    <td>{{ $request->mahasiswa->user->name }}</td>
                    <td>{{ $request->kelas->name }}</td>
                    <td>{{ $request->keterangan }}</td>
                    <td>{{ $request->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <form action="{{ route('dosen.approve', $request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Setujui</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif --}}
