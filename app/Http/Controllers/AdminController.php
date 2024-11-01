<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Gejala;
use App\Models\Penyakit;
use Alert;

class AdminController extends Controller
{
    public function detailPenyakit($id)
    {
        // Mengambil data penyakit berdasarkan id
        $penyakit = Gejala::with('Penyakit')
        ->where($id,'penyakit_id')
        ->get();
        return view ('admin.detailPenyakit_admin',compact('penyakit'));
    }

    // Menampilkan daftar pasien
    public function daftar(){
        $pasien = Pasien::with('User')
        ->get();
        return view('admin.daftarPasien_admin')->with('pasien', $pasien);
        }

    // Menampilkan daftar gejala
    public function gejala(){
        $penyakitlist = Penyakit::all();
        $gejala = Gejala::with('Penyakit')
        ->get();
        return view('admin.gejalaPasien_admin',compact('gejala','penyakitlist'));
        }

       // Menampilkan penyakit penyimpangan
    public function penyakit(){
        $penyakit = Penyakit::all();
        return view('admin.penyakitPasien_admin')->with('penyakit', $penyakit);
        }

    // Menambahkan data penyimpangan
    public function storePenyakit(Request $request){
        $penyakit = new Penyakit;
        $penyakit-> kode=$request->kode;
        $penyakit-> nama_penyakit=$request->nama_penyakit;
        $penyakit->save();
        Alert::toast('Data berhasil ditambahkan','success');
        return redirect()->route('admin.penyakit');
        }

        // Update nama penyimpangan
    public function updatePenyakit(Request $request, $id){ 
        $penyakit = Penyakit::where('id', $id)->first();
        $penyakit -> kode =$request->input('kode');
        $penyakit -> nama_penyakit =$request->input('nama_penyakit');
        $penyakit -> update();
        Alert::toast('Data Berhasil Diubah','success');
        return redirect()->back();
        }
    // Menambahkan data gejala penyimpanan
    public function storeGejala(Request $request){
        $gejala = new Gejala;
        $gejala-> penyakit_id=$request->penyakit_id;
        $gejala-> kode=$request->kode;
        $gejala-> deskripsi=$request->deskripsi;
        $gejala-> blf=$request->blf;
        $gejala->save();
        Alert::toast('Data berhasil ditambahkan','success');
        return redirect()->back();
        }
}

