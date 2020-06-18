@extends('admin.templates.main')
@section('title') Dashboard @endsection
@section('style')@endsection
@section('script')@endsection


@section('content')
    <div class="col-lg-12">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Data {{ $title }}</h3>
                <div class="float-right">
                    <a href="{{ route('audit.create') }}" class="btn btn-success">Tambah {{ $title }}</a>
                    <!-- add modal -->
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-add-modal-lg">Add Auditor</button> --}}
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
                            <th>Tgl. Audit</th>
                            <th>Perusahaan di audit</th>
                            <th>Auditor</th>
                            <th>Acc Manajer</th>
                            <th>Acc Supervisor</th>
                            <th>Audit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($diaudit as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->jadwal }}</td>
                            <td>{{ $item->diaudit }}</td>
                            <td>{{ $item->auditor }}</td>
                            <td>
                                <?php if ($item->manajer == "0"){  ?>
                                    <button type="button" class="btn btn-danger">Reject</button>
                                    <?php }elseif ($item->manajer == NULL ){  ?>
                                        <button type="button" class="btn btn-secondary">Waiting</button>
                                        <?php }else {  ?>
                                            <button type="button" class="btn btn-success">Accept</button>
                                        <?php
                                        }
                                        ?>
                            </td>
                            <td>
                                <?php if ($item->supervisor == "0"){  ?>
                                    <button type="button" class="btn btn-danger">Reject</button>
                                    <?php }elseif ($item->supervisor == NULL ){  ?>
                                        <button type="button" class="btn btn-secondary">Waiting</button>
                                        <?php }else {  ?>
                                            <button type="button" class="btn btn-success">Accept</button>
                                        <?php
                                        }
                                        ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-detail-modal-lg{{$item->id}}">Lihat Detail</button>
                                <a href="/AuditSumary/{{$item->id}}" class="btn btn-primary">Audit</a>
                            </td>
                            <td style="width: 15%">
                                <a href="{{ route('audit.edit', $item->id ) }}" class="btn btn-success">Edit</a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-delete-modal-lg{{$item->id}}">Delete</button>


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
                                                    <h5> Apakah anda yakin untuk menghapus data audit perusahaan "{{$item->diaudit}}" ?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="post" action="{{ route('audit.destroy', $item->id ) }}" class="d-inline">
                                                        @method('delete') @csrf
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- detail modal --}}
                                <div class="modal fade bd-detail-modal-lg{{$item->id}}" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Data Audit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Jenis Audit</label>
                                                    <input disabled type="text" class="form-control" value="{{$item->jenis_audit}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Perusahaan yang Diaudit</label>
                                                    <input disabled type="text" class="form-control" value="{{$item->diaudit}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Lingkup Audit</label>
                                                    <input disabled type="text" class="form-control" value="{{$item->lingkup_audit}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Jenis Usaha</label>
                                                    <input disabled type="text" class="form-control" value="{{$item->jenis_usaha}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Tujuan Audit</label>
                                                    <input disabled type="text" class="form-control" value="{{$item->tujuan}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Auditor</label>
                                                    <input disabled type="text" class="form-control" value="{{$item->auditor}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Jadwal Audit</label>
                                                    <input disabled type="text" class="form-control" value="{{$item->jadwal}}">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Jenis Audit</th>
                            <th>Perusahaan di audit</th>
                            <th>Jenis Usaha</th>
                            <th>Lingkup Audit</th>
                            <th>Tgl. Audit</th>
                            <th>Tujuan Audit</th>
                            <th>Auditor</th>
                            <th>Action</th>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
        </div><!-- /.card -->
    </div>

@endsection

