@extends('frontend.templates.default')

@section('content')
<div class="row">
<blockquote>
<p class="flow-text"><b>Daftar pending penilaian internal kamu hari ini, semangat ya...</b></p>
</blockquote>
</div>

<div class="row">
@foreach ($internals as $internal)
    <div class="col s12 m6">
        <div class="card horizontal hoverable">
            <div class="card-stacked">
                <div class="card-content">
                    <h5>Penilaian Internal an {{$internal->nama_debitur}}</h5>
                    <p>Jumlah Objek  : {{$internal->jumlah_objek}}</p>
                    <p>BU   : {{$internal->bus->name}}</p>
                    <p>Tujuan Penilaian  : {{$internal->tujuan}}</p>
                    <p>Tanggal Terima Order   : {{date_format((date_create($internal->tanggal_terima)),'d M Y')}}</p>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>
<div class="row">
<div class="col s3">
    <form action="{{route ('kerjainternal.create')}}" method="POST">
    @csrf
        <label for="">Pilih nama debitur yang ingin dikerjakan sekarang</label>
        <select name="nama_debitur"  class="browser-default">
            @foreach ($internals as $internal)
                <option value="{{$internal->nama_debitur }}">{{$internal->nama_debitur}}</option>
            @endforeach
        </select>
        <button class="btn indigo darken-4 waves-effect waves-solid" type="submit">
                    Pilih Debitur
                    <i class="material-icons right">add_circle</i>
        </button>
    </form>
</div>   
</div>

@endsection



