@extends('frontend.templates.default')

@section('content')


<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:left;"><b>Database Penilaian Internal</b></h5>  
    </div>
    <div class="box-body">
    
    <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Debitur</th>
                <th>Tgl. Penilaian</th>
                <th>PIC</th>
                <th>Alamat</th>
                <th>Kel.</th>
                <th>Jenis Objek</th>
                <th>LT</th>
                <th>LB</th>
                <th>Nilai Pasar</th>
                <th>Np/m2</th>
                <th>Koordinat</th>
                <th></th>
            </tr>
        </thead>
      
    </table><br>
     
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
            ajax    : '{{ route("kerjainternal.database")}}',
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                {data : 'nama_debitur'},
                {data : 'tanggal_penilaian'},
                {data : 'PIC'},
                {data : 'alamat'},
                {data : 'villages'},
                {data : 'peruntukan'},
                {data : 'luas_tanah'},
                {data : 'luas_bangunan'},
                {data : 'NP Total'},
                {data : 'Np/m2'},
                {data : 'koordinat'},
                {data : 'action'}
            ], 
        });
    });
</script>

@endpush




