@extends('frontend.templates.default')

@section('content')
<blockquote>
<p class="flow-text"><b>{{auth()->user()->panggilan}} {{auth()->user()->name}}, ini pending kamu hari ini. Semangat ya...</b></p>
</blockquote>
<div class="row">

<!-- <div class="fixed-action-btn">
  <a class="btn-floating btn-large red">Data
    <i class="large material-icons">mode_edit</i>
  </a>
  <ul>
    <li><a href="#" class="btn-floating red"><i class="large material-icons">insert_chart</i></a></li>
    <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
    <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
    <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
  </ul>
</div> -->
   
    @foreach ($reviews as $review)
    
    <div class="col s12 m6">
        <div class="card horizontal hoverable">
            <div class="card-stacked">
                <div class="card-content">
                    <h5>Review LPA an {{$review->nama_debitur}}</h5>
                    <p>Bisnis Unit  : {{$review->bus->name}}</p>
                    <p>Kjpp  : {{$review->kjpps->name}}</p>
                    <p>Jumlah Objek : {{$review->jumlah_objek}} </p>
                    <p>Tanggal Terima Order   : {{date_format((date_create($review->tanggal_terima)),'d-M-Y')}}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach ($internals as $internal)
    
    <div class="col s12 m6">
        <div class="card horizontal hoverable">
            <div class="card-stacked">
                <div class="card-content">
                    <h5>Penilaian Internal an {{$internal->nama_debitur}}</h5>
                    <p>Bisnis Unit  : {{$internal->bus->name}}</p>
                    <p>Jumlah Objek : {{$internal->jumlah_objek}} </p>
                    <p>Tujuan Penilaian : {{$internal->tujuan}} </p>
                    <p>Tanggal Terima Order   : {{date_format((date_create($internal->tanggal_terima)),'d-M-Y')}}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @foreach ($vercalls as $vercall)
    <div class="col s12 m6">
        <div class="card horizontal hoverable">
            <div class="card-stacked">
                <div class="card-content">
                    <h5>Verifikasi Progress an {{$vercall->nama_debitur}}</h5>
                    <p>Bisnis Unit  : {{$vercall->bus->name}}</p>
                    <p>Developer : {{$vercall->developers->name}}</p>
                    <p>Jumlah Objek : {{$vercall->jumlah_objek}} </p>
                    <p>Tanggal Terima Order   : {{date_format((date_create($vercall->tanggal_terima)),'d-M-Y')}}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @foreach ($flpps as $flpp)
    
    <div class="col s12 m6">
        <div class="card horizontal hoverable">
            <div class="card-stacked">
                <div class="card-content">
                    <h5>Inspeksi FLPP an {{$flpp->nama_debitur}}</h5>
                    <p>Bisnis Unit  : {{$flpp->bus->name}}</p>
                    <p>Developer : {{$flpp->developers->name}}</p>
                    <p>Jumlah Objek : {{$flpp->jumlah_objek}} </p>
                    <p>Tanggal Terima Order   : {{date_format((date_create($flpp->tanggal_terima)),'d-M-Y')}}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{ $reviews->links('vendor.pagination.materialize') }}
    
@endsection

@push('scripts')
    <!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems, {
        direction: 'left',
        hoverEnabled: false,
        //toolbarEnabled: true
    });
  });


    // (function($){
    //     $(document).ready(function(){
    //         $('.fixed-action-btn').floatingActionButton({
                
    //         });
    //     });
    // });
    </script> -->
@endpush

