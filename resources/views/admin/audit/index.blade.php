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
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Perusahaan yang Diaudit</label>
                    <select class="custom-select">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Lingkup Audit</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Auditor</label>
                    <input disabled type="text" class="form-control" id="auditor" placeholder="" value="{{auth::user()->name}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Jadwal Audit</label>
                    <input type="datetime-local" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  {{-- <a type="submit" class="btn btn-dark">Back</a> --}}
                  <a class="btn btn-info float-right" href="/AuditSumary">Mulai Audit</a>
                </div>
              </form>
            </div>
    </div>

@endsection

