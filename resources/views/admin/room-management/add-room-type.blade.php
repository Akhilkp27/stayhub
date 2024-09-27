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
                    <div class="card-header">
                            <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa fa-plus"></i> Add Room Type
                            </button>
                            </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="add-row" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Room Type</th>
                                <th>Total Rooms</th>
                                <th>Available Rooms</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Sl.No</th>
                                <th>Room Type</th>
                                <th>Total Rooms</th>
                                <th>Available Rooms</th>
                                <th>Description</th>
                                <th>Action</th>
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
     <!-- Add Role Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Add New Role</b></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row mb-3">
                    <!-- Room Type -->
                    <div class="col-md-6">
                        <label for="roomType" class="form-label">Room Type</label>
                        <input type="text" class="form-control" id="roomType" name="roomType" placeholder="Enter room type" required>
                    </div>
                    <!-- Total room -->
                    <div class="col-md-6">
                        <label for="TotalRooms" class="form-label">Total Rooms</label>
                        <input type="text" class="form-control" id="TotalRooms" name="TotalRooms" placeholder="Enter total rooms" required>
                    </div>
                     {{-- <!-- Description -->
                     <div class="row">
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5"></textarea>
                        </div>
                     </div> --}}
                     
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Enter description"></textarea>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Save</button>
            </div>
  
        </form>
        
        </div>
      </div>
    </div>
  </div>
   <script>
      $(document).ready(function() {
        $('#add-row').DataTable({ })

        
       });


    </script>
@endsection