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
                                <form method="POST" action="{{ route('SoalWIP.store') }}" class="form-horizontal" enctype="multipart/form-data">
                                    @method("POST")
                                    @csrf
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div hidden class="form-group">
                                                <label for="exampleInputPassword1">ID Kategori</label>
                                                <input type="text" class="form-control" name="kategori_id" id="kategori_id" value="{{$kategori_id}}" placeholder="ID Jenis Audit">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" class="text-dark">Soal</label>
                                                <input type="text" class="form-control" name="soal" id="soal" placeholder="Soal">
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
                        <tr role="row" class="odd">
                            <td colspan="6" style="background-color:yellow;"> Kategori : {{$kategori['0']->kategoriSoal}}</td>
                        </tr>
                        <tr>
                            <th>No</th>
                            <th>Soal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($soal as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->topik }}</td>
                            <td style="width: 15%">
                                <a href="{{ route('audit.create') }}" class="btn btn-success" data-toggle="modal" data-target="#editDataModal{{$item->id}}">Edit</a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-delete-modal-lg{{$item->id}}">Delete</button>
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
                                                    <h5> Apakah anda yakin untuk menghapus data kategori "{{$item->topik}}" ?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="post" action="{{ route('SoalWIP.destroy', $item->id ) }}" class="d-inline">
                                                        @method('delete') @csrf
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- tambah data modal -->
                                <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Kategori</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!-- form start -->
                                            <form method="POST" action="{{ route('SoalWIP.store') }}" class="form-horizontal" enctype="multipart/form-data">
                                                @method("POST")
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <div hidden class="form-group">
                                                            <label for="exampleInputPassword1">ID Kategori</label>
                                                            <input type="text" class="form-control" name="kategori_id" id="kategori_id" value="{{$kategori_id}}" placeholder="ID Jenis Audit">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Soal</label>
                                                            <input type="text" class="form-control" name="soal" id="soal" placeholder="Soal">
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

                                <!-- edit data modal -->
                                <div class="modal fade" id="editDataModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Soal</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!-- form start -->
                                            <form method="POST" action="{{ route('SoalWIP.update', $item->id) }}" class="form-horizontal" enctype="multipart/form-data">
                                                @method("PUT")
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <div hidden class="form-group">
                                                            <label for="exampleInputPassword1">ID Kategori</label>
                                                            <input type="text" class="form-control" name="kategori_id" id="kategori_id" value="{{$kategori_id}}" placeholder="ID Kategori">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Soal</label>
                                                            <input type="text" class="form-control" value="{{$item->topik}}" name="soal" id="soal" placeholder="Soal">
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
            <div class="card-footer">
                <a class="btn btn-dark" href="{{ URL::previous() }}">Back</a>
                {{-- <button type="submit" class="btn btn-info float-right">Submit</button> --}}
            </div>
        </div><!-- /.card -->
    </div>

@endsection

