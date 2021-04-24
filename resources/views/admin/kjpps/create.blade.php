@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tambah Data KJPP</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('admin.kjpps.store')}}" method="POST">
            @csrf

            <div class="form-group @error('name') has-error @enderror">
                <label for="">Nama</label>
                <input type="text" name="name" class="form-control" 
                placeholder="Masukkan Nama KJPP" value="{{ old('name')}}">
                @error('name')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('pimpinan') has-error @enderror">
                <label for="">Nama Pimpinan</label>
                <input type="text" name="pimpinan" class="form-control" 
                placeholder="Masukkan Nama Pimpinan" value="{{ old('pimpinan')}}">
                @error('pimpinan')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('nomappi') has-error @enderror">
                <label for="">No. MAPPI Pimpinan</label>
                <input type="text" name="nomappi" class="form-control" 
                placeholder="Masukkan No. MAPPI Pimpinan" value="{{ old('nomappi')}}">
                @error('nomappi')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('ijinpublik') has-error @enderror">
                <label for="">No. Ijin Penilai Publik</label>
                <input type="text" name="ijinpublik" class="form-control" 
                placeholder="Masukkan No. Ijin Penilai Publik Pimpinan" value="{{ old('ijinpublik')}}">
                @error('ijinpublik')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('klasifikasi') has-error @enderror">
                <label for="">Klasifikasi Rekanan</label>
                <select name="klasifikasi" class="form-control">
                    <option value="{{old('klasifikasi')}}" selected>{{old('klasifikasi')}}</option>  
                    <option value="A (Limit kredit per debitur sampai dengan BMPK)">A</option>
                    <option value="B (Limit kredit per debitur sampai dengan Rp. 250 Miliar)">B</option>
                    <option value="C (Limit kredit per debitur sampai dengan Rp. 25 Miliar)">C</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" value="Tambah" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection