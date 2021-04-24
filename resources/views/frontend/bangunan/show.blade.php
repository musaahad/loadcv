@extends('frontend.templates.default')

@section('content')


<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:left;"><b>Daftar Bangunan Objek {{$kerjareviews->first()->nama_debitur}}</b></h5>  
    </div>

    <!-- Modal Trigger -->
    <a class="waves-effect waves-light btn modal-trigger red darken-3" href="#modal1">
    <i class="material-icons right">whatshot</i>pencet saya dulu</a><br><br>

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Petunjuk Pengisian Untuk Menu Edit Data Bangunan</h4>
            <ol>
                <li>Pilih alamat objek yang ingin dilengkapi data bangunannya.</li>
                <li>Jumlah data sesuai dengan jumlah bangunan di objek tersebut.</li>
                <li>Untuk IMB hanya diisi di salah satu bangunan saja ya, jika IMB tsb untuk semua banguan di lahan tersebut.</li>
                <li><b>Untuk ruko atau kios, nilai pasar dan nilai likuidasi diisi di menu ini ya, jangan di menu tanah.</b>.</li>
                <li>Selamat bekerja...</li>
            </ol>
        </div>
    <div class="modal-footer">
        <a href="#" class="modal-close waves-effect waves-green btn-flat">Saya mengerti</a>
    </div>
    </div>

    <div class="row">
        <div class="col s5">
            <form action="{{route ('bangunan.create')}}" method="POST">
                @csrf
                <label>Pilih (alamat) objek</label>
                <select name="alamat"  class="browser-default">
                    @foreach ($kerjareviews as $kerjareview)
                     <option value="{{$kerjareview->alamat }}">Alamat di {{$kerjareview->alamat}} dengan jenis objek {{$kerjareview->peruntukan}} </option>
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
                <th>Nama Bangunan</th>
                <th>No. IMB</th>
                <th>LB</th>
                <th>NP Bangunan</th>
                <th>NL Bangunan</th>
                <th>Kondisi</th>
                <th style="text-align:center;">Aksi</th>
            </tr>
        </thead>
    </table><br>
     
    </div>
 

    <div class="col s4">
            <a href="{{route ('kerjareview.show')}}"class="btn green darken-4 waves-effect waves-solid">
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
            ajax    : '{{ route("bangunan.data")}}',
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                {data : 'alamat'},
                {data : 'villages'},
                {data : 'nama'},
                {data : 'no_imb'},
                {data : 'luas_bangunan2'},
                {data : 'npb1'},
                {data : 'nlb1'},
                {data : 'kondisi_bangunan'},
                {data : 'action'},
            ], 
        });
    });
</script>

@endpush




