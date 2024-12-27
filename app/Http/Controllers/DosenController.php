<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\RequestIzin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function daftarlist(){
        $data['getRecord'] = Dosen::getDosen();
        $data['header_title'] = 'Dosen List';
        return view('dosen.daftar',$data);
    }

    public function showMahasiswa()
    {
        $user = Auth::user();

        if ($user->dosen) {
            // Ambil kelas_id dari dosen yang sedang login
            $kelas_id = $user->dosen->kelas_id;
    
            // Ambil mahasiswa berdasarkan kelas_id tersebut
            $mahasiswas = Mahasiswa::select('mahasiswas.*', 'kelas.name as kelas_name')
            ->join('kelas', 'mahasiswas.kelas_id', '=', 'kelas.id')
            ->where('mahasiswas.kelas_id', $kelas_id)
            ->get();

            //Gabut banget Njir
    
            return view('mahasiswa.daftarmhs', compact('mahasiswas'));
        } else {
            // Jika user tidak memiliki data dosen, tampilkan error atau redirect
            return redirect()->back()->with('error', 'Anda bukan dosen wali, pastikan anda sudah terhubung ke kelas');
        }
    }

    public function createDosen()
    {
        $kelasList = Kelas::all(); // Ambil semua kelas untuk dropdown
        return view('admin.dosen.add', compact('kelasList'));
    }

    public function storeDosen(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'kode_dosen' => 'required|numeric',
            'nip' => 'required|numeric',
            'kelas_id' => 'required|exists:kelas,id', // Pastikan kelas_id valid
        ]);

        // // Buat pengguna baru untuk dosen
        // $user = User::create([
        //     'name' => $request->name,
        //     'role' => 'dosen', // Atur role sesuai kebutuhan
        //     // Tambahkan field lain yang diperlukan untuk pengguna
        // ]);

        // Buat data dosen
        Dosen::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'kode_dosen' => $request->kode_dosen,
            'nip' => $request->nip,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('dosen.store')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function createMahasiswa()
    {
        $dosen = Auth::user()->dosen;

        $kelasList = Kelas::all();

        return view('mahasiswa.create_mahasiswa', compact('kelasList'))->with('kelas_id', $dosen->kelas_id);
    }

    public function storeMahasiswa(Request $request)
    {
        $dosen = Auth::user()->dosen;

        $request->validate([
            'name' => 'required',
            'nim' => 'required|numeric',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        try {
            // Buat data mahasiswa
            Mahasiswa::create([
                'name' => $request->name,
                'nim' => $request->nim,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'kelas_id' => $dosen->kelas_id,
                'user_id' => $request->user_id,
            ]);
    
            // Redirect dengan pesan sukses
            return redirect()->route('dosen.mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan.');
    
        } catch (\Exception $e) {
            // Redirect kembali dengan pesan error jika terjadi kesalahan
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan mahasiswa. Pastikan User ID Mahasiswa Sesuai'])->withInput();
        }
    }

    public function editMahasiswa($id)
    {
        $dosen = Auth::user()->dosen;

        $mahasiswa = Mahasiswa::select('mahasiswas.*', 'kelas.name as kelas_name')
        ->join('kelas', 'mahasiswas.kelas_id', '=', 'kelas.id')
        ->where('mahasiswas.id', $id)
        ->where('mahasiswas.kelas_id', $dosen->kelas_id)
        ->firstOrFail();

        $kelasList = Kelas::all();

        return view('mahasiswa.edit_mahasiswa', compact('mahasiswa', 'kelasList'));
    }

    public function updateMahasiswa(Request $request, $id)
    {
        $dosen = Auth::user()->dosen;

        $mahasiswa = Mahasiswa::where('id', $id)
            ->where('kelas_id', $dosen->kelas_id)
            ->firstOrFail();

        $request->validate([
            'name' => 'required',
            'nim' => 'required|numeric',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('dosen.mahasiswa')->with('success', 'Data mahasiswa berhasil diubah.');
    }



    public function admindosen(){
        $data['getRecord'] = User::getAdminDosen();
        $data['header_title'] = 'Admin List';
        return view('dosen.daftar',$data);
    }

    public function kelaslist(){
        $data['getRecord'] = Dosen::getKelasList();
        $data['header_title'] = 'Admin List';
        return view('dosen.daftar',$data);
    }

    public function add_dosen(){
        
        $data['header_title'] = 'Add New List Dosen';
        return view('admin.dosen.add',$data);
    }

    public function showRequests()
    {
        
        $dosen = Auth::user()->dosen;
        

        if (!$dosen || !$dosen->kelas_id) {
            return redirect()->back()->with('error', 'Anda belum terhubung ke kelas.');
        }

        elseif($kelas_id = $dosen->kelas_id){
            $requests = RequestIzin::with(['mahasiswa.user', 'kelas']) // Mengambil data mahasiswa dan kelas terkait
            // ->orderBy('created_at', 'desc')
            // ->get();
            ->where('kelas_id', $kelas_id) // Filter berdasarkan kelas dosen
            ->orderBy('created_at', 'desc')
            ->get();
        }

        

        return view('dosen.request', compact('requests'));
    }

    // Geraldi Zero Sanity Moment

    // Menyetujui request edit data
    public function approveRequest($id)
    {
        $request = RequestIzin::findOrFail($id);

        // Ubah status mahasiswa agar bisa edit
        $mahasiswa = Mahasiswa::findOrFail($request->mahasiswa_id);
        $mahasiswa->edit = true;
        $mahasiswa->save();

        // Hapus request setelah disetujui
        $request->delete();

        return redirect()->back()->with('success', 'Request disetujui, mahasiswa dapat mengedit datanya.');
    }

    public function deniedRequest($id)
    {
        $request = RequestIzin::findOrFail($id);

        // Ubah status mahasiswa agar bisa edit
        $mahasiswa = Mahasiswa::findOrFail($request->mahasiswa_id);
        $mahasiswa->edit = false;
        $mahasiswa->save();

        // Hapus request setelah disetujui
        $request->delete();

        return redirect()->back()->with('success', 'Request ditolak.');
    }

    public function insert(Request $request){

        // Insert data dosen
        $dosen = new Dosen;
        $dosen->user_id = $request->user_id;
        $dosen->kelas_id = $request->kelas_id;
        $dosen->kode_dosen = trim($request->kode_dosen);
        $dosen->nip = $request->nip;
        $dosen->name = $request->name;
        $dosen->save(); // simpan data dosen

        return redirect('admin/daftar')->with('Success'. 'Admin Created');
    }

    public function edit($id){
        $data['getRecord'] = Dosen::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Admin";
            return view('admin.dosen.edit', $data);
        }else {
            abort(404);
        }
        
    }

    public function update($id, Request $request){
        // dd($request->all());

        $user = Dosen::getSingle($id);
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
        $dosen = Dosen::findOrFail($id);

        //delete post
        $dosen->delete();

        

        //redirect to index
        return redirect('dosen/daftar')->with('Success'. 'Admin Delete');
    }

    public function destroyMhs($id)
    {
        //get post by ID
        $mahasiswa= Mahasiswa::findOrFail($id);

        //delete post
        $mahasiswa->delete(); 
        //redirect to index
        return redirect('mahasiswa/daftarmhs')->with('Success'. 'Admin Delete');
    }


    
}
