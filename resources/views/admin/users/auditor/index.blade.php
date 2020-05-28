@extends('admin.templates.main')
@section('title') Dashboard @endsection
@section('style')@endsection
@section('script')@endsection


@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data {{ $title }}</h3>
                <div class="float-right">
                    <!-- add modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-add-modal-lg">Add Contributor</button>
                </div>
            </div>
            <div class="card-body">
                <!-- /.card-header -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
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
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                <a href="{{ route('UserAuditor.edit', $item->id ) }}" class="btn btn-success">Edit</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-delete-modal-lg{{$item->id}}">Delete</button>
                                {{-- <form action="{{ route('panel.contributor.destroy',$item->id) }}">
                                    <button class="btn btn-danger" onclick="return confirm('Apa anda yakin?')">Delete</button>
                                </form> --}}
                            <!-- add modal -->
                            <div class="modal fade bd-delete-modal-lg{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Contributor</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                            <div class="modal-body">
                                                <h5> Apakah anda yakin untuk menghapus {{$item->name}} ?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                {{-- <form method="post" action="{{ route('panel.contributor.destroy', $item->id ) }}" class="d-inline"> --}}
                                                    @method('delete') @csrf
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div><!-- /.card -->
    </div>

    <!-- add modal -->
    <div class="modal fade bd-add-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Contributor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <form method="post" action="{{ route('panel.contributor.store') }}" enctype="multipart/form-data"> --}}
                    <div class="modal-body">
                        @csrf
                        <div class="form-group row">
                            <label for="name_contributor" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name_contributor') is-invalid @enderror" id="name_contributor" name="name_contributor" onkeyup='saveValue(this);'>
                                @error('name_contributor')
                                <label class="col-form-label" for="name_contributor">
                                    {{-- {{ $message }} --}}
                                </label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email_contributor" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control @error('email_contributor') is-invalid @enderror" id="email_contributor" name="email_contributor" onkeyup='saveValue(this);'>
                                @error('email_contributor')
                                <label class="col-form-label" for="email_contributor">
                                    {{-- {{ $message }} --}}
                                </label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telephone_contributor" class="col-sm-2 col-form-label">No. Telp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('telephone_contributor') is-invalid @enderror" id="telephone_contributor" name="telephone_contributor" onkeyup='saveValue(this);'>
                                @error('telephone_contributor')
                                <label class="col-form-label" for="telephone_contributor">
                                    {{-- {{ $message }} --}}
                                </label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profile_contributor" class="col-sm-2 col-form-label">Profil</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="profile_contributor" name="profile_contributor" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profile_contributor" class="col-sm-2 col-form-label">Contributor Image</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image_contributor" name="image_contributor">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <img id="image_preview"  src="#" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

