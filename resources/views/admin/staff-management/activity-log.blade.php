@extends('layouts.admin_staff_layout')
<style>
  .table td:last-child {
    background-color: transparent !important;
  }
</style>

@section('content')
    <div class="wrapper">

       @include('partials.admin.sidebar')

      <div class="main-panel">
        
       @include('partials.admin.header')

         <div class="container">
          <div class="page-inner">

          @include('partials.admin.breadcrumbs')
                         <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="add-row" class="table table-hover">
                        <thead>
                          <tr>
                            <th>Staff ID</th>
                            <th>Staff Name</th>
                            <th>Action</th>
                            <th>Description</th>
                            <th>IP Address</th>
                            <th>User Agent</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Staff ID</th>
                            <th>Staff Name</th>
                            <th>Action</th>
                            <th>Description</th>
                            <th>IP Address</th>
                            <th>User Agent</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      
       
        @include('partials.admin.footer')
        
      </div>
    </div>
   <script>
      $(document).ready(function() {
        $('#add-row').DataTable({ })

        
       });


    </script>
@endsection