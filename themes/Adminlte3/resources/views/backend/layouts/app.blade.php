<!doctype html>
<html lang="{{App::getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/favicon.png')}}">
    <meta name="keyword" content="{{ setting('meta_keyword') }}">
    <meta name="description" content="{{ setting('meta_description') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
    <link rel="icon" type="image/ico" href="{{asset('img/favicon.png')}}" />

    

    {{-- @stack('before-styles') --}}

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('themes/adminlte3/vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ url('themes/adminlte3/vendor/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('themes/adminlte3/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">


    @stack('after-styles')


    
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Header Block -->
        @include('backend.includes.header')
        <!-- / Header Block -->

        <!-- Sidebar -->
        @include('backend.includes.sidebar')
        <!-- /Sidebar -->

        <div class="content-wrapper">
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      @yield('breadcrumbs')
                    </ol>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>
             <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    @include('flash::message')
                    <!-- Errors block -->
                    @include('backend.includes.errors')
                    <!-- / Errors block -->

                    <!-- Main content block -->
                    @yield('content')
                    <!-- / Main content block -->

                  </div>
                </div>
              </div>
            </section>
        </div>

        <!-- Footer block -->
        @include('backend.includes.footer')
        <!-- / Footer block -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ url('themes/adminlte3/vendor/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{url('themes/adminlte3/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{url('themes/adminlte3/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('themes/adminlte3/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ url('themes/adminlte3/js/demo.js')}}"></script> --}}

    <!-- Scripts -->
    {{-- @stack('before-scripts') --}}

    <!-- REQUIRED SCRIPTS --> 
{{-- 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/URI.js/1.18.2/URI.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.i18n/1.0.7/jquery.i18n.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.i18n/1.0.7/jquery.i18n.messagestore.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.i18n/1.0.7/jquery.i18n.parser.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.i18n/1.0.7/jquery.i18n.language.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.i18n/1.0.7/jquery.i18n.emitter.min.js" integrity="sha256-VNKWSG0j8kQ/+I4J9r0skSppRy11yw7kRmoZK7xmcIM=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.i18n/1.0.7/jquery.i18n.emitter.bidi.min.js" integrity="sha256-gtc2Tvs5/k9I3Q28OZ/CP7TzCHANC8wUbJZQVE989Do=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script> --}}

   {{--  <script>
      let locale = '{{locale()}}'
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});
      moment.locale(locale);
    </script> --}}
    
    {{-- @stack('after-scripts') --}}
    <!-- / Scripts -->

</body>
</html>
