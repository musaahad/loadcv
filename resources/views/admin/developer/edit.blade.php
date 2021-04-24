@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Data Developer</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('admin.developer.update', $developer)}}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group @error('name') has-error @enderror">
                <label for="">Nama</label>
                <input type="text" name="name" class="form-control" 
                placeholder="Masukkan Nama Developer" value="{{old('name') ?? $developer->name}}">
                @error('name')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('tiering') has-error @enderror">
                <label for="">Tiering</label>
                <select name="tiering" class="form-control select2">
                    <option value="{{old('tiering')?? $developer->tiering}}" selected>{{old('tiering')?? $developer->tiering}}</option>  
                    <option value="1 Nasional">1 Nasional</option>
                    <option value="1 Regional">1 Regional</option>
                    <option value="2">2</option>
                    <option value="FLPP">FLPP</option>
                    <option value="Jual Putus">Jual Putus</option>
                    <option value="Secondary">Secondary</option>
                </select>
                @error('tiering')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('projek') has-error @enderror">
                <label for="">Projek/Perumahan</label>
                <input type="text" name="projek" class="form-control" 
                placeholder="Masukkan nama projek/perumahan" value="{{ old('projek')??$developer->projek}}">
                @error('projek')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('lokasi') has-error @enderror">
                <label for="">Alamat Projek/Perumahan</label>
                <input type="text" name="lokasi" class="form-control" 
                placeholder="Masukkan alamat projek/perumahan" value="{{ old('lokasi')?? $developer->lokasi}}">
                @error('lokasi')
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