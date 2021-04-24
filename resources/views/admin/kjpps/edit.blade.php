@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Data KJPP</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('admin.kjpps.update', $kjpp)}}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group @error('name') has-error @enderror">
                <label for="">Nama KJPP</label>
                <input type="text" name="name" class="form-control" 
                placeholder="Masukkan Nama KJPP" value="{{old('name') ?? $kjpp->name}}">
                @error('name')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('pimpinan') has-error @enderror">
                <label for="">Pimpinan</label>
                <input type="text" name="pimpinan" class="form-control" 
                placeholder="Masukkan Nama Pimpinan" value="{{old('pimpinan') ?? $kjpp->pimpinan}}">
                @error('pimpinan')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('nomappi') has-error @enderror">
                <label for="">No. MAPPI Pimpinan</label>
                <input type="text" name="nomappi" class="form-control" 
                placeholder="Masukkan Nomor MAPPI" value="{{old('nomappi') ?? $kjpp->nomappi}}">
                @error('nomappi')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('ijinpublik') has-error @enderror">
                <label for="">No. Ijin Publik</label>
                <input type="text" name="ijinpublik" class="form-control" 
                placeholder="Masukkan Nomor Ijin Publik" value="{{old('ijinpublik') ?? $kjpp->ijinpublik}}">
                @error('ijinpublik')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            
            <div class="form-group @error('klasifikasi') has-error @enderror">
                <label for="">Klasifikasi Rekanan</label>
                <select name="klasifikasi" class="form-control">
                    <option value="{{$kjpp->klasifikasi ?? old('klasifikasi')}}" selected>{{$kjpp->klasifikasi}}</option>  
                    <option value="A (Limit kredit per debitur sampai dengan BMPK)">A</option>
                    <option value="B (Limit kredit per debitur sampai dengan Rp. 250 Miliar)">B</option>
                    <option value="C (Limit kredit per debitur sampai dengan Rp. 25 Miliar)">C</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" value="Ubah" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection