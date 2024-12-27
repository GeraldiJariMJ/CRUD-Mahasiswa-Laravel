<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\RequestIzin;
use Illuminate\Http\Request;

class RequestIzinController extends Controller
{
    //
    public function approveRequest($id)
    {
        // Dosen menyetujui request
        $request = RequestIzin::findOrFail($id);

        // Ubah status mahasiswa agar bisa edit
        $mahasiswa = Mahasiswa::findOrFail($request->mahasiswa_id);
        $mahasiswa->edit = true;
        $mahasiswa->save();

        // Hapus request setelah disetujui
        $request->delete();

        return redirect()->back()->with('success', 'Request disetujui, mahasiswa dapat mengedit datanya.');
    }
}
