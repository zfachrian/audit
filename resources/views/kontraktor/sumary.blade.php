@extends('admin.templates.main')
@section('title') Dashboard @endsection
@section('style')@endsection
@section('script')
@foreach ($data_kategori_collection as $item)
<script type="text/javascript">
    //total persen
    let persentaseCount = 0;
    let persentaseAmount = 0;
    let total = 0;
    $('.persentase-input').each(function(){
        persentaseCount++;
        persentaseAmount += parseFloat($(this).val());
    });

    total = persentaseAmount/persentaseCount;
    $('.total-persen').val(total);
</script>
@endforeach
@endsection


@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Data {{ $title }}</h3>
                <div class="float-right">
                    {{-- <a href="/user/create/{{$role}}" class="btn btn-dark">Back</a> --}}
                    <!-- add modal -->
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-add-modal-lg">Add Auditor</button> --}}
                </div>
            </div>
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        {{-- <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="example1_length">
                                <label>Show
                                    <select name="example1_length" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div id="example1_filter" class="dataTables_filter">
                                <label>Search:
                                    <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1">
                                </label>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="nilai" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                            No.
                                        </th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                            Daftar Periksa
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                            Diperiksa
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            Ketidaksesuaian
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Kepatuhan(%)
                                        </th>
                                    </tr>
                                </thead>

                                    <tbody>
                                        @foreach ($data_kategori_collection as $item)
                                            <tr role="row" class="odd">
                                                <td tabindex="0" class="sorting_1">{{ $loop->iteration }}</td>
                                                <td>{{$item['soal']}}</td>
                                                <td>{{$item['total_diperiksa']}}</td>
                                                <td>{{$item['total_tdksesuai']}}</td>
                                                <td id="hasil">
                                                    <input readonly name="persentase[{{$loop->iteration}}]" id="persen{{$loop->iteration}}" value="{{$item['total_persentase']}}" class="persentase-input" >
                                                    {{-- {{$item['total_persentase']}} --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="4">Nilai Kepatuhan Rata-rata</th>
                                        <th rowspan="1" colspan="2"><input type="number" id="totalPersen" readonly value="0" class="total-persen" />%</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-dark" href="{{ url()->previous() }}">Back</a>
                {{-- <button type="submit" class="btn btn-info float-right">Submit</button> --}}
            </div>
        </div><!-- /.card -->
    </div>


@endsection

