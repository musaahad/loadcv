@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Penilaian Internal</h3>
        <a href="{{route ('admin.internal.create')}}" class="btn btn-primary">Tambah Order Baru</a><br><br>
    </div>
    <div class="box-body">

    <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nama Debitur</th>
                <th>Bisnis Unit</th>
                <th>PIC 1</th>
                <th>PIC 2</th>
                <th>Jumlah Objek</th>
                <th>Tanggal Terima</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
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
            ajax    : '{{ route("admin.internal.data")}}',
            dom     : 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                {data : 'nama_debitur'},
                {data : 'BU'},
                {data : 'PIC'},
                {data : 'users_id1'},
                {data : 'jumlah_objek'},
                {data : 'tanggal_terima'},
                {data : 'tanggal_selesai'},
                {data : 'status'},
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

