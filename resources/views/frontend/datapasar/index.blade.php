@extends('frontend.templates.default')

@section('content')


<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:left;"><b>Data Pembanding</b></h5>  
    </div>
    <div class="box-body">
    
    <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <!-- <th>Nama Debitur</th>
                <th>PIC</th> -->
                <th>Tgl. Data</th>
                <th>Alamat</th>
                <th>Kel.</th>
                
                <th>Jenis Objek</th>
                <th>Legalitas</th>
                <th>LT</th>
                <th>LB</th>
                <th>Penjual</th>
                <th>No. Telp</th>
                <th>Harga Penawaran</th>
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
            ajax    : '{{ route("datapasar.dataall")}}',
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                // {data : 'nama_debitur'},
                // {data : 'PIC'},
                {data : 'tanggal_data'},
                {data : 'alamat1'},
                {data : 'villages1'},
               
                {data : 'peruntukan1'},
                {data : 'legalitas1'},
                {data : 'luas_tanah1'},
                {data : 'luas_bangunan1'},
                {data : 'penjual'},
                {data : 'notelp'},
                {data : 'harga_penawaran'},
                {data : 'action'},
            ], 
        });
    });
</script>

@endpush




