@extends('frontend.templates.default')

@section('content')


<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:left;"><b>Rincian legalitas tanah objek {{$kerjainternals->first()->nama_debitur}}</b></h5>  
    </div>

    <!-- Modal Trigger -->
    <a class="waves-effect waves-light btn modal-trigger red darken-3" href="#modal1">
    <i class="material-icons right">whatshot</i>pencet saya dulu</a><br><br>

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Petunjuk Pengisian Untuk Menu Edit Data Tanah</h4>
            <ol>
                <li>Pilih alamat objek yang ingin dilengkapi data tanahnya.</li>
                <li>Jumlah data sesuai dengan jumlah sertifikat di objek tersebut.</li>
                <li>Untuk objek yang terdiri dari beberapa sertifikat, nilai pasar dan nilai likuidasi yang diisi <b>hanya</b> disalah
                satu sertifikat saja. Yang lainnya silahkan kosongkan saja.</li>
                <li><b>Untuk ruko atau kios, nilai pasar dan nilai likuidasi diisi di menu bangunan ya, jangan di menu ini.</b>.</li>
                <li>Selamat bekerja...</li>
            </ol>
        </div>
    <div class="modal-footer">
        <a href="#" class="modal-close waves-effect waves-green btn-flat">Saya mengerti</a>
    </div>
    </div>

    <div class="row"> 

            <a href="{{route ('bangunan.show')}}" class="btn light-blue darken-4 left waves-effect waves-light">
            <i class="material-icons right">report</i>Data Bangunan</a>

            <a href="{{route ('mesinspl.show')}}" class="btn teal accent-4 left waves-effect waves-light">
            <i class="material-icons right">report</i>Data Mesin & SPL</a>

            <a href="{{route ('datapasar.show')}}" class="btn green darken-4 left waves-effect waves-light">
            <i class="material-icons right">input</i>Data Pembanding</a>
    </div>

    <div class="row">
        <div class="col s5">
            <form action="{{route ('tanah.create')}}" method="POST">
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
                <th>Alamat</th>
                <th>Kel.</th>
                <th>Jenis</th>
                <th>No. Sertifikat</th>
                <th>Tgl Terbit</th>
                <th>Tgl Berakhir</th>
                <th>NPT</th>
                <th>NLT</th>
                <th>Pemilik</th>
                <th>Luas Tanah</th>                
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
            ajax    : '{{ route("tanah.datainternal")}}',
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                {data : 'alamat'},
                {data : 'villages'},
                {data : 'jenis'},
                {data : 'no_sertifikat'},
                {data : 'tanggal_terbit'},
                {data : 'tanggal_berakhir'},
                {data : 'npt1'},
                {data : 'nlt1'},
                {data : 'atas_nama1'},
                {data : 'luas_tanah2'},
                {data : 'action'},
            ], 
        });
    });
</script>

@endpush




