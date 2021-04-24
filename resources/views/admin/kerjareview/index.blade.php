@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Review LPA On Progress</h3>
    </div>
    <div class="box-body">

    <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th >Id</th>
                <th>Nama Debitur</th>
                <th>PIC</th>
                <th>BU</th>
                <th>Tanggal Terima</th>
                <th>Mulai Kerja</th>
            </tr>
        </thead>
    </table>
    </div>
</div>

<form action="" method="POST" id="deleteForm">
    @csrf
    @method("DELETE")
    <input type="submit" value="Hapus" style="display:none">
</form>

@endsection


@push('scripts')
<script src="{{asset ('assets/plugins/bs-notify.min.js')}}"></script>
@include('admin.templates.partials.alerts')
<script>
    $(function () {
        $('#dataTable').DataTable({      //# artinya id. yg dipanggil adalah id=dataTable diatas. dgn fungsi DataTable
            processing: true,               //selanjutnya dipassing objek yg akan diproses
            serverSide: true,
            ajax    : '{{ route("admin.kerjareview.data")}}',
            dom     : 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                {data : 'Nama Debitur'},
                {data : 'PIC'},
                {data : 'BU'},
                {data : 'Tanggal Order'},
                {data : 'Mulai Kerja'},
            ], 
        });
    });
 </script>

@endpush

