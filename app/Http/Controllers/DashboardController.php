<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard(){
        if(Auth::user()->role == 'kaprodi'){
            return view('admin/dashboard');
        }
        elseif(Auth::user()->role == 'dosen'){
            return view('dosen/dashboard');
        }
        elseif(Auth::user()->role == 'mahasiswa'){
            return view('mahasiswa/dashboard');
        }
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
}
