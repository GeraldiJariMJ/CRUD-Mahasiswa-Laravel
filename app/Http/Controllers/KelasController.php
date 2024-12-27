<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelasController extends Controller
{
    public function list(){
        $data['getRecord'] = Kelas::getKelasList();
        $data['header_title'] = "Class List";
        return view('kelas', $data);
    }

    public function add_kelas(){      
        $data['header_title'] = 'Add New List Kelas';
        return view('admin.add_kelas',$data);
    }

    public function insert(Request $request){
        // dd($request->all());

        // Validasi input data
        // $request->validate([
        //     'user_id' => 'required|integer|exists:users,id', // Pastikan user_id ada di tabel users
        //     'kelas_id' => 'required|integer|exists:kelas,id', // Pastikan kelas_id ada di tabel kelas
        //     'kode_dosen' => 'required|integer',
        //     'nip' => 'required|integer',
        //     'name' => 'required|string|max:255',
        // ]);

        // Insert data dosen
        $kelas = new Kelas;
        $kelas->id = $request->id;
        $kelas->name = $request->name;
        $kelas->jumlah = 10;
        $kelas->save(); // simpan data dosen

        return redirect('kelas')->with('Success'. 'Admin Created');
    }

    public function edit($id){
        $data['getRecord'] = Kelas::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Admin";
            return view('admin.editkelas', $data);
        }else {
            abort(404);
        }
        
    }

    public function update($id, Request $request){
        // dd($request->all());

        $kelas = Kelas::getSingle($id);
        $kelas->name = trim($request->name);
        $kelas->jumlah= trim($request->jumlah);
        $kelas->save();
        return redirect('kelas')->with('Success'. 'Admin Update');
    }

    public function destroy($id)
    {
        //get post by ID
        $kelas = Kelas::findOrFail($id);

        //delete post
        $kelas->delete();

        //redirect to index
        return redirect('admin/dashboard')->with('Success'. 'Admin Delete');
    }
}
