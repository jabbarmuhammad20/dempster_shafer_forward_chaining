<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pasien;
use Alert;
use Illuminate\Support\Str;

class PasienController extends Controller
{


    public function store(Request $request){
        $users = new User;
        $users-> type='0';
        $users-> name=$request->name;
        $users-> email=$request->email;
        $users-> password=bcrypt($request->password);
        $users-> remember_token=str_random(60);
        $users->save();
        //menambahkan ke tabel pasien
        $request->request->add(['user_id'=>$users->id]);
        $pasien = new Pasien;
        $pasien-> user_id =$request->user_id;
        $pasien -> save();
        Alert::Alert('Berhasil Membuat Akun, Silahkan Login Kembali','success');
        return redirect('/');
        
    }
}
