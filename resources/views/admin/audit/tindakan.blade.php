@extends('admin.templates.main')
@section('title') Dashboard @endsection
@section('style')@endsection
@section('script')
@endsection


@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Data {{ $title }}</h3>
                <div class="float-right">
                    <button class="btn btn-success" onclick="window.print()">Print this page</button>
                    {{-- <a href="/user/create/{{$role}}" class="btn btn-primary">Tambah {{ $title }}</a> --}}
                    <!-- add modal -->
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-add-modal-lg">Add Auditor</button> --}}
                </div>
            </div>
            
            <?php 
            $act = "/SubmitTindakan"
            ?>
            @if ($statusTindakan == 0)
                <?php $act = "/SubmitTindakan"?>
            @else
                <?php $act = "/UpdateTindakan" ?>
            @endif
            <form method="POST" action="{{$act}}" class="form-horizontal" enctype="multipart/form-data">
                @method("POST")
                @csrf
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
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
                                <table id="tabelInput" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                                No
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                                What
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                                Action
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                                Who
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                When
                                            </th>
                                        </tr>
                                    </thead>
                                           
                                        <tbody>

                                            <?php 
                                            $dis = "disabled"
                                            ?>
                                            @if ($statusTindakan == 0)
                                                <?php $dis = "disabled"?>
                                            @else
                                                <?php $dis = "" ?>
                                            @endif

                                            @foreach ($data_tindakan_collection as $item)
                                            <tr role="row" class="odd">
                                                <td colspan="6" style="background-color:yellow;">{{$item['kategoriSoal']}}</td>
                                            </tr>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">{{$loop->iteration}}
                                                        <input {{$dis}} hidden type="number" class="form-control" name="tindakan_id[{{$loop->iteration}}]" id="tindakan_id" value="{{$item['tindakan_id']}}">
                                                        <input hidden type="number" class="form-control" name="audit_id[{{$loop->iteration}}]" id="audit_id" value="{{$item['audit_id']}}">
                                                        <input hidden type="number" class="form-control" name="kategori_id[{{$loop->iteration}}]" id="kategori_id{{$loop->iteration}}" value="{{$item['kategori_id']}}">
                                                    </td>
                                                    <td style="width: 30%" >
                                                        <textarea type="textarea" class="form-control what-input" value="{{$item['what']}}" name="what[{{$loop->iteration}}]" id="what{{$loop->iteration}}"  placeholder="What (di isi oleh auditor)">
                                                        {{$item['what']}}
                                                        </textarea>
                                                    </td>
                                                    <td>
                                                        <textarea type="textarea" class="form-control" value="{{$item['action']}}" name="action[{{$loop->iteration}}]" id="action{{$loop->iteration}}"  placeholder="action (di isi oleh kontaktor)">
                                                        {{$item['action']}}
                                                        </textarea>
                                                    </td>
                                                    <td >
                                                        <textarea type="textarea" class="form-control" value="{{$item['who']}}" name="who[{{$loop->iteration}}]" id="who{{$loop->iteration}}"  placeholder="who (di isi oleh kontaktor)">
                                                        {{$item['who']}}
                                                        </textarea>
                                                    </td>
                                                    <td >
                                                        <input type="date" class="form-control" value="{{$item['when']}}" name="when[{{$loop->iteration}}]" id="when{{$loop->iteration}}"  >
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    <tfoot>
                                        <tr>
                                            {{-- <th rowspan="1" colspan="4">Nilai Kepatuhan Rata-rata</th> --}}
                                            {{-- <th rowspan="1" colspan="2"><input  type="number" id="totalPersen" readonly value="0" class="total-persen" />%</th> --}}
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-dark" href="/audit">Back</a>
                    <button type="submit" class="btn btn-info float-right">Submit</button>
                </div>
            </form>
        </div><!-- /.card -->
    </div>


@endsection

