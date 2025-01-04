@extends('layouts.dashboard')
@section('content')
{{-- Notif Alert --}}
@include('sweetalert::alert')
{{-- End Notif Alert --}}
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail Penyakit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3>Detail Penyakit: {{ $penyakit->nama_penyakit }}</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Penyakit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $penyakit->kode }}</td>
                            <td>{{ $penyakit->nama_penyakit }}</td>
                        </tr>
                    </tbody>
                </table>
                <h4 class="mt-4">Gejala Terkait</h4>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Kode Gejala</th>
                            <th>Deskripsi Gejala</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penyakit->gejala as $gejala)
                        <tr>
                            <td>{{ $gejala->kode }}</td>
                            <td>{{ $gejala->deskripsi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@endsection
