<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\RequestIzin;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function daftarlist(){
        $data['getRecord'] = Mahasiswa::getMhs();
        $data['header_title'] = 'Mahasiswa List';
        return view('admin.mahasiswa.daftar', $data);
    }

    public function daftarlistdosen(){
        // $data['getRecord'] = User::getAdmin();
        // $data['header_title'] = 'Dosen List';
        return view('admin.dosen.daftar');
    }

    public function add_mhs(){    
        $data['header_title'] = 'Add New List Mahasiswa';
        return view('admin.mahasiswa.add',$data);
    }

    // Menampilkan data mahasiswa yang sedang login
    public function showMahasiswaData()
    {
        $user = auth()->user(); // Ambil data user yang sedang login
        
        $mahasiswa = Mahasiswa::select('mahasiswas.*', 'kelas.name as kelas_name')
        ->join('kelas', 'mahasiswas.kelas_id', '=', 'kelas.id')
        ->where('mahasiswas.user_id', $user->id)
        ->firstOrFail();
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    // Mengajukan request izin untuk edit data
    public function requestEdit()
    {
        $user = auth()->user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->firstOrFail();

        RequestIzin::create([
            'kelas_id' => $mahasiswa->kelas_id,
            'mahasiswa_id' => $mahasiswa->id,
            'keterangan' => 'Permintaan edit data',
        ]);

        return redirect()->back()->with('success', 'Request untuk edit data telah dikirim.');
    }

    // Mengupdate data mahasiswa dan mencabut akses edit
    public function updateMahasiswaData(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->where('edit', true)->firstOrFail();
        $mahasiswa->update($request->all());

        // Cabut akses edit setelah selesai
        $mahasiswa->edit = false;
        $mahasiswa->save();

        return redirect()->back()->with('success', 'Data berhasil diupdate dan akses edit dicabut.');
    }



    public function insert(Request $request){
        // Ambil jumlah mahasiswa yang sudah ada di kelas tersebut
        $jumlahMahasiswa = Mahasiswa::where('kelas_id', $request->kelas_id)->count();

        // Cek apakah jumlahnya sudah mencapai batas maksimum (misal 10 mahasiswa)
        if ($jumlahMahasiswa >= 10) {
            return redirect()->back()->withErrors(['error' => 'Jumlah mahasiswa dalam kelas ini sudah mencapai batas maksimal. Jika Diperlukan Harap Membuat Kelas Baru']);
        }

        // Validasi apakah user_id ada di tabel users
        $user = User::find($request->user_id);
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User ID tidak valid, Harap Patikan User ID Benar.']);
        }
        

        // Jika belum melebihi kapasitas, lanjutkan dengan menambah mahasiswa
        $mahasiswa = new Mahasiswa();
        $mahasiswa->user_id = $request->user_id;
        $mahasiswa->kelas_id = $request->kelas_id;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->name = $request->name;
        $mahasiswa->tempat_lahir = $request->tempat_lahir;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->save();

        return redirect('admin/mahasiswa/daftar')->with('success', 'Mahasiswa berhasil ditambahkan ke kelas.');
    }

    public function destroy($id)
    {
        //get post by ID
        $mahasiswa= Mahasiswa::findOrFail($id);

        //delete post
        $mahasiswa->delete();

        //redirect to index
        return redirect('admin/dashboard')->with('Success'. 'Admin Delete');
    }

}
