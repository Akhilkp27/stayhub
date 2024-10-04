<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>StayHub - The booking adviser</title>

     <!-- Meta Tags for SEO -->
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
    <meta name="description" content="StayHub - Your best hotel booking adviser. Find the best rooms at affordable prices.">
    <meta name="keywords" content="hotel, booking, travel, rooms, StayHub">
    <meta property="og:title" content="StayHub - The booking adviser">
    <meta property="og:description" content="Find your ideal hotel room with StayHub. Compare prices and amenities.">
    <meta property="og:image" content="{{ asset('img/icons/stayhub.png') }}">

     <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/icons/stayhub.png') }}" type="image/png">
    
    <script src="{{ asset('admin/js/core/jquery-3.7.1.min.js') }}"></script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}?v={{ time() }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/plugins.min.css') }}?v={{ time() }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/kaiadmin.min.css') }}?v={{ time() }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/summernote-bs5.min.css') }}?v={{ time() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.0/sweetalert2.css" integrity="sha512-Gebe6n4xsNr0dWAiRsMbjWOYe1PPVar2zBKIyeUQKPeafXZ61sjU2XCW66JxIPbDdEH3oQspEoWX8PQRhaKyBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  </head>
  <body>
    @yield('content')
     <!--   Core JS Files   -->
     
     <script src="{{ asset('admin/js/core/popper.min.js') }}?v={{ time() }}"></script>
     <script src="{{ asset('admin/js/core/bootstrap.min.js') }}?v={{ time() }}"></script>
 
      <!-- Plugin JS Files -->
     <script src="{{ asset('admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}?v={{ time() }}"></script>
     <script src="{{ asset('admin/js/plugin/chart.js/chart.min.js') }}?v={{ time() }}"></script>
     <script src="{{ asset('admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}?v={{ time() }}"></script>
     <script src="{{ asset('admin/js/plugin/chart-circle/circles.min.js') }}?v={{ time() }}"></script>
     <script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}?v={{ time() }}"></script>
     <script src="{{ asset('admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}?v={{ time() }}"></script>
     <script src="{{ asset('admin/js/plugin/jsvectormap/jsvectormap.min.js') }}?v={{ time() }}"></script>
     <script src="{{ asset('admin/js/plugin/jsvectormap/world.js') }}?v={{ time() }}"></script>
     <script src="{{ asset('admin/js/summernote-bs5.min.js') }}?v={{ time() }}"></script>
     <script src="{{ asset('admin/js/kaiadmin.min.js') }}?v={{ time() }}"></script>
     <script src="{{ asset('admin/js/plugin/select3/select2.full.min.js') }}?v={{ time() }}"></script>
     <!-- Other External Libraries -->
     
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.0/sweetalert2.min.js" integrity="sha512-OlF0YFB8FRtvtNaGojDXbPT7LgcsSB3hj0IZKaVjzFix+BReDmTWhntaXBup8qwwoHrTHvwTxhLeoUqrYY9SEw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script> --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     
        <!-- Fonts and icons -->
    <script src="{{asset('admin/js/plugin/webfont/webfont.min.js')}}?v={{ time() }}"></script>
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
   </body>
 </html>
 