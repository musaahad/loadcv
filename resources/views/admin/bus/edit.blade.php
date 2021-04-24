@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Data BU</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('admin.bus.update', $bu)}}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group @error('name') has-error @enderror">
                <label for="">Nama</label>
                <input type="text" name="name" class="form-control" 
                placeholder="Masukkan Nama BU" value="{{old('name') ?? $bu->name}}">
                @error('name')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('alamatbu') has-error @enderror">
                <label for="">Alamat BU</label>
                <input type="text" name="alamatbu" class="form-control" 
                placeholder="Masukkan Alamat BU" value="{{old('alamatbu') ?? $bu->alamatbu}}">
                @error('alamatbu')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('jenis_order') has-error @enderror">
                <label for="">Jenis Order</label>
                <select name="jenis_order" class="form-control select2">
                    <option value="{{$bu->jenis_order ?? old('jenis_order')}}" selected>{{$bu->jenis_order}}</option>  
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
                <label for="">TaT Maksimal</label>
                <input type="text" name="tar_tat" class="form-control" 
                placeholder="Masukkan TaT Maksimal" value="{{old('tar_tat') ?? $bu->tar_tat}}">
                @error('tar_tat')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <input type="submit" value="Ubah" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection