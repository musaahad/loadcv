@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tambah Data BU</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('admin.bus.store')}}" method="POST">
            @csrf

            <div class="form-group @error('name') has-error @enderror">
                <label for="">Nama</label>
                <input type="text" name="name" class="form-control" 
                placeholder="Masukkan Nama BU" value="{{ old('name')}}">
                @error('name')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('alamatbu') has-error @enderror">
                <label for="">Alamat BU</label>
                <input type="text" name="alamatbu" class="form-control" 
                placeholder="Masukkan Alamat BU" value="{{ old('alamatbu')}}">
                @error('alamatbu')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('jenis_order') has-error @enderror">
                <label for="">Jenis Order</label>
                <select name="jenis_order" class="form-control select2">
                    <option value="{{old('jenis_order')}}" selected>{{old('jenis_order')}}</option>  
                    <option value="Penilaian Internal">Penilaian Internal</option>
                    <option value="Review LPA">Review LPA</option>
                    <option value="Inspeksi FLPP">Inspeksi FLPP</option>
                    <option value="Vercall">Vercall</option>
                </select>
                @error('jenis_order')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('tar_tat') has-error @enderror">
                <label for="">TaT Maksimal (HK)</label>
                <input type="number" name="tar_tat" class="form-control" 
                placeholder="Input TaT Maksimal" value="{{ old('tar_tat')}}">
                @error('tar_tat')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <input type="submit" value="Tambah" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection