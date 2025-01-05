<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pasien;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return view('admin.users.index', [
                'pasien' => $users,
                'title' => 'Daftar Pasien',
            ]);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validateUser($request);

        try {
            DB::transaction(function () use ($request) {
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'type' => $request->type,
                ]);
            });

            Alert::toast('User berhasil ditambahkan', 'success');
            return redirect()->route('home.pasien.index');
        } catch (\Exception $e) {
            return $this->handleException($e, $request);
        }
    }

    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.users.edit', ['user' => $user]);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validateUser($request, $id);

        try {
            DB::transaction(function () use ($request, $id) {
                $user = User::findOrFail($id);
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
                    'type' => $request->type,
                ]);
            });

            Alert::toast('User berhasil diubah', 'success');
            return redirect()->route('home.pasien.index');
        } catch (\Exception $e) {
            return $this->handleException($e, $request);
        }
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $user = User::findOrFail($id);
                $user->delete();
            });

            Alert::toast('User berhasil dihapus', 'success');
            return redirect()->route('home.pasien.index');
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function bio($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('pasien.biodata', [
                'title' => 'Biodata Pasien',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function updateBio(Request $request, $id)
    {
        $this->validateBio($request, $id);

        try {
            DB::transaction(function () use ($request, $id) {
                $user = User::findOrFail($id);
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);

                $pasien = Pasien::where('user_id', $id)->first();
                $pasien->update([
                    'ktp' => $request->ktp,
                    'tgl_lahir' => $request->tgl_lahir,
                    'tempat_lahir' => $request->tempat_lahir,
                    'alamat' => $request->alamat,
                ]);
            });

            Alert::toast('Biodata berhasil diperbarui', 'success');
            return redirect()->route('home.biodata.index', $id);
        } catch (\Exception $e) {
            return $this->handleException($e, $request);
        }
    }

    private function validateUser(Request $request, $id = null)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => $id ? 'nullable|string|min:8|confirmed' : 'required|string|min:8|confirmed',
            'type' => 'required|integer',
        ]);
    }

    private function validateBio(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'ktp' => 'required|string|max:255|unique:pasien,ktp,' . $id . ',user_id',
            'tgl_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);
    }

    private function handleException(\Exception $e, Request $request = null)
    {
        Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error');
        return $request ? redirect()->back()->withInput() : redirect()->back();
    }
}
