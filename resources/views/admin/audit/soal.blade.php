@extends('admin.templates.main')
@section('title') Dashboard @endsection
@section('style')@endsection
@section('script')

@foreach ($soal as $item)
<script type="text/javascript">
    function persentase(diperiksa{{$loop->iteration}}, tdksesuai{{$loop->iteration}}, persen{{$loop->iteration}}) {
        var x = document.getElementById(diperiksa{{$loop->iteration}}).value;
        var y = document.getElementById(tdksesuai{{$loop->iteration}}).value;

        var hasil = (parseFloat(x) - parseFloat(y)) / parseFloat(x) * 100;
        // console.log(hasil);
        document.getElementById(persen{{$loop->iteration}}).value = hasil.toFixed(2);

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
    }
</script>
@endforeach

@endsection


@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Data {{ $title }}</h3>
                <div class="float-right">
                    {{-- <a href="/user/create/{{$role}}" class="btn btn-primary">Tambah {{ $title }}</a> --}}
                    <!-- add modal -->
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-add-modal-lg">Add Auditor</button> --}}
                </div>
            </div>
            <?php
            $act = '/SubmitSoal/{{$kategori}}';
            ?>
            @if($url == 'edit')             
            <?php  $act = "/SubmitSoal/{$kategori}/{$totalPersen['id']}";?>          
            @endif
            <form method="POST" action="{{$act}}" class="form-horizontal" enctype="multipart/form-data">
                @method("POST")
                @csrf
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        {{-- <div class="row">
                            <div class="col-sm-12 col-md-6">
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
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="tabelInput" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                                No
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                                Topik
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                                Diperiksa
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                                Tidak Sesuai
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                Kepatuhan(%)
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                                Keterangan
                                            </th>
                                        </tr>
                                    </thead>
                                            <?php
                                            $val = '';
                                            $status = 'disable';
                                            ?>
                                            @if($url == 'edit')             
                                            <?php  $val = "{$totalPersen['total_persentase']}";?>          
                                            <?php  $status = ' ';?>      
                                            @endif
                                        <tbody>
                                            <tr role="row" class="odd">
                                                <td colspan="6" style="background-color:yellow;">{{$data->kategori_soal}}</td>
                                            </tr>
                                            @foreach ($soal as $item)
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">{{$loop->iteration}}</td>
                                                    <td >{{$item->topik}}</td>
                                                    <td>
                                                        <input {{$status}} hidden type="number" class="form-control" name="id_nilai[{{$loop->iteration}}]" id="id_nilai{{$loop->iteration}}" value="{{$item->id_nilai}}">
                                                        <input hidden type="number" class="form-control" name="audit_id[{{$loop->iteration}}]" id="audit_id" value="{{$audit_id}}">
                                                        <input hidden type="number" class="form-control" name="soal_id[{{$loop->iteration}}]" id="soal_id{{$loop->iteration}}" value="{{$item->id_soal}}">

                                                        <input type="number" class="form-control diperiksa-input" name="diperiksa[{{$loop->iteration}}]" id="diperiksa{{$loop->iteration}}" onInput="persentase('diperiksa{{$loop->iteration}}', 'tdksesuai{{$loop->iteration}}', 'persen{{$loop->iteration}}')"  placeholder="jumlah diperiksa" value="{{$item->diperiksa}}">
                                                    </td>
                                                    <td >
                                                        <input type="number" class="form-control tdksesuai-input" name="tdksesuai[{{$loop->iteration}}]" id="tdksesuai{{$loop->iteration}}" onInput="persentase('diperiksa{{$loop->iteration}}', 'tdksesuai{{$loop->iteration}}', 'persen{{$loop->iteration}}')" placeholder="jumlah tidak sesuai" value="{{$item->tdksesuai}}">
                                                    </td>
                                                    <td >
                                                        <input readonly name="persentase[{{$loop->iteration}}]" id="persen{{$loop->iteration}}" value="{{$item->persentase}}" class="persentase-input" >
                                                    </td>
                                                    <td style="width: 20%">
                                                        <input type="text" value="{{$item->ket}}" class="form-control" name="keterangan[{{$loop->iteration}}]" id="keterangan{{$loop->iteration}}" placeholder="keterangan" >
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="4">Nilai Kepatuhan Rata-rata</th>
                                            {{-- <th rowspan="1" colspan="1"><input type="number" name="totalDiperiksa" id="totalDiperiksa" readonly value="0" class="total-diperiksa" /></th> --}}
                                            {{-- <th rowspan="1" colspan="1"><input type="number" name="totalTdksesuai" id="totalTdksesuai" readonly value="0" class="total-tdksesuai" /></th> --}}
                                            {{-- <th rowspan="1" colspan="2"><input value="{{$id_soal}}" type="number" id="id_nilaiKat" readonly value="0" class="total-persen" />%</th> --}}
                                            <th rowspan="1" colspan="2"><input value="{{$val}}" type="number" id="totalPersen" readonly value="0" class="total-persen" />%</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-dark" href="{{ url()->previous() }}">Back</a>
                    <button type="submit" class="btn btn-info float-right">Submit</button>
                </div>
            </form>
        </div><!-- /.card -->
    </div>


@endsection

