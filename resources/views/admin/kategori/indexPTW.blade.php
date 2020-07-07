<?php
$nav = "admin.templates.main";
$role = Auth::user()->role;
?>
@extends("admin.templates.main")
{{-- @extends('admin.templates.main') --}}
@section('title') Dashboard @endsection
@section('style')@endsection
@section('script')@endsection


@section('content')
    <div class="col-lg-12">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Data {{ $title }}</h3>
                <div class="float-right">
                    <a href="{{ route('audit.create') }}" class="btn btn-success" data-toggle="modal" data-target="#tambahDataModal">Tambah {{ $title }} </a>
                    <!-- tambah data modal -->
                    <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Tambah Data Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- form start -->
                                <form method="POST" action="{{ route('KategoriWIP.store') }}" class="form-horizontal" enctype="multipart/form-data">
                                    @method("POST")
                                    @csrf
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div hidden class="form-group">
                                                <label for="exampleInputPassword1">ID Jenis</label>
                                                <input type="text" class="form-control" name="id_jenis" id="id_jenis" value="{{$id_jenis}}" placeholder="ID Jenis Audit">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="text-dark">Nama Kategori Soal</label>
                                                <input type="text" class="form-control" name="kategoriSoal" id="kategoriSoal" placeholder="Kategori Soal">
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-info float-right" value="submit">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of Modal -->
                </div>
            </div>
            <div class="card-body">
                <!-- /.card-header -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('danger'))
                    <div class="alert alert-danger">
                        {{ session('danger') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <table id="table" class="table table-bordered table-striped" style="max-width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Action</th>
                            <th>Tambah Soal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kategoriSoal }}</td>
                            <td style="width: 15%">
                                <a href="{{ route('audit.create') }}" class="btn btn-success" data-toggle="modal" data-target="#editDataModal{{$item->id}}">Edit</a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-delete-modal-lg{{$item->id}}">Delete</button>
                            </td>
                            <td style="width: 10%">
                                <a href="/SoalPTW/{{$item->id}}" class="btn btn-primary">Tambah Soal</a>
                            </td>

                                <!-- delete modal -->
                                <div class="modal fade bd-delete-modal-lg{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Auditor</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                                <div class="modal-body">
                                                    <h5> Apakah anda yakin untuk menghapus data kategori "{{$item->kategoriSoal}}" ?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="post" action="{{ route('KategoriWIP.destroy', $item->id ) }}" class="d-inline">
                                                        @method('delete') @csrf
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- edit data modal -->
                                <div class="modal fade" id="editDataModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Kategori</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!-- form start -->
                                            <form method="POST" action="{{ route('KategoriWIP.update', $item->id) }}" class="form-horizontal" enctype="multipart/form-data">
                                                @method("PUT")
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <div hidden class="form-group">
                                                            <label for="exampleInputPassword1">ID Jenis</label>
                                                            <input type="text" class="form-control" name="id_jenis" id="id_jenis" value="{{$id_jenis}}" placeholder="ID Jenis Audit">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Nama Kategori Soal</label>
                                                            <input type="text" class="form-control" value="{{$item->kategoriSoal}}" name="kategoriSoal" id="kategoriSoal" placeholder="Kategori Soal">
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info float-right" value="submit">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Modal -->


                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div><!-- /.card -->
    </div>

@endsection

