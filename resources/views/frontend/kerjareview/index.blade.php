@extends('frontend.templates.default')

@section('content')
<div class="row">
<blockquote>
<p class="flow-text">Daftar pending review LPA kamu hari ini, semangat ya..</p>
</blockquote>
</div>

<div class="row">
@foreach ($reviews as $review)
    <div class="col s12 m6">
        <div class="card horizontal hoverable">
            <div class="card-stacked">
                <div class="card-content">
                    <h5>Review LPA an {{$review->nama_debitur}}</h5>
                    <p>Jumlah Objek  : {{$review->jumlah_objek}}</p>
                    <p>KJPP  : {{$review->kjpps->name}}</p>
                    <p>BU   : {{$review->bus->name}}</p>
                    <p>Tanggal Terima Order   : {{date_format((date_create($review->tanggal_terima)),'d M Y')}}</p>
                </div>
       
     <!---  <div class="card-action">
                <a href="{{route ('kerjareview.laporan')}}" class="btn red accent-1 right waves-effect waves-light">3. Download Laporan</a>         
                <a href="{{route ('kerjareview.show')}}" class="btn purple darken-1 right waves-effect waves-light">2. Lihat Daftar Objek</a>
                
                <form action="{{route ('kerjareview.create')}}" method="POST">
                    @csrf
                    <input type="submit" value="1. Mulai" class="btn green accent-1 right waves-effect waves-light">
                </form>
               
            </div>---->
            </div>
        </div>
    </div>
@endforeach
</div>
<div class="row">
<div class="col s3">
    <form action="{{route ('kerjareview.create')}}" method="POST">
    @csrf
        <label for="">Pilih nama debitur yang ingin dikerjakan sekarang</label>
        <select name="nama_debitur"  class="browser-default">
            @foreach ($reviews as $review)
                <option value="{{$review->nama_debitur }}">{{$review->nama_debitur}}</option>
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



