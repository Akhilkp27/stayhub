<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>StayHub - The booking adviser</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
    <link rel="icon" href="{{ asset('img/icons/stayhub.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
     <script src="{{ asset('admin/js/core/jquery-3.7.1.min.js') }}"></script>
     
    <!-- Fonts and icons -->
    <script src="{{asset('admin/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{asset('admin/css/fonts.min.css')}}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.0/sweetalert2.css" integrity="sha512-Gebe6n4xsNr0dWAiRsMbjWOYe1PPVar2zBKIyeUQKPeafXZ61sjU2XCW66JxIPbDdEH3oQspEoWX8PQRhaKyBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
   
  </head>
  <body>
    @yield('content')
     <!--   Core JS Files   -->
     {{-- <script src="{{ asset('admin/js/core/jquery-3.7.1.min.js') }}"></script> --}}
     <script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
     <script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>
 
     <!-- jQuery Scrollbar -->
     <script src="{{ asset('admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
 
     <!-- Chart JS -->
     <script src="{{ asset('admin/js/plugin/chart.js/chart.min.js') }}"></script>
 
     <!-- jQuery Sparkline -->
     <script src="{{ asset('admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
 
     <!-- Chart Circle -->
     <script src="{{ asset('admin/js/plugin/chart-circle/circles.min.js') }}"></script>
 
     <!-- Datatables -->
     <script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}"></script>
 
     <!-- Bootstrap Notify -->
     <script src="{{ asset('admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
 
     <!-- jQuery Vector Maps -->
     <script src="{{ asset('admin/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
     <script src="{{ asset('admin/js/plugin/jsvectormap/world.js') }}"></script>
 
     <!-- Sweet Alert -->
     <script src="{{ asset('admin/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
     
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.0/sweetalert2.min.js" integrity="sha512-OlF0YFB8FRtvtNaGojDXbPT7LgcsSB3hj0IZKaVjzFix+BReDmTWhntaXBup8qwwoHrTHvwTxhLeoUqrYY9SEw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

     <!-- Kaiadmin JS -->
     <script src="{{ asset('admin/js/kaiadmin.min.js') }}"></script>
 
     <script>
       $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
         type: "line",
         height: "70",
         width: "100%",
         lineWidth: "2",
         lineColor: "#177dff",
         fillColor: "rgba(23, 125, 255, 0.14)",
       });
 
       $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
         type: "line",
         height: "70",
         width: "100%",
         lineWidth: "2",
         lineColor: "#f3545d",
         fillColor: "rgba(243, 84, 93, .14)",
       });
 
       $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
         type: "line",
         height: "70",
         width: "100%",
         lineWidth: "2",
         lineColor: "#ffa534",
         fillColor: "rgba(255, 165, 52, .14)",
       });
     </script>
   </body>
 </html>
 