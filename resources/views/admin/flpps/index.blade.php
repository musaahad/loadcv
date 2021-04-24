@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Inspeksi FLPP</h3>
        <a href="{{route ('admin.flpps.create')}}" class="btn btn-primary">Tambah Order Baru</a><br><br>
    </div>
    <div class="box-body">

    <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th >Id</th>
                <th>Nama Debitur</th>
                <th>Bisnis Unit</th>
                <th>Developer</th>
                <th>Perumahan</th>
                <th>PIC</th>
                <th>Tanggal Terima</th>
                <th>Status</th>
                <th>Tanggal Selesai</th>
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
            ajax    : '{{ route("admin.flpps.data")}}',
            dom     : 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                {data : 'nama_debitur'},
                {data : 'BU'},
                {data : 'developer'},
                {data : 'perumahan'},
                {data : 'PIC'},
                {data : 'Tanggal Terima'},
                {data : 'status'},
                {data : 'Tanggal Selesai'},
                {data : 'keterangan'},
                {data : 'action'},
            ], 
        });
    });
 </script>

@endpush

