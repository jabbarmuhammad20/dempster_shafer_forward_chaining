@extends('layouts.dashboard')
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
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah">
                    Tambah
                </button>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Penyimpangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->kode }}</td>
                                <td>{{ $p->nama_penyakit }}</td>
                                <td>
                                    <a href="{{ route('home.penyakit.detail', $p->id) }}">
                                        <button type="button" class="btn btn-primary btn-sm">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </a>

                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-aksi{{ $p->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <a href="{{ route('home.penyakit.destroy', $p->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                    <form id="delete-form-{{ $p->id }}" action="{{ route('home.penyakit.destroy', $p->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="modal-aksi{{ $p->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Penyimpangan: {{ $p->nama_penyakit }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('home.penyakit.update', $p->id) }}" method="post" class="f1">
                                                @csrf
                                                @method('PUT')
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="kode" class="col-sm-2 col-form-label">Kode</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="kode" name="kode" value="{{ $p->kode }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="nama_penyakit" class="col-sm-2 col-form-label">Nama</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" value="{{ $p->nama_penyakit }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
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

<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Penyakit Penyimpangan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('home.penyakit.store') }}" method="post" class="f1">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="kode" class="col-sm-2 col-form-label">Kode</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_penyakit" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" placeholder="Nama Penyimpangan">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
