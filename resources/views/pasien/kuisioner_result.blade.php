@extends('layouts.dashboard')
@section('content')
@include('sweetalert::alert')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
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
                <h3 class="card-title">Hasil Kuisioner</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Penyakit</th>
                            <th>Keyakinan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                        <tr>
                            <td>{{ $result['penyakit']->nama_penyakit }}</td>
                            <td>{{ number_format($result['confidence'] * 100, 2) }}%</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('home.kuisioner.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </section>
</div>
@endsection
