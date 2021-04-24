@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Review LPA</h3>
        <a href="{{route ('admin.reviews.create')}}" class="btn btn-primary">Tambah Order Baru</a><br><br>
    </div>
    <div class="box-body">

    <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th >Id</th>
                <th>Nama Debitur</th>
                <th>KJPP</th>
                <th>Bisnis Unit</th>
                <th>PIC</th>
                <th>Jumlah Objek</th>
                <th>Tanggal Terima</th>
                <th>Status</th>
                <th>Tanggal Selesai</th>
                <th>Target TaT</th>
                <th>TaT Aktual</th>
                <th>Sisa TaT</th>
                <th>Keterangan</th>
                <th>Aksi</th>
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
            ajax    : '{{ route("admin.reviews.data")}}',
            dom     : 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                {data : 'nama_debitur'},
                {data : 'kjpp'},
                {data : 'BU'},
                {data : 'PIC'},
                {data : 'jumlah_objek'},
                {data : 'tanggal_terima'},
                {data : 'status'},
                {data : 'tanggal_selesai'},
                {data : 'Target TaT'},
                {data : 'TaT Aktual'},
                {data : 'Sisa TaT'},
                {data : 'keterangan'},
                {data : 'action'},
            ], 
        });
    });
 </script>

@endpush

