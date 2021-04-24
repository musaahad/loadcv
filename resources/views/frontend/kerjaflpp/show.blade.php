@extends('frontend.templates.default')

@section('content')

<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:left;"><b>Objek Inspeksi FLPP an {{$kerjaflpps->first()->nama_debitur}}.</b></h5><br>  
    </div>



    <div class="box-body">
    <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Debitur</th>
                <th>Bisnis Unit</th>
                <th>Perumahan</th>
                <th>Legalitas</th>
                <th>No. Sertifikat</th>
                <th>Luas Tanah</th>
                <th>Luas Bangunan</th>
                <th>Aksi</th>
     
            </tr>
        </thead>
        </table><br>    

            <a href="{{route ('kerjaflpp.laporan')}}" class="btn deep-purple darken-4 left waves-effect">
            <i class="material-icons right">get_app</i>Download Laporan</a>   
       
        
        
    </div>
 
    
</div>

<form action="" method="POST" id="deleteForm">
    @csrf
    @method("DELETE")
    <input type="submit" value="Hapus" style="display:none">
</form>

@endsection

@push('scripts')
<script>
    $(function () {
        $('#dataTable').DataTable({      //# artinya id. yg dipanggil adalah id=dataTable diatas. dgn fungsi DataTable
            processing: true,               //selanjutnya dipassing objek yg akan diproses
            serverSide: true,
            ajax    : '{{ route("kerjaflpp.data")}}',
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                {data : 'nama_debitur'},
                {data : 'bu'},
                {data : 'perumahan'},
                {data : 'legalitas'},
                {data : 'no_sertifikat'},
                {data : 'luas_tanah'},
                {data : 'luas_bangunan'},
                {data : 'action'},
            ], 
        });
    });


</script>

@endpush





