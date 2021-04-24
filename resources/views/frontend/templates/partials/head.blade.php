<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="">
    <link rel="stylesheet" href="{{asset('assets/plugins/materialize.min.css')}}">

   
    <link href="{{asset('assets/plugins/materializeicons.css')}}" rel="stylesheet">
    
    <script type="text/javascript" src="{{ asset('js/my.js')}}"></script> <!--ini utk pemisah titik-->
    <title>{{$title ?? 'Load CV Daily'}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('assets/plugins/jqueri-ui/jquery-ui.css')}}" rel="Stylesheet"></link>
    
</head>