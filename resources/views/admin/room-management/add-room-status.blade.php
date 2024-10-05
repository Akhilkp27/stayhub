@extends('layouts.admin_staff_layout')
<style>
  .error{
  color: red;
}
.scuccess{
  color: green;
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
                    <button type="button" class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addStatusModal">
                        <i class="fa fa-plus"></i> Add Status 
                    </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="add-status" class="table table-striped">
                        <thead>
                          <tr>
                            <th>Sl.No</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Sl.No</th>
                            <th>Status</th>
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
       </div>
       
        @include('partials.admin.footer')
        
      </div>
    </div>
    <!-- Add Status Modal -->
    <div class="modal fade" id="addStatusModal" tabindex="-1" aria-labelledby="addStatusModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title" id="addStatusModalLabel"><b>Add New Status</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <form id="addStatus" action="{{route('admin.store-room-status')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                  <div class="row mb-3">
                      <div class="col-md-12 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" placeholder="Enter status" required onkeyup="checkExists(this)">
                        <span class="error" id="statusError"></span>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-md-12">
                          <label for="description" class="form-label">Description</label>
                          <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Enter description" maxlength="255"></textarea>
                      </div>
                  </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="saveBtn"  class="btn btn-success">Save</button>
              </div>
          </form>
          </div>
        </div>
    </div>

    
   <script>
    $(document).ready(function(){
      $('#add-status').DataTable({
        "ajax": {
                  "url": "{{ route('admin.get-table-data') }}", 
                  "type": "GET",
                  "data": {
                            "table": "room_statuses" 
                         },
                  "dataSrc": "" 
                },
              "columns": [
                  { 
                      "data": null, 
                      "render": function (data, type, row, meta) {
                          return meta.row + 1; // Index of the row
                      }
                  }, 
                  { "data": "status_name" },
                  { "data": "description" },
                  { 
                      "data": null, // Action column
                      "render": function(data, type, row) {
                          return `
                              <button class="btn btn-sm btn-primary" onclick="editAmenity(${row.id})">Edit</button>
                          `;
                      }
                  }
              ]
      });
      $('#description').summernote({
            height: 200, 
            minHeight: 200, 
            maxHeight: 500 
        });
    });
    $('#addStatus').on('submit', function(e) {
        e.preventDefault(); 
        
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        var formData = new FormData(this);
    
        $.ajax({
            url: url, 
            type: method,
            data: formData,
            contentType: false, 
            processData: false, 
            success: function(response) {
                if (response.success === true) {
                    toastr.success(response.message);
                    $('#add-status').DataTable().ajax.reload(null, false); 
                    $('#addStatus')[0].reset(); 
                    $('#addStatusModal').modal('hide'); 
                } else {
                    toastr.error('Something went wrong. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                toastr.error('An error occurred during the request.');
            }
         });
    });

         
  </script>
@endsection