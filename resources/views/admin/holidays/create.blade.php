@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tambah Hari Libur</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('admin.holidays.store')}}" method="POST">
            @csrf

            <div class="form-group @error('tanggal_libur') has-error @enderror">
                <label for="">Tanggal Libur</label>
                <input type="date" name="tanggal_libur" class="form-control" 
                placeholder="Input Tanggal Libur" value="{{ old('tanggal_libur')}}">
                @error('tanggal_libur')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('catatan') has-error @enderror">
                <label for="">Catatan</label>
                <textarea name="catatan"  row="3" class="form-control" 
                placeholder="Tuliskan Catatan">{{ old('catatan')}}</textarea>
                @error('catatan')
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