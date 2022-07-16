<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bracket Plus">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/bracketplus">
    <meta property="og:title" content="Bracket Plus">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/bracketplus/img/bracketplus-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    @yield('title')

    <!-- vendor css -->
    <link href="{{asset('backend/')}}/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="{{asset('backend/')}}/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="{{asset('backend/')}}/lib/rickshaw/rickshaw.min.css" rel="stylesheet">
    <!-- Toastr css  -->
    <link rel="stylesheet" href="{{asset('backend/assets/toastr/toastr.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('backend/')}}/css/bracket.css">
    <link rel="stylesheet" href="{{asset('backend/')}}/css/custom.css">
    @yield('css')
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    @include('backend.inc.left-sidebar')
    
    @include('backend.inc.header-menu')

    @include('backend.inc.right-sidebar')
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    @yield('content')
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="{{asset('backend')}}/lib/jquery/jquery.min.js"></script>
    <script src="{{asset('backend')}}/lib/jquery-ui/ui/widgets/datepicker.js"></script>
    <script src="{{asset('backend')}}/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('backend')}}/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{asset('backend')}}/lib/moment/min/moment.min.js"></script>
    <script src="{{asset('backend')}}/lib/peity/jquery.peity.min.js"></script>
    <script src="{{asset('backend')}}/lib/rickshaw/vendor/d3.min.js"></script>
    <script src="{{asset('backend')}}/lib/rickshaw/vendor/d3.layout.min.js"></script>
    <script src="{{asset('backend')}}/lib/rickshaw/rickshaw.min.js"></script>
    <script src="{{asset('backend')}}/lib/jquery.flot/jquery.flot.js"></script>
    <script src="{{asset('backend')}}/lib/jquery.flot/jquery.flot.resize.js"></script>
    <script src="{{asset('backend')}}/lib/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="{{asset('backend')}}/lib/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="{{asset('backend')}}/lib/echarts/echarts.min.js"></script>
    
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyAq8o5-8Y5pudbJMJtDFzb8aHiWJufa5fg"></script>
    <script src="{{asset('backend')}}/lib/gmaps/gmaps.min.js"></script>
    <script src="{{asset('backend/assets/toastr/toastr.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script src="{{asset('backend')}}/js/bracket.js"></script>
    <script src="{{asset('backend')}}/js/map.shiftworker.js"></script>
    <script src="{{asset('backend')}}/js/ResizeSensor.js"></script>
    <script src="{{asset('backend')}}/js/dashboard.js"></script>
    <script src="{{asset('backend')}}/js/custom.js"></script>
    @yield('js')
    <script>
      $(function(){
        'use strict'

        // FOR DEMO ONLY
        // menu collapsed by default during first page load or refresh with screen
        // having a size between 992px and 1299px. This is intended on this page only
        // for better viewing of widgets demo.
        $(window).resize(function(){
          minimizeMenu();
        });

        minimizeMenu();

        function minimizeMenu() {
          if(window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
            // show only the icons and hide left menu label by default
            $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
            $('body').addClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideUp();
          } else if(window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
            $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
            $('body').removeClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideDown();
          }
        }
      });
    </script>
       <script>
       // toastr enitialize
      @if( Session::has('success'))
        toastr.options = {
          "closeButton": true,
          "progressBar": true,
          "timeOut": "5000",
        },toastr.success("{{ Session::get('success') }}");

      @elseif(Session::has('update'))
        toastr.options = {
          "closeButton": true,
          "progressBar": true,
          "timeOut": "4000",
        },toastr.success("{{ Session::get('update') }}");

      @elseif(Session::has('warning'))
        toastr.options = {
          "closeButton": true,
          "progressBar": true,
          "timeOut": "4000",
        },toastr.warning("{{ Session::get('warning') }}");
        
      @elseif(Session::has('delete'))
        toastr.options = {
          "closeButton": true,
          "progressBar": true,
          "timeOut": "4000",
        }, toastr.warning("{{ Session::get('delete') }}");
      @endif
    </script>
    
  </body>
</html>
