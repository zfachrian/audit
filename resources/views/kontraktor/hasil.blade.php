<?php
$nav = "admin.templates.main";
$role = Auth::user()->role;
?>
// @if ($role == '1')
//     <?php $nav = "admin.templates.main" ?>
// @elseif($role == '4')
//     <?php $nav = "admin.templates.main" ?>
// @elseif($role == '5')
//     <?php $nav = "admin.templates.main" ?>
// @else
//     <?php $nav = "auditor.templates.main" ?>
// @endif
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
                    {{-- <a href="{{ route('audit.create') }}" class="btn btn-success">Tambah {{ $title }}</a> --}}
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
                                @if ($role == '2')
                                {{-- <button type="button" class="btn btn-secondary">Waiting</button> --}}
                                    <?php if ($item->manajer == "0"){  ?>
                                        <button type="button" class="btn btn-danger">Reject</button>
                                    <?php }elseif ($item->manajer == NULL ){  ?>
                                            <button type="button" class="btn btn-secondary">Waiting</button>
                                    <?php }else {  ?>
                                                <button type="button" class="btn btn-success">Accept</button>
                                    <?php
                                    }
                                    ?>
                                @elseif($role == '3')
                                    <?php if ($item->manajer == "0"){  ?>
                                        <button type="button" class="btn btn-danger">Reject</button>
                                    <?php }elseif ($item->manajer == NULL ){  ?>
                                            <button type="button" class="btn btn-secondary">Waiting</button>
                                    <?php }else {  ?>
                                                <button type="button" class="btn btn-success">Accept</button>
                                    <?php
                                    }
                                    ?>
                                @else
                                    <?php if ($item->manajer == "0"){  ?>
                                        <form method="POST" action="/StatusManajer/{{$item->id}}/{{ Auth::user()->id }}" class="form-horizontal" >
                                            @method("POST")
                                            @csrf
                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </form>
                                        <?php }elseif ($item->manajer == NULL ){  ?>
                                                <form method="POST" action="/StatusManajer/{{$item->id}}/{{ Auth::user()->id }}" class="form-horizontal" >
                                                @method("POST")
                                                @csrf
                                                    <button type="submit" class="btn btn-secondary">Waiting</button>
                                                </form>
                                            <?php }else {  ?>
                                                <form method="POST" action="/StatusManajer/{{$item->id}}/0" class="form-horizontal" >
                                                    @method("POST")
                                                    @csrf
                                                        <button type="submit" class="btn btn-success">Accept</button>
                                                </form>
                                            <?php
                                            }
                                            ?>
                                @endif
                            </td>
                            <td>
                                @if ($role == '2')
                                {{-- <button type="button" class="btn btn-secondary">Waiting</button> --}}
                                    <?php if ($item->supervisor == "0"){  ?>
                                        <button type="button" class="btn btn-danger">Reject</button>
                                    <?php }elseif ($item->supervisor == NULL ){  ?>
                                            <button type="button" class="btn btn-secondary">Waiting</button>
                                    <?php }else {  ?>
                                                <button type="button" class="btn btn-success">Accept</button>
                                    <?php
                                    }
                                    ?>
                                @elseif($role == '3')
                                    <?php if ($item->supervisor == "0"){  ?>
                                        <button type="button" class="btn btn-danger">Reject</button>
                                    <?php }elseif ($item->supervisor == NULL ){  ?>
                                            <button type="button" class="btn btn-secondary">Waiting</button>
                                    <?php }else {  ?>
                                                <button type="button" class="btn btn-success">Accept</button>
                                    <?php
                                    }
                                    ?>
                                @else
                                    <?php if ($item->supervisor == "0"){  ?>
                                        <form method="POST" action="/StatusSupervisor/{{$item->id}}/{{ Auth::user()->id }}" class="form-horizontal" >
                                            @method("POST")
                                            @csrf
                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </form>
                                        <?php }elseif ($item->supervisor == NULL ){  ?>
                                                <form method="POST" action="/StatusSupervisor/{{$item->id}}/{{ Auth::user()->id }}" class="form-horizontal" >
                                                @method("POST")
                                                @csrf
                                                    <button type="submit" class="btn btn-secondary">Waiting</button>
                                                </form>
                                            <?php }else {  ?>
                                                <form method="POST" action="/StatusSupervisor/{{$item->id}}/0" class="form-horizontal" >
                                                    @method("POST")
                                                    @csrf
                                                        <button type="submit" class="btn btn-success">Accept</button>
                                                </form>
                                            <?php
                                            }
                                            ?>
                                @endif
                            </td>
                            <td style="width: 35%" >
                                <a href="/AuditTindakan/{{$item->id}}" class="btn btn-warning">Tindakan</a>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-detail-modal-lg{{$item->id}}">Lihat Detail</button>
                                <a href="/hasilNilai/{{$item->id}}" class="btn btn-primary">Hasil Audit</a>
                            </td>

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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- /.card -->
    </div>

@endsection

