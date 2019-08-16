<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    //
    public function index(Request $request){
        if($request->has('cari')){
            $data_siswa = \App\Siswa::where('nama_depan','LIKE','%' .$request->cari.'%')->get();
        }
        else{
            $data_siswa = \App\Siswa::all();
        }
        // menggunakan array assosiatif
        return view('siswa.index',['data_siswa' => $data_siswa]);
    }

    public function create(Request $request){
        $user = new \App\User; // input ke table user
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('rahasia');
        $user->remember_token = str_random(60);
        $user->save();


       $request->request->add(['user_id' => $user->id]);
       $siswa =  \App\Siswa::create($request->all()); // insert ke databel siswa
        return redirect('/siswa')->with('sukses','Data Berhasil diinput');
    }

    public function edit($id){
        $siswa = \App\Siswa::find($id);
        return view('siswa/edit',['siswa' => $siswa]);
    }

    public function update(Request $request,$id){
        // dd($request->all());

        $siswa = \App\Siswa::find($id);
        $siswa->update($request->all());

        if($request->hasFile('avatar')){
            // Memindahkan request avatar kedalam folder name, di dalam folder public disimpan memanggil Original Name
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            // Lalu dimasukan kedalam database
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses','Data berhasil di Update');
    }

    public function delete($id){
        $siswa = \App\Siswa::find($id);
        $siswa->delete($siswa);
        return redirect('/siswa')->with('sukses','Data berhasil dihapus');
    }

    public function profile($id){
        $siswa = \App\Siswa::find($id);
        return view('siswa.profile',['siswa' => $siswa]);

    }
}
