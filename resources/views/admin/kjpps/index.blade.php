@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">List KJPP</h3>
        <a href="{{route ('admin.kjpps.create')}}" class="btn btn-primary">Tambah KJPP</a><br><br>
    </div>
    <div class="box-body">
    
    

    <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Pimpinan</th>
                <th>No. MAPPI</th>
                <th>Ijin Publik</th>
                <th>Klasifikasi</th>
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
            ajax    : '{{ route("admin.kjpps.data")}}',
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                {data : 'name'},
                {data : 'pimpinan'},
                {data : 'nomappi'},
                {data : 'ijinpublik'},
                {data : 'klasifikasi'},
                {data : 'action'}
            ]
        });
    });
 </script>

@endpush