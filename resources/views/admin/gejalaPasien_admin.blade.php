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
                        <li class="breadcrumb-item active">Daftar Gejala </li>
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
                <h3>Daftar Gejala Penyimpangan </h3> <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah">
                    Tambah
                </button></div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr> 
                            <th>No</th>
                            <th>Nama Penyimpangan</th>
                            <th>Gejala Penyimpangan</th>
                            <th>Nilai Belief</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gejala as $index => $p )
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $p->Penyakit->nama_penyakit }}</td>
                                    <td>{{ $p->deskripsi }}</td>
                                    <td>{{ $p->blf }} </td>
                                    <td>
                                        <a href="#"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>
                                        </button></a>

                                        <a href="#"><button type="button" class="btn btn-warning btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                          </svg>
                                        </button></a>

                                        <a href="#"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                        </button></a>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

{{-- Modal tambah data penyimpangan --}}
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Gejala Penyimpangan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="storeGejala" method="post" class="f1">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Kode</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" name="kode" placeholder="kode">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Penyakit</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" style="width: 100%;" name="penyakit_id">
                                    <option selected="selected">-</option>
                                    @foreach ($penyakitlist as $p )
                                    <option value="{{$p->id}}">{{$p->nama_penyakit}}</option>    
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" name="deskripsi"
                                    placeholder="Deskripsi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nilai</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" name="blf"
                                    placeholder="Nilai Bilief">
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
