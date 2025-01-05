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
                <h3 class="card-title">Pilih Gejala</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('home.kuisioner.store') }}" method="POST">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="gejala">Gejala</label>
                        @foreach ($gejala as $g)
                        <div class="card mb-2">
                            <div class="m-3 d-flex justify-content-between align-items-center">
                                <p class="form-check-label" for="gejala-{{ $g->id }}">
                                    {{ $g->deskripsi }}
                                </p>

                                <input type="checkbox" id="gejala-{{ $g->id }}" name="gejala[]" value="{{ $g->id }}">
                            </div>
                        </div>

                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Diagnosis Sebelumnya</h3>
            </div>
            <div class="card-body">
                <p><strong>Diagnosis:</strong> {{ $diagnosis }}</p>
                <p><strong>Confidence:</strong> {{ number_format($confidence * 100, 2) }}%</p>
            </div>
        </div>
    </section>
</div>
@endsection
