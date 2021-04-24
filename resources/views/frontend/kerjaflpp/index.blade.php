@extends('frontend.templates.default')

@section('content')
<div class="row">
<blockquote>
<p class="flow-text"><b>Daftar pending inspeksi FLPP kamu hari ini, semangat ya...</b></p>
</blockquote>
</div>

<div class="row">
@foreach ($flpps as $flpp)
    <div class="col s12 m6">
        <div class="card horizontal hoverable">
            <div class="card-stacked">
                <div class="card-content">
                    <h5>Inspeksi FLPP an {{$flpp->nama_debitur}}</h5>
                    <p>BU   : {{$flpp->bus->name}}</p>
                    <p>Developer   : {{$flpp->developers->name}}</p>
                    <p>Projek/Perumahan   : {{$flpp->developers->projek}}</p>
                    <p>Lokasi   : {{$flpp->developers->lokasi}}</p>
                    <p>Tanggal Terima Order   : {{date_format((date_create($flpp->tanggal_terima)),'d M Y')}}</p>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>
<div class="row">
<div class="col s3">
    <form action="{{route ('kerjaflpp.create')}}" method="POST">
    @csrf
        <label for="">Pilih nama debitur yang ingin dikerjakan sekarang</label>
        <select name="nama_debitur"  class="browser-default">
            @foreach ($flpps as $flpp)
                <option value="{{$flpp->nama_debitur }}">{{$flpp->nama_debitur}}</option>
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



