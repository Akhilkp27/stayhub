@extends('layouts.admin_staff_layout')
@section('content')
    <div class="wrapper">

       @include('partials.admin.sidebar')

      <div class="main-panel">
         @include('partials.admin.header')

       
       
        @include('partials.admin.footer')
        
      </div>
    </div>
@endsection