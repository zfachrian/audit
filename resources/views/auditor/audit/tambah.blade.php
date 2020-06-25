@extends('admin.templates.main')
@section('title') Dashboard @endsection
@section('style')@endsection
@section('script')@endsection


@section('content')
    <div class="col-lg-12">
       <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data {{$title}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('audit.store') }}" class="form-horizontal" enctype="multipart/form-data">
                @method("POST")
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Audit</label>
                    <select class="custom-select" name="jenis" id="jenis">
                      @foreach ($data as $item)
                        <option value="{{ $item->id }}">{{ $item->jenis_audit }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Perusahaan yang Diaudit</label>
                    <select class="custom-select" name="diaudit" id="diaudit">
                      @foreach ($user as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endforeach   
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Lingkup Audit</label>
                    <input type="text" class="form-control" name="lingkup" id="lingkup" placeholder="Lingkup Audit">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Jenis Usaha</label>
                    <input type="text" class="form-control" name="jenis_usaha" id="jenis_usaha" placeholder="Lingkup Audit">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tujuan Audit</label>
                    <input type="text" class="form-control" name="tujuan" id="tujuan" placeholder="Lingkup Audit">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Auditor</label>
                    <input disabled type="text" class="form-control" id="" placeholder="" value="{{auth::user()->name}}">
                    <input hidden type="text" class="form-control" name="auditor" id="auditor" placeholder="" value="{{auth::user()->id}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Jadwal Audit</label>
                    <input type="datetime-local" class="form-control" name="jadwal" id="jadwal" >
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  {{-- <a type="submit" class="btn btn-dark">Back</a> --}}
                  {{-- <a class="btn btn-info float-right" href="/AuditSumary">Mulai Audit</a> --}}
                  <button type="submit" class="btn btn-info float-right" value="submit">Mulai Audit</button>
                </div>
              </form>
            </div>
    </div>

@endsection

