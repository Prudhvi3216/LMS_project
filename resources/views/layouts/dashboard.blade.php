<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <title>MaxproLearn - Dashboard</title>


  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  
 
  <!-- Custom styles for this template-->
  <link href="{{ asset('backend/css/sb-admin.css') }} " rel="stylesheet">
  <link href="{{ url('//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
@include('partials/dashb_nav')
<div id="app">
  <div id="wrapper">
    <!--<admin-sdmenu></admin-sdmenu>-->
    <instructor-sdmenu></instructor-sdmenu>
    <div id="content-wrapper" style="background-color:#f1f3f6;">
      <div class="container-fluid">
        @yield('breadcrumb')
        
          @yield('content')
        
      </div>
      <!-- /container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © MaxproLearn 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!--#content-wrapper-->
  </div>
  <!--#wrapper-->
</div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

  <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('backend/js/sb-admin.min.js') }}"></script>
  <!-- Page level plugin JavaScript-->

  <script src="{{ url('//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>
