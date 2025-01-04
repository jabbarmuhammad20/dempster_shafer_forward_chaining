@extends('layouts.master_admin')
@section('content')
@include('sweetalert::alert')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3>{{ $title }}</h3>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-create">
                    Tambah Gejala
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th>Penyakit</th>
                            <th>BLF</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $gejala)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $gejala->kode }}</td>
                            <td>{{ $gejala->deskripsi }}</td>
                            <td>{{ $gejala->penyakit->nama_penyakit ?? 'Penyakit Tidak Ditemukan!' }}</td>
                            <td>{{ $gejala->blf }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-{{ $gejala->id }}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <a href="{{ route('admin.gejala.destroy', $gejala->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <form id="delete-form-{{ $gejala->id }}" action="{{ route('admin.gejala.destroy', $gejala->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="modal-edit-{{ $gejala->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-edit-label-{{ $gejala->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-edit-label-{{ $gejala->id }}">Edit Gejala</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.gejala.update', $gejala->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="kode">Kode</label>
                                                <input type="text" class="form-control" id="kode" name="kode" value="{{ $gejala->kode }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsi">Deskripsi</label>
                                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $gejala->deskripsi }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="penyakit_id">Penyakit</label>
                                                <select class="form-control" id="penyakit_id" name="penyakit_id" required>
                                                    @foreach ($penyakit as $p)
                                                    <option value="{{ $p->id }}" {{ $gejala->penyakit_id == $p->id ? 'selected' : '' }}>{{ $p->nama_penyakit }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="blf">BLF</label>
                                                <input type="number" step="0.01" class="form-control" id="blf" name="blf" value="{{ $gejala->blf }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modal-create-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-create-label">Tambah Gejala</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.gejala.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                    </div>
                    <div class="form-group">
                        <label for="penyakit_id">Penyakit</label>
                        <select class="form-control" id="penyakit_id" name="penyakit_id" required>
                            @foreach ($penyakit as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_penyakit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="blf">BLF</label>
                        <input type="number" step="0.01" class="form-control" id="blf" name="blf" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Gejala</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
