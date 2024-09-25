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
                        <i class="fa fa-plus"></i> Add Role
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="add-row" class="table table-hover">
                        <thead>
                          <tr>
                            
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Role Name</th>
                            <th>Permissions</th>
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
                  <!-- Role Name -->
                  <div class="col-md-12">
                      <label for="roleName" class="form-label">Role Name</label>
                      <input type="text" class="form-control" id="roleName" name="roleName" placeholder="Enter role name" required>
                  </div>
                  <!-- Permissions -->
                  <div class="col-md-12">
                    <label for="roleName" class="form-label">Role Name</label>
                    <select name="" id="" class="form-select js-example-basic-multiple">
                      <option value="">1</option>
                      <option value="">2</option>
                      <option value="">3</option>
                    </select>
                </div>
                  {{-- <div class="col-md-6">
                    <label class="form-label">Permissions</label>
                    <select class="js-example-basic-multiple" id="slct_mas_grp" name="slct_mas_grp[]" multiple="multiple">
                     
                          <option value="">1</option>
                          <option value="">2</option>
                  </select>
                </div> --}}
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
    // Initialize DataTable
    $('#add-row').DataTable({});

    // Initialize Select2 with options
    $('.js-example-basic-multiple').select2({
        placeholder: "Select a state", 
        allowClear: true               
    });
});

    </script>
@endsection