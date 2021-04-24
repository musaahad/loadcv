@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Data Hari Libur</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('admin.holidays.update', $holiday)}}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group @error('tanggal_libur') has-error @enderror">
                <label for="">Tanggal Libur</label>
                <input type="date" name="tanggal_libur" class="form-control" 
                placeholder="Masukkan Tanggal Libur" value="{{old('tanggal_libur') ?? $holiday->tanggal_libur}}">
                @error('tanggal_libur')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('catatan') has-error @enderror">
                <label for="">Catatan</label>
                <input type="text" name="catatan" class="form-control" 
                placeholder="Masukkan Catatan" value="{{old('catatan') ?? $holiday->catatan}}">
                @error('catatan')
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