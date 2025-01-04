<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class GejalaController extends Controller
{
    public function index()
    {
        try {
            $title = 'Delete Data!';
            $text = "Are you sure you want to delete?";
            confirmDelete($title, $text);

            return view('admin.gejala.index', [
                'title' => 'Daftar Gejala',
                'data' => Gejala::with('penyakit')->get(),
                'penyakit' => Penyakit::all(),
            ]);
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        DB::transaction(function () use ($request) {
            Gejala::create($request->all());
            Alert::toast('Data berhasil ditambahkan', 'success');
        });

        return redirect()->route('home.gejala.index');
    }

    public function update(Request $request, $id)
    {
        $this->validateRequest($request, $id);

        DB::transaction(function () use ($request, $id) {
            $gejala = Gejala::findOrFail($id);
            $gejala->update($request->all());
            Alert::toast('Data berhasil diubah', 'success');
        });

        return redirect()->route('home.gejala.index');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $gejala = Gejala::findOrFail($id);
            $gejala->delete();
            Alert::toast('Data berhasil dihapus', 'success');
        });

        return redirect()->route('home.gejala.index');
    }

    private function validateRequest(Request $request, $id = null)
    {
        $request->validate([
            'kode' => 'required|unique:gejala,kode,' . $id,
            'deskripsi' => 'required|string|max:255',
            'penyakit_id' => 'required|exists:penyakit,id',
            'blf' => 'required|numeric|min:0|max:1',
        ]);
    }
}
