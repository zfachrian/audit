@extends('admin.templates.main')
@section('title') Dashboard @endsection
@section('style')@endsection
@section('script')@endsection


@section('content')
    <div class="col-lg-12">
        <div class="card">
        <div class="card-body">
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                        <h3>{{$jmlDiaudit}}</h3>

                        <p>Perusahaan Di Audit</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">Last Update : {{$updateDiaudit->updated_at}}</a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$jmlAuditor}}<sup style="font-size: 20px"></sup></h3>

                        <p>Auditor</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">Last Update : {{$updateAuditor->updated_at}}</a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$jmlSkema}}</h3>

                        <p>Skema Audit</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">Last Update : {{$updateSkema->updated_at}}</a>
                    </div>
                </div>
                <!-- ./col -->
                </div>
        </div>
        </div><!-- /.card -->
    </div>
@endsection

