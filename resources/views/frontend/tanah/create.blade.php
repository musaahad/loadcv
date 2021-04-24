@extends('frontend.templates.default')

@section('content')

<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:center; color:dark-blue"><b>Legalitas tanah objek ({{$tanah->kerjareviews->peruntukan}}) lokasi di {{$tanah->kerjareviews->alamat}}</b></h5><br>
       
    </div>
</div>
   <div class="box-body">
    <form action="{{ route('tanah.update', $tanah)}}" method="POST">
        @csrf
        @method("PUT")
        <div class="row">   
             
            <div class="input-field col s12">
                <input disabled value="{{number_format($tanah->kerjareviews->npt)}}" id="disabled"
                type="text" class="validate">
                <label for="disabled">Nilai Pasar Objek</label>
            </div>

            <div class="input-field col s12">
                <input disabled value="{{number_format($tanah->kerjareviews->nlt)}}" id="disabled"
                type="text" class="validate">
                <label for="disabled">Nilai Likuidasi Objek</label>
            </div>

            <div class="input-field col s12">
                <select name="jenis" id="jenis" >
                    <option value="{{$tanah->jenis?? old('jenis')}}" selected>{{$tanah->jenis}}</option>  
                    <option value="SHM">SHM</option>
                    <option value="SHGB">SHGB</option>
                    <option value="SHMASRS">SHMASRS</option>
                    <option value="SHGU">SHGU</option>
                </select>
                <label for="icon_prefix">Jenis Sertifikat</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="no_sertifikat" class="form-control" 
                placeholder="Masukkan Nomor Sertifikat" value="{{$tanah->no_sertifikat ?? old('no_sertifikat')}}">
                <label for="icon_prefix">Nomor Sertifikat</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="tanggal_terbit" class="datepicker" 
                value="{{$tanah->tanggal_terbit ?? old('tanggal_terbit')}}">
                <label for="icon_prefix">Tanggal Terbit</label>
            </div>

            <div class="input-field col s12" style="display:none" id="tanggal_berakhir">
                <input type="text" name="tanggal_berakhir" class="datepicker" 
                value="{{$tanah->tanggal_berakhir ?? old('tanggal_berakhir')}}">
                <label for="icon_prefix">Tanggal Berakhir</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="no_gs" class="form-control" 
                placeholder="Masukkan Nomor GS/SU" value="{{$tanah->no_gs ?? old('no_gs')}}">
                <label for="icon_prefix">Nomor GS/SU</label>
            </div>       

            <div class="input-field col s12">
                <input type="text" name="tgl_gs" class="datepicker" 
                value="{{$tanah->tgl_gs ?? old('tgl_gs')}}">
                <label for="icon_prefix">Tanggal GS/SU</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="atas_nama1" class="form-control" 
                placeholder="Masukkan Nama Pemilik" value="{{$tanah->atas_nama1 ?? old('atas_nama1')}}">
                <label for="icon_prefix">Nama Pemilik</label>
            </div>

            <div class="input-field col s12">
                <input type="number" name="luas_tanah2" class="form-control" 
                placeholder="Luas Tanah (m2)" value="{{$tanah->luas_tanah2 ?? old('luas_tanah2')}}">
                <label for="icon_prefix">Luas Tanah</label>
            </div>

            <div class="input-field col s12" id="npt1">
                <input type="text"  onkeydown="return numbersonly(this, event);" 
                onkeyup="javascript:tandaPemisahTitik(this);" name="npt1"  class="form-control" 
                placeholder="Nilai Pasar Tanah" value="{{$tanah->npt1 ?? old('npt1')}}">
                <label for="icon_prefix">Nilai Pasar Tanah</label>
            </div>

            <div class="input-field col s12" id="nlt1">
                <input type="text"  onkeydown="return numbersonly(this, event);" 
                onkeyup="javascript:tandaPemisahTitik(this);" name="nlt1"  class="form-control" 
                placeholder="Nilai Likuidasi Tanah" value="{{$tanah->nlt1 ?? old('nlt1')}}">
                <label for="icon_prefix">Nilai Likuidasi Tanah</label>
            </div>

            <div class="input-field col s12">
                <textarea name="catatan"  id="textarea1" class="materialize-textarea"
                placeholder="Tuliskan catatan">{{$tanah->catatan ?? old('catatan')}}</textarea>
                <label for="icon_prefix">Catatan Khusus Untuk Tanah</label>
            </div>

            <div class="col s12">
            <button class="btn waves-effect waves-light right" type="submit" name="action">Simpan
                <i class="material-icons right">save</i>
            </button>
            </div>
        </div>
    </form>
    </div>

  
@endsection

@push('scripts')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
 
        $(document).ready(function(){
            $('#jenis').on('change', function(){
                if (this.value == "SHGB") {
                    $('#tanggal_berakhir').show()
                }
                if (this.value == "SHGU") {
                    $('#tanggal_berakhir').show()
                }
                if (this.value == "SHMASRS") {
                    $('#tanggal_berakhir').show()
                }
            })
        });
       
    </script> 

<script>
 
 $(document).ready(function(){
     $('#peruntukan').on('change', function(){
         if (this.value == "Ruko") {
             $('#npt1,#nlt1').hide()
         }
         if (this.value == "Kios") {
             $('#npt1,#nlt1').hide()
         }
     })
 });

</script> 
   <script>
    $(document).ready(function(){
     $('.datepicker').datepicker({
        
     });
    });
    </script>
@endpush

@push('select2css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

