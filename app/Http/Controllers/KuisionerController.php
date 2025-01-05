<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Pasien;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KuisionerController extends Controller
{
    public function index()
    {
        $gejala = Gejala::all();
        $pasien = Pasien::where('user_id', Auth::id())->first();

        return view('pasien.kuisioner', [
            'title' => 'Kuisioner',
            'gejala' => $gejala,
            'diagnosis' => $pasien->diagnosis ?? 'Belum ada diagnosis',
            'confidence' => $pasien->confidence ?? 0,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'gejala' => 'required|array|min:3',
            'gejala.*' => 'exists:gejala,id',
        ], [
            'gejala.min' => 'Anda harus memilih minimal 3 gejala.',
        ]);

        $selectedGejala = Gejala::whereIn('id', $request->gejala)->get();
        $penyakitScores = [];

        // Forward chaining untuk menemukan kemungkinan penyakit
        foreach ($selectedGejala as $gejala) {
            $penyakit = $gejala->penyakit;
            if (!isset($penyakitScores[$penyakit->id])) {
                $penyakitScores[$penyakit->id] = 0;
            }
            $penyakitScores[$penyakit->id] += $gejala->blf;
        }

        // Teori Dempster-Shafer untuk menentukan keyakinan
        $totalScore = array_sum($penyakitScores);
        $penyakitConfidence = [];
        foreach ($penyakitScores as $penyakitId => $score) {
            $penyakitConfidence[$penyakitId] = $score / $totalScore;
        }

        // Mendapatkan penyakit dengan tingkat keyakinan mereka
        $penyakitResults = Penyakit::whereIn('id', array_keys($penyakitConfidence))->get()->map(function ($penyakit) use ($penyakitConfidence) {
            return [
                'penyakit' => $penyakit,
                'confidence' => $penyakitConfidence[$penyakit->id]
            ];
        });

        // Menemukan penyakit yang paling mungkin
        $mostLikelyPenyakit = $penyakitResults->sortByDesc('confidence')->first();

        // Memperbarui data Pasien
        $pasien = Pasien::where('user_id', Auth::id())->first();
        $pasien->update([
            'diagnosis' => $mostLikelyPenyakit['penyakit']->nama_penyakit,
            'confidence' => $mostLikelyPenyakit['confidence']
        ]);

        return view('pasien.kuisioner_result', [
            'title' => 'Hasil Kuisioner',
            'results' => $penyakitResults
        ]);
    }
}
