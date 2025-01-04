<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyakit;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PenyakitController extends Controller
{
    public function index()
    {
        try {
            $title = 'Delete Data!';
            $text = "Are you sure you want to delete?";
            confirmDelete($title, $text);

            return view('admin.penyakit.index', [
                'title' => 'Daftar Penyakit Penyimpangan',
                'data' => Penyakit::all()
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
            Penyakit::create($request->all());
            Alert::toast('Data berhasil ditambahkan', 'success');
        });

        return redirect()->route('admin.penyakit.index');
    }

    public function update(Request $request, $id)
    {
        $this->validateRequest($request, $id);

        DB::transaction(function () use ($request, $id) {
            $data = Penyakit::findOrFail($id);
            $data->update($request->all());
            Alert::toast('Data berhasil diubah', 'success');
        });

        return redirect()->route('admin.penyakit.index');
    }

    public function detail($id)
    {
        try {
            return view('admin.penyakit.detail', [
                'title' => 'Detail Penyakit',
                'penyakit' => Penyakit::with('gejala')->findOrFail($id)
            ]);
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $data = Penyakit::findOrFail($id);
            $data->delete();
            Alert::toast('Data berhasil dihapus', 'success');
        });

        return redirect()->route('admin.penyakit.index');
    }

    private function validateRequest(Request $request, $id = null)
    {
        $request->validate([
            'kode' => 'required|unique:penyakit,kode,' . $id,
            'nama_penyakit' => 'required|string|max:255',
        ]);
    }
}
