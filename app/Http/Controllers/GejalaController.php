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
            //dd([
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
        $request->validate([
            'kode' => 'required|unique:gejala,kode',
            'deskripsi' => 'required|string|max:255',
            'penyakit_id' => 'required|exists:penyakit,id',
            'blf' => 'required|numeric|min:0|max:1',
        ]);

        DB::beginTransaction();
        try {
            $data = new Gejala;
            $data->kode = $request->kode;
            $data->deskripsi = $request->deskripsi;
            $data->penyakit_id = $request->penyakit_id;
            $data->blf = $request->blf;
            $data->save();
            DB::commit();
            Alert::toast('Data berhasil ditambahkan', 'success');
            return redirect()->route('admin.gejala.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|unique:gejala,kode,' . $id,
            'deskripsi' => 'required|string|max:255',
            'penyakit_id' => 'required|exists:penyakit,id',
            'blf' => 'required|numeric|min:0|max:1',
        ]);

        DB::beginTransaction();
        try {
            $data = Gejala::find($id);
            $data->kode = $request->kode;
            $data->deskripsi = $request->deskripsi;
            $data->penyakit_id = $request->penyakit_id;
            $data->blf = $request->blf;
            $data->save();
            DB::commit();
            Alert::toast('Data berhasil diubah', 'success');
            return redirect()->route('admin.gejala.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $data = Gejala::find($id);
            $data->delete();
            DB::commit();
            Alert::toast('Data berhasil dihapus', 'success');
            return redirect()->route('admin.gejala.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }
}
