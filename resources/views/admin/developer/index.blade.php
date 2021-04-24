@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">List Developer</h3>
        <a href="{{route ('admin.developer.create')}}" class="btn btn-primary">Tambah Developer</a><br><br>
    </div>
    <div class="box-body">

    <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="width:5%">Id</th>
                <th>Name</th>
                <th>Tiering</th>
                <th>Projek/Perumahan</th>
                <th>Alamat</th>
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
            ajax    : '{{ route("admin.developer.data")}}',
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                {data : 'name'},
                {data : 'tiering'},
                {data : 'projek'},
                {data : 'lokasi'},
                {data : 'action'}
            ]
        });
    });
 </script>

@endpush