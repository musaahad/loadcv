@extends('frontend.templates.default')

@section('content')

<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:center; color:dark-blue"><b>Data bangunan objek ({{$bangunan->kerjareviews->peruntukan}}) lokasi di {{$bangunan->kerjareviews->alamat}}</b></h5><br>
    </div>
</div>
   <div class="box-body">
    <form action="{{ route('bangunan.update', $bangunan)}}" method="POST">
        @csrf
        @method("PUT")
        <div class="row">   
 
            <div class="input-field col s12">
                <input disabled value="{{number_format($bangunan->kerjareviews->npt)}}" id="disabled"
                type="text" class="validate">
                <label for="disabled">Nilai Pasar Objek</label>
            </div>

            <div class="input-field col s12">
                <input disabled value="{{number_format($bangunan->kerjareviews->nlt)}}" id="disabled"
                type="text" class="validate">
                <label for="disabled">Nilai Likuidasi Objek</label>
            </div>
          
            <div class="input-field col s12">
                <input type="text" name="nama" class="form-control" 
                placeholder="Masukkan Nama Bangunan" value="{{$bangunan->nama ?? old('nama')}}">
                <label for="">Nama Bangunan</label>
            </div>

            <div class="input-field col s12">
                <input type="number" name="luas_bangunan2" class="form-control" 
                placeholder="Input Luas Bangunan (m2)" value="{{$bangunan->luas_bangunan2 ?? old('luas_bangunan2')}}">
                <label for="">Luas Bangunan</label>
            </div>

            <div class="input-field col s12">
                <select id="imb" class="form-control">
                    <option value=""></option>  
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
                <label for="">Ada IMB ??</label>
            </div>

            <div class="input-field col s12"  style="display:none" id="no_imb">
                <input type="text" name="no_imb" class="form-control" 
                placeholder="Nomor IMB" value="{{$bangunan->no_imb ?? old('no_imb')}}">
                <label for="">Nomor IMB</label>
            </div>

            <div class="input-field col s12"style="display:none" id="tgl_imb">
                <input type="text" name="tgl_imb" class="datepicker" 
                value="{{$bangunan->tgl_imb ?? old('tgl_imb')}}">
                <label for="icon_prefix">Tanggal IMB</label>
            </div>

            <div class="input-field col s12">
                <input type="text"  onkeydown="return numbersonly(this, event);" 
                onkeyup="javascript:tandaPemisahTitik(this);" name="npb1" class="form-control" 
                placeholder="Nilai Pasar Bangunan" value="{{$bangunan->npb1 ?? old('npb1')}}">
                <label for="">Nilai Pasar Bangunan</label>
            </div>

            <div class="input-field col s12">
                <input type="text"  onkeydown="return numbersonly(this, event);" 
                onkeyup="javascript:tandaPemisahTitik(this);" name="nlb1" class="form-control" 
                placeholder="Nilai Likuidasi Bangunan" value="{{$bangunan->nlb1 ?? old('nlb1')}}">
                <label for="">Nilai Likuidasi Bangunan</label>
            </div>

            <div class="input-field col s12">
                <select name="kondisi_bangunan" class="form-control">
                    <option value="{{$bangunan->kondisi_bangunan?? old('kondisi_bangunan')}}" selected>{{$bangunan->kondisi_bangunan}}</option>  
                    <option value="On Progress">On Progress</option>
                    <option value="Mangkrak">Mangkrak</option>
                    <option value="Baru">Baru</option>
                    <option value="Sangat Terawat">Sangat Terawat</option>
                    <option value="Terawat">Terawat</option>
                    <option value="Cukup Terawat">Cukup Terawat</option>
                    <option value="Tidak Terawat">Tidak Terawat</option>
                </select>
                <label for="icon_prefix">Kondisi Bangunan</label>
            </div>
        
            <div class="input-field col s12">
                <textarea name="catatan1"  id="textarea1" class="materialize-textarea"
                placeholder="Tuliskan catatan">{{$bangunan->keterangan1 ?? old('catatan1')}}</textarea>
                <label for="">Catatan Untuk Bangunan Ini</label>
            </div>
            
           <!-- <div class="form-group">
                <input type="submit" value="Simpan" class="btn btn-primary">
            </div>--->
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
            $('#imb').on('change', function(){
                if (this.value == "Ya") {
                    $('#tgl_imb, #no_imb').show()
                }
            })
        });
    </script>
@endpush

@push('select2css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

