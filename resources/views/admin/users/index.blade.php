@extends('admin.templates.default')

@section('content')
<div class="box">
    <!-- <div class="box-header">
        <h3 class="box-title">List PIC</h3>
        <a href="{{route ('admin.users.create')}}" class="btn btn-primary">Tambah PIC</a><br><br>
    </div> -->
    <div class="box-body">

    <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="width:5%">Id</th>
                <th style="width:5%">Panggilan</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>E-mail</th>
                <th>Action</th>
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
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax    : '{{ route("admin.users.data")}}',
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                {data : 'panggilan'},
                {data : 'name'},
                {data : 'nip'},
                {data : 'jabatan'},
                {data : 'email'},
                {data : 'action'}
            ]
        });
    });
 </script>

@endpush