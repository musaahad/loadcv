@extends('frontend.templates.default')

@section('content')

<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:left;"><b>Daftar Objek Penilaian Internal an {{$kerjainternals->first()->nama_debitur}}. Ada {{$kerjainternals->first()->jumlah_objek}} objek ya...</b></h5><br>  
    </div>

    <!-- Modal Trigger -->
    <a class="waves-effect waves-light btn modal-trigger red darken-3" href="#modal1">
    <i class="material-icons right">whatshot</i>pencet saya dulu</a><br><br>

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Petunjuk Pengisian Untuk Menu Edit Objek</h4>
            <ol>
                <li>Setelah tambah objek, silahkan lengkapi data objek tersebut dengan klik tombol edit disamping kanan objek.</li>
                <li>Nilai yang diisi adalah nilai pasar dan nilai likuidasi objek tersebut (tanah+bangunan+mesin/SPL). Untuk rincian 
                nilai bangunan/mesin/SPL dapat dilakukan di menu tanah/bangunan/mesin&SPL.</li>
                <li>Nilai pasar/m2 yang diinput adalah nilai pasar/m2 tanah atau ruko (nilai pasar dibagi luas bangunan).</li>
                <li>Objek dibedakan berdasarkan alamat sehingga jika ada objek yang alamatnya sama (karena tidak ada nomor bangunan)
                   maka, mohon dapat ditambahkan karakter pembeda dengan tanda kurung. Contoh : Jalan Ratulangi (A), Jalan Ratulangi (B).</li>
                <li>Setelah melengkapi/edit data objek, silahkan masuk ke menu tanah, bangunan dan mesin/SPL(jika ada) untuk rincian data objek tersebut</li>
                <li>Terakhir jangan lupa input data pembanding dimana jumlah data yang harus diinput yaitu 3 data untuk masing-masing objek.</li>
                <li>Checklist, Laporan dan Kertas kerja hanya bisa didownload setelah menu tanah & data pembanding diinput.</li>
                <li>Selamat bekerja...</li>
            </ol>
        </div>
    <div class="modal-footer">
        <a href="#" class="modal-close waves-effect waves-green btn-flat">Saya mengerti</a>
    </div>
    </div>

    
    <div class="row"> 
            <form action="{{route ('kerjainternal.tambah')}}" method="POST">
                    @csrf
                <button class="btn pink darken-4 left waves-effect" type="submit">
                    Tambah Objek 
                    <i class="material-icons right">add_circle</i>
                </button>
            </form> 
            <a href="{{route ('tanah.showinternal')}}" class="btn grey darken-3 left waves-effect waves-light">
            <i class="material-icons right">report</i>Lengkapi Data Tanah</a>

            <a href="{{route ('bangunan.showinternal')}}" class="btn light-blue darken-4 left waves-effect waves-light">
            <i class="material-icons right">report</i>Lengkapi Data Bangunan</a>

            <a href="{{route ('mesinspl.showinternal')}}" class="btn teal accent-4 left waves-effect waves-light">
            <i class="material-icons right">report</i>Lengkapi Data Mesin & SPL</a>

            <a href="{{route ('datapasar.showinternal')}}" class="btn green darken-4 left waves-effect waves-light">
            <i class="material-icons right">input</i>Input Data Pembanding</a>
    </div>


    <div class="box-body">
    <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Objek</th>
                <th>Alamat</th>
                <th>Kelurahan</th>
                <th>Luas Tanah</th>
                <th>Luas Bangunan</th>
                <th>NP Total</th>
                <th>Np/m2</th>
                <th>NL Total</th>
                
                <th>Aksi</th>
     
            </tr>
        </thead>
        </table><br> 

            <a href="{{route ('kerjareview.checklist')}}" class="btn pink lighten-1 left waves-effect">
            <i class="material-icons right">get_app</i>Download Checklist</a>   

            <a href="{{route ('kerjainternal.laporan')}}" class="btn deep-purple darken-4 left waves-effect">
            <i class="material-icons right">get_app</i>Download Laporan</a>   
       
            <a href="{{route ('kerjareview.workform')}}" class="btn deep-orange darken-4 left waves-effect waves-light">
            <i class="material-icons right">get_app</i>Download Kertas Kerja</a>
        
        
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
            ajax    : '{{ route("kerjainternal.data")}}',
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                {data : 'peruntukan'},
                {data : 'alamat'},
                {data : 'villages'},
                {data : 'luas_tanah'},
                {data : 'luas_bangunan'},
                {data : 'NP Total'},
                {data : 'Np/m2'},
                {data : 'NL Total'},
                {data : 'action'},
            ], 
        });
    });


</script>

@endpush





