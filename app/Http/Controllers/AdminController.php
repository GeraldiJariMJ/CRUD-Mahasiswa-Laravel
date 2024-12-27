<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function daftarlist(){
        $data['getRecord'] = User::getAdmin(5);
        $data['header_title'] = 'Admin List';
        return view('admin.daftar',$data);
    }

    // public function daftarlistdosen(){
    //     $data['getRecord'] = User::getAdmin();
    //     $data['header_title'] = 'Admin List';
    //     return view('admin.dosen.daftar',$data);
    // }

    public function admindosen(){
        $data['getRecord'] = User::getAdminDosen();
        $data['header_title'] = 'Admin List';
        return view('admin.dosen.daftar',$data);
    }

    public function kelaslist(){
        $data['getRecord'] = Dosen::getKelasList();
        $data['header_title'] = 'Admin List';
        return view('admin.dosen.daftar',$data);
    }

    public function add(){
        
        $data['header_title'] = 'Add New List';
        return view('admin.add',$data);
    }

    public function insert(Request $request){
        // dd($request->all());

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect('admin/daftar')->with('Success'. 'Admin Created');
    }

    
    public function edit($id){
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Admin";
            return view('admin.edit', $data);
        }else {
            abort(404);
        } 
    }

    public function createMahasiswa()
    {
        // Ambil semua kelas untuk ditampilkan ke Kaprodi
        $kelasList = Kelas::all();

        return view('mahasiswa.create_mahasiswa', compact('kelasList'));
    }

    public function storeMahasiswa(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required|numeric',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id', // Validasi kelas
            'user_id' => 'required|exists:users,id',  // Validasi user
        ]);

        Mahasiswa::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kelas_id' => $request->kelas_id, // Kaprodi dapat memilih kelas
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('kaprodi.mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function editMahasiswa($id)
    {
        // Ambil mahasiswa berdasarkan ID, tanpa perlu membatasi berdasarkan kelas
        $mahasiswa = Mahasiswa::select('mahasiswas.*', 'kelas.name as kelas_name')
            ->join('kelas', 'mahasiswas.kelas_id', '=', 'kelas.id')
            ->where('mahasiswas.id', $id)
            ->firstOrFail();

        // Ambil semua kelas agar Kaprodi bisa memilih kelas yang berbeda
        $kelasList = Kelas::all();

        return view('admin.mahasiswa.edit', compact('mahasiswa', 'kelasList'));
    }

    public function updateMahasiswa(Request $request, $id)
    {
        // Ambil mahasiswa berdasarkan ID tanpa memeriksa kelas
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id', // Validasi kelas_id
        ]);

        // Update data mahasiswa
        $mahasiswa->update($request->all());

        return redirect('admin/daftar')->with('success', 'Data mahasiswa berhasil diubah.');
    }

    public function editDosen($id)
    {
        // Ambil dosen berdasarkan ID
        $dosen = Dosen::select('dosens.*', 'kelas.name as kelas_name')
            ->join('kelas', 'dosens.kelas_id', '=', 'kelas.id')
            ->where('dosens.id', $id)
            ->firstOrFail();

        // Ambil semua kelas untuk memilih yang baru
        $kelasList = Kelas::all();

        return view('admin.dosen.edit', compact('dosen', 'kelasList'));
    }

    public function updateDosen(Request $request, $id)
    {
        // Ambil dosen berdasarkan ID
        $dosen = Dosen::findOrFail($id);

        // Validasi hanya untuk kelas_id
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id', // Validasi kelas_id
        ]);

        // Update hanya kelas_id
        $dosen->update([
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect('admin/daftar')->with('success', 'Data dosen berhasil diubah.');
    }



    public function update($id, Request $request){
        // dd($request->all());

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('admin/daftar')->with('Success'. 'Admin Update');
    }

    public function destroy($id)
    {
        //get post by ID
        $user = User::findOrFail($id);

        //delete post
        $user->delete();

        //redirect to index
        return redirect('admin/dashboard')->with('Success'. 'Admin Delete');
    }
}
