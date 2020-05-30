@extends('admin.templates.main')
@section('title') Dashboard @endsection
@section('style')@endsection
@section('script')@endsection


@section('content')
    <div class="col-md-12">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Horizontal Form -->
    <div class="card card-secondary">
        <!-- Session -->
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <!-- form start -->
        <form method="post" action="{{ route('user.store') }}" class="form-horizontal" enctype="multipart/form-data">
           @csrf 
            
             <div class="card-header">
             <h3 class="card-title">{{ $title }} Details</h3>
                <div class="float-right">
                    <!-- add modal -->
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group row">
                    <label for="name_contributor" class="col-sm-4 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name_auditor" name="name_auditor">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telephone_contributor" class="col-sm-4 col-form-label">No. Telp</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="telephone_auditor" name="telephone_auditor" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name_contributor" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="state_auditor" name="state_auditor" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email_contributor" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email_auditor" name="email_auditor" ">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="profile_contributor" class="col-sm-4 col-form-label">Nama Perusahaan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="company_auditor" name="company_auditor" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="profile_contributor" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="profile_contributor" class="col-sm-4 col-form-label">Konfirmasi Password </label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" >
                    </div>
                </div>
                <div hidden class="form-group row">
                    <label for="profile_contributor" class="col-sm-4 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="role_auditor" name="role_auditor" value="{{$role}}">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </form>
    </div>
    <!-- /.card -->

</div>
@endsection

