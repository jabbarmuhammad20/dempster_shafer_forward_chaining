@extends('layouts.master_admin')
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
                        <li class="breadcrumb-item active">Daftar Penyimpangan </li>
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
                <h3>Daftar Penyakit Penyimpangan</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Penyimpangan</th>
                            <th>Kode</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
                            @foreach ($penyakit as $g )
                            <td>{{$g->kode}}</td>
                            <td>{{$g->Gejala->deskripsi}}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@endsection
