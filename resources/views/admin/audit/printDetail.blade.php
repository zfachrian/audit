@extends('admin.templates.main')
@section('title') Dashboard @endsection
@section('style')@endsection

@section('content')
@foreach ($diaudit as $audit)
<div class="col-lg-12">
       <div class="card card-primary">
              <div class="card-header">
              <h3 class="card-title">Data {{$title}} </h3>
              <div class="float-right">
                    <button class="btn btn-success" onclick="window.print()">Print this page</button>
               </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('audit.update', $audit->id) }}" class="form-horizontal" enctype="multipart/form-data">
                @method("PUT")
                @csrf
                <div class="card-body">
                 <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Audit</label>
                    <input disabled type="text" class="form-control" value="{{$audit->jenis_audit}}">
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">No. Permit</label>
                  <input disabled type="text" class="form-control" name="permit" id="permit" placeholder="No Permit" value="{{$audit->no_permit}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Perusahaan yang Diaudit</label>
                    <input disabled type="text" class="form-control" value="{{$audit->diaudit}}">
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Lingkup Audit</label>
                  <input disabled type="text" class="form-control" name="lingkup" id="lingkup" placeholder="Lingkup Audit" value="{{$audit->lingkup_audit}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Jenis Usaha</label>
                  <input disabled type="text" class="form-control" name="jenis_usaha" id="jenis_usaha" placeholder="Jenis Usaha" value="{{$audit->jenis_usaha}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tujuan Audit</label>
                  <input disabled type="text" class="form-control" name="tujuan" id="tujuan" placeholder="Tujuan Audit" value="{{$audit->tujuan}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Auditor</label>
                    <input disabled type="text" class="form-control" id="" placeholder="" value="{{auth::user()->name}}">
                    <input hidden type="text" class="form-control" name="auditor" id="auditor" placeholder="" value="{{auth::user()->id}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Jadwal Audit</label>
                  <input disabled type="datetime-local" class="form-control" name="jadwal" id="jadwal" value='{{date_format(date_create($audit->jadwal),"Y-m-d\TH:i:s")}}'>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  {{-- <a type="submit" class="btn btn-dark">Back</a> --}}
                  {{-- <a class="btn btn-info float-right" href="/AuditSumary">Mulai Audit</a> --}}
                  {{-- <button type="submit" class="btn btn-info float-right" value="submit">Simpan Perubahan</button> --}}
                </div>
              </form>
            </div>
    </div>
    @endforeach
@endsection