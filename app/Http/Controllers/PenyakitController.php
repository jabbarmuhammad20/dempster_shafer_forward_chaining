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
        $request->validate([
            'kode' => 'required|unique:penyakit,kode',
            'nama_penyakit' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $data = new Penyakit;
            $data->kode = $request->kode;
            $data->nama_penyakit = $request->nama_penyakit;
            $data->save();
            DB::commit();
            Alert::toast('Data berhasil ditambahkan', 'success');
            return redirect()->route('admin.penyakit.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|unique:penyakit,kode,' . $id,
            'nama_penyakit' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $data = Penyakit::find($id);
            $data->kode = $request->kode;
            $data->nama_penyakit = $request->nama_penyakit;
            $data->save();
            DB::commit();
            Alert::toast('Data berhasil diubah', 'success');
            return redirect()->route('admin.penyakit.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function detail($id)
    {
        try {
            return view('admin.penyakit.detail', [
                'title' => 'Detail Penyakit',
                'penyakit' => Penyakit::with('gejala')->find($id)
            ]);
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $data = Penyakit::find($id);
            $data->delete();
            DB::commit();
            Alert::toast('Data berhasil dihapus', 'success');
            return redirect()->route('admin.penyakit.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }
}
