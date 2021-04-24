@extends('frontend.templates.default')

@section('content')


<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:left;"><b>Data Pembanding Objek {{$kerjainternals->first()->nama_debitur}}</b></h5>  
       
    
    </div>
    <div class="row">
        <div class="col s3">
            <form action="{{route ('datapasar.create')}}" method="POST">
                @csrf
                <label>Pilih (alamat) objek</label>
                <select name="alamat"  class="browser-default">
                    @foreach ($kerjainternals as $kerjainternal)
                     <option value="{{$kerjainternal->alamat }}">{{$kerjainternal->alamat}}</option>
                    @endforeach
                </select> 
                <button class="btn indigo darken-4 waves-effect waves-solid" type="submit">
                    Tambah Data 
                    <i class="material-icons right">add_circle</i>
                </button> 
            </form>
        </div>    
    </div> 
    <div class="box-body">
    
    <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Alamat(objek)</th>
                <th>Kel.(objek)</th>
                <th >Alamat</th>
                <th>Kel.</th>
                <th>Jenis Objek</th>
                <th>Legalitas</th>
                <th>LT</th>
                <th>LB</th>
                <th>Penjual</th>
                <th>Harga Penawaran</th>
                <th style="text-align:center;">Foto</th>
                
                <th style="text-align:center;">Aksi</th>
            </tr>
        </thead>
      
    </table><br>
     
    </div>
 

    <div class="col s4">
            <a href="{{route ('kerjainternal.show')}}"class="btn green darken-4 waves-effect waves-solid">
                <i class="material-icons left">keyboard_return</i>Kembali ke hal tambah objek
            </a>    
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
        $('#dataTable').DataTable({ 
            
            
            processing: true,               
            serverSide: true,
            ajax    : '{{ route("datapasar.datainternal")}}',
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                {data : 'alamat'},
                {data : 'villages'},
                {data : 'alamat1'},
                {data : 'villages1'},
                {data : 'peruntukan1'},
                {data : 'legalitas1'},
                {data : 'luas_tanah1'},
                {data : 'luas_bangunan1'},
                {data : 'penjual'},
                {data : 'harga_penawaran'},
                {data : 'gambar'},
                {data : 'action'},
            ], 
        });
    });
</script>

@endpush




