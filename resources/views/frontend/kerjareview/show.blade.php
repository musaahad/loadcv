@extends('frontend.templates.default')

@section('content')

<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:left;"><b>Daftar Objek Review LPA an {{$kerjareviews->first()->nama_debitur}}. Ada {{$kerjareviews->first()->jumlah_objek}} objek ya...</b></h5><br>  
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
            <form action="{{route ('kerjareview.tambah')}}" method="POST">
                    @csrf
                <button class="btn pink darken-4 left waves-effect" type="submit">
                    Tambah Objek 
                    <i class="material-icons right">add_circle</i>
                </button>
            </form> 
            <a href="{{route ('tanah.show')}}" class="btn grey darken-3 left waves-effect waves-light">
            <i class="material-icons right">report</i>Lengkapi Data Tanah</a>

            <a href="{{route ('bangunan.show')}}" class="btn light-blue darken-4 left waves-effect waves-light">
            <i class="material-icons right">report</i>Lengkapi Data Bangunan</a>

            <a href="{{route ('mesinspl.show')}}" class="btn teal accent-4 left waves-effect waves-light">
            <i class="material-icons right">report</i>Lengkapi Data Mesin & SPL</a>

            <a href="{{route ('datapasar.show')}}" class="btn green darken-4 left waves-effect waves-light">
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
                <th>NP Total</th>
                <th>Np/m2</th>
                <th>NL Total</th>
                
                <th>Aksi</th>
     
            </tr>
        </thead>
        </table><br> 

            <a href="{{route ('kerjareview.checklist')}}" class="btn pink lighten-1 left waves-effect">
            <i class="material-icons right">get_app</i>Download Checklist</a>   

            <a href="{{route ('kerjareview.laporan')}}" class="btn deep-purple darken-4 left waves-effect">
            <i class="material-icons right">get_app</i>Download Laporan</a>   
       
            <a href="{{route ('kerjareview.workform')}}" class="btn deep-orange darken-4 left waves-effect waves-light">
            <i class="material-icons right">get_app</i>Download Kertas Kerja</a>

     <!--  
        @foreach ($kerjareviews as $kerjareview)    
        <tbody>
            <tr>
           
                <td>{{$loop->iteration}}</td>
                <td>{{$kerjareview->peruntukan}}</td>
                <td>{{$kerjareview->alamat}}</td>
                <td>{{$kerjareview->luas_tanah}}</td>
                <td>{{$kerjareview->luas_bangunan}}</td>
                <td>{{$kerjareview->nilai_pasar}}</td>
                <td>{{$kerjareview->nilai_likuidasi}}</td>
                <td>{{$kerjareview->koordinat}}</td>
                <td>
                    <a href="{{route ('kerjareview.edit', $kerjareview)}}" class="btn light-blue darken-1"><i class="material-icons">edit</i></a>
                </td>
                <td>
                <form action="{{ route('kerjareview.destroy', $kerjareview)}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="btn red accent-4 waves-effect waves-solid"
                        onclick="return confirm('Yakin hapus data ini?')">
                        <i class="material-icons">delete_forever</i>
                    </button> 
                </form>
                </td>
               
            </tr>
        </tbody>
        
        @endforeach---->
        
       
        
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
            ajax    : '{{ route("kerjareview.data")}}',
            columns : [
                {data : 'DT_RowIndex', orderable:false, searchable : false},
                {data : 'peruntukan'},
                {data : 'alamat'},
                {data : 'villages'},
                {data : 'NP Total'},
                {data : 'Np/m2'},
                {data : 'NL Total'},
                {data : 'action'},
            ], 
        });
    });

   
    $(document).ready(function(){
            $('#imb').on('change', function(){
                if (this.value == "Ya") {
                    $('#tgl_imb, #no_imb').show()
                }
            })
        });
   
    

    $(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $('#province').on('change', function() {
        $.ajax({
            url: '{{ route("kerjareview.city") }}',
            method: 'POST',
            data: {id: $(this).val()},
            success: function (response) {
                $('#city').empty();
                    console.log(response);
                $.each(response, function (id, nama) {
                  
                    $('#city').append(new Option(nama, id))
                })
            }
        })
    });
});

$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $('#city').on('change', function() {
        $.ajax({
            url: '{{ route("kerjareview.districs") }}',
            method: 'POST',
            data: {id: $(this).val()},
            success: function (response) {
                $('#districs').empty();
                    console.log(response);
                $.each(response, function (id, nama) {
                    $('#districs').append(new Option(nama, id))
                })
            }
        })
    });
});

$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $('#districs').on('change', function() {
        $.ajax({
            url: '{{ route("kerjareview.villages") }}',
            method: 'POST',
            data: {id: $(this).val()},
            success: function (response) {
                $('#villages').empty();
                    console.log(response);
                $.each(response, function (id, nama) {
                    $('#villages').append(new Option(nama, id))
                })
            }
        })
    });
});



</script>
<!--<script>
$(document).ready(function(){
    $('.modal').modal();
  });


$(document).ready(function(){
     $('.datepicker').datepicker();
  });
</script>--->
@endpush





