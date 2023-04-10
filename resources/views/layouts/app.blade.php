<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hai , {{auth()->user()->name}}</title>

    <meta name="author" content="Fietra Prabaskara">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="https://perumdamtirtakencana.id/sites/images/logo-page.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://perumdamtirtakencana.id/sites/images/logo-page.png">
    <link rel="manifest" href="{{ asset('favicon/manifest.json?v=RyMly03xdz') }}">
    <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg?v=RyMly03xdz') }}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico?v=RyMly03xdz') }}">
    <meta name="theme-color" content="#ffffff">
    <style type="text/css">
        @import url( 'https://fonts.googleapis.com/css?family=Gugi' );
        body{
        font-family: 'Gugi', cursive;
        }
    </style>

    

    <link rel="stylesheet" type="text/css" href="{{asset('css/backend/one.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/backend/dua.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/backend/tiga.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/backend/empat.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>  
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.0/lity.min.css"> 

    @yield('css')
    

</head>
<body class="with-side-menu @yield('addNavBody')">
    
    @include('layouts.partials.nav')
    @include('layouts.partials.sidebar')

    @yield('addNav')

    <div class="page-content" style="margin-top: -60px;">
        @yield('content')
        @include('sweet::alert')
    </div>

    <div class="statusbar">
        <div class="statusbar-item title">
            <strong></strong>
        </div> 
    </div>

    <script src="{{asset('js/backend/satu.js')}}"></script>
    <script src="{{asset('js/backend/dua.js')}}"></script>
    <script src="{{asset('js/backend/tiga.js')}}"></script>
    <script src="{{asset('js/backend/empat.js')}}"></script>
    <script src="{{asset('js/backend/lima.js')}}"></script>
    <script src="{{asset('js/backend/enam.js')}}"></script>
    <script src="{{asset('js/backend/tujuh.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.0/lity.min.js"></script>  
    
    @yield('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
         $('#summernote').summernote({
                placeholder: 'Hello Bootstrap 4',
                tabsize: 2,
                height: 500
              });
          $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>

    <script type="text/javascript">
         $(document).ready(function () {
                $('#input').datetimepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm-dd HH:MM:SS',
                modal: true,
                footer: true
            });
        });
    </script>

    @yield('js')
    
</body>
</html>