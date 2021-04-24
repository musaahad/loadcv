@extends('frontend.templates.default')

@section('content')


<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:left;"><b>Daftar Mesin & SPL Objek {{$kerjainternals->first()->nama_debitur}}</b></h5>  
    </div>

     <!-- Modal Trigger -->
     <a class="waves-effect waves-light btn modal-trigger red darken-3" href="#modal1">
    <i class="material-icons right">whatshot</i>pencet saya dulu</a><br><br>

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Petunjuk Pengisian Untuk Menu Edit Data Mesin/SPL</h4>
            <ol>
                <li>Pilih alamat objek yang ingin dilengkapi data mesin/SPL.</li>
                <li>Jumlah data sesuai dengan jumlah mesin/SPL di objek tersebut.</li>
                <li>Untuk invoice hanya diisi di salah satu mesin/SPL saja ya, jika invoice tsb untuk semua mesin di objek tersebut.</li>
                <li>Selamat bekerja...</li>
            </ol>
        </div>
    <div class="modal-footer">
        <a href="#" class="modal-close waves-effect waves-green btn-flat">Saya mengerti</a>
    </div>
    </div>


    <div class="row">
        <div class="col s5">
            <form action="{{route ('mesinspl.create')}}" method="POST">
                @csrf
                <label>Pilih (alamat) objek</label>
                <select name="alamat"  class="browser-default">
                    @foreach ($kerjainternals as $kerjainternal)
                     <option value="{{$kerjainternal->alamat }}">Alamat di {{$kerjainternal->alamat}} dengan jenis objek {{$kerjainternal->peruntukan}}</option>
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
                <th>Nama Mesin/SPL</th>
                <th>Spesifikasi</th>
                <th></th>
                <th>NP Mesin/SPL</th>
                <th>NL Mesin/SPL</th>
                <th>Kondisi</th>
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
        $('#dataTable').DataTable({      //# artinya id. yg dipanggil adalah id=dataTable diatas. dgn fungsi DataTable
            processing: true,               //selanjutnya dipassing objek yg akan diproses
            serverSide: true,
            ajax    : '{{ route("mesinspl.datainternal")}}',
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                {data : 'alamat'},
                {data : 'villages'},
                {data : 'nama_mesin'},
                {data : 'spesifikasi'},
                {data : 'satuan'},
                {data : 'npm1'},
                {data : 'nlm1'},
                {data : 'kondisi_spl'},
                {data : 'action'},
            ], 
        });
    });
</script>

@endpush




