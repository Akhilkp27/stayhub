@extends('layouts.admin_staff_layout')
<style>
  .table td:last-child {
    background-color: transparent !important;
  }
  .table td.description {
    max-height: 60px; /* Set a maximum height for the description cell */
    overflow-y: auto; /* Enable vertical scrolling */
    overflow-x: hidden; /* Hide horizontal scrolling */
    white-space: normal; /* Allow text wrapping */
    display: block; /* Set display to block to ensure overflow works */
    padding: 5px; /* Add padding for readability */
    word-wrap: break-word; /* Ensure long words are broken correctly */
}

/* Optional: Adjust the width of the description column */
.table th.description, .table td.description {
    width: 300px; /* Adjust the width to fit the text content */
}
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
                                <th class="description">Description</th>
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
     <!-- Add Room Type Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><b>Add New Room Type</b></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
              <form id="addRoomType" action="{{route('admin.store-room-type')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Room Type -->
                        <div class="col-md-6">
                            <label for="roomType" class="form-label">Room Type</label>
                            <input type="text" class="form-control" id="roomType" name="roomType" placeholder="Enter room type" required onkeyup="checkExists(this)">
                            <span class="error" id="roomTypeError"></span>
                        </div>
                        <!-- Total room -->
                        <div class="col-md-6">
                            <label for="totalRooms" class="form-label">Total Rooms</label>
                            <input type="text" class="form-control" id="totalRooms" name="totalRooms" placeholder="Enter total rooms" required>
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
    </div>
 <!-- Edit Room Type Modal -->
 <div class="modal fade" id="editRoomTypeModal" tabindex="-1" aria-labelledby="editRoomTypeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="editRoomTypeModalLabel"><b>Edit New Room Type</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <form id="editRoomTypeForm" action="{{route('admin.update-room-type')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
              <div class="row mb-3">
                  <!-- Room Type -->
                  <div class="col-md-12 mb-4">
                      <label for="roomType" class="form-label">Room Type</label>
                      <input type="text" class="form-control" id="editRoomType" name="roomType" placeholder="Enter room type" required onkeyup="checkExists(this)">
                      <span class="error" id="roomTypeError"></span>
                  </div>
                  <!-- Total room -->
                  <div class="col-md-6">
                      <label for="totalRooms" class="form-label">Total Rooms</label>
                      <input type="text" class="form-control" id="editTotalRooms" name="totalRooms" placeholder="Enter total rooms" required>
                  </div>
                  <!-- Available room -->
                  <div class="col-md-6">
                    <label for="availableRooms" class="form-label">Available Rooms</label>
                    <input type="text" class="form-control" id="availableRooms" name="availableRooms" placeholder="Enter total rooms" required>
                </div>
              </div>
              <div class="row mb-3">
                  <div class="col-md-12">
                      <label for="description" class="form-label">Description</label>
                      <textarea name="description" id="editDescription" class="form-control" cols="30" rows="5" placeholder="Enter description" maxlength="255"></textarea>
                  </div>
              </div>
          </div>
          </div>
          <div class="modal-footer">
            <input type="text" id="roomTypeId" hidden>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="saveBtn"  class="btn btn-success">Update</button>
          </div>

      </form>
      
      </div>
    </div>
  </div>
</div>
    <script>
      $(document).ready(function() {
        $('#editDescription').summernote({
            height: 200,   // Set the height of the editor
                minHeight: 200, // Set minimum height
                maxHeight: 500  // Set maximum height
      });
      $('#description').summernote({
            height: 200,   // Set the height of the editor
                minHeight: 200, // Set minimum height
                maxHeight: 500  // Set maximum height
      });
          // Initialize DataTable with Ajax
          var table = $('#add-row').DataTable({
              "ajax": {
                  "url": "{{ route('admin.get-room-type') }}", 
                  "type": "GET",
                  "dataSrc": "" 
              },
              "columns": [
                  { 
                      "data": null, 
                      "render": function (data, type, row, meta) {
                          return meta.row + 1; // Index of the row
                      }
                  }, 
                  { "data": "type_name" },
                  { "data": "total_rooms" },
                  { "data": "available_rooms" },
                  { "data": "description" },
                  { 
                      "data": null, // Action column
                      "render": function(data, type, row) {
                          return `
                              <button class="btn btn-sm btn-primary" onclick="editRoomType(${row.id})">Edit</button>
                              <button class="btn btn-sm btn-danger" onclick="deleteRoomType(${row.id})">Delete</button>
                          `;
                      }
                  }
              ]
          });
      
          // Add Room Type Form Submission
          $('#addRoomType').on('submit', function(e) {
              e.preventDefault(); 
              
              var url = $(this).attr('action');
              var method = $(this).attr('method');
              var formData = $(this).serialize(); 
          
              $.ajax({
                  url: url, 
                  type: method,
                  data: formData,
                  success: function(response) {
                      if (response.success === true) {
                          toastr.success(response.message);
                          $('#add-row').DataTable().ajax.reload(null, false); 
                          $('#addRoomType')[0].reset(); 
                          $('#exampleModal').modal('hide'); 
                      } else {
                          toastr.error('Something went wrong. Please try again.');
                      }
                  },
                  error: function(xhr, status, error) {
                      toastr.error('An error occurred during the request.');
                  }
              });
          });

           // Edit Room Type Form Submission
           $('#editRoomTypeForm').on('submit', function(e) {
              e.preventDefault(); 
              var roomTypeId = $('#roomTypeId').val();
              console.log(roomTypeId);
              
              var url = $(this).attr('action');
              var method = $(this).attr('method');
              var formData = $(this).serialize(); 
          
              $.ajax({
                  url: url, 
                  type: method,
                  data: formData + '&roomTypeId=' + roomTypeId,
                  success: function(response) {
                      if (response.success === true) {
                          toastr.success(response.message);
                          $('#add-row').DataTable().ajax.reload(null, false); 
                          $('#addRoomType')[0].reset(); 
                          $('#editRoomTypeModal').modal('hide'); 
                      } else {
                          toastr.error('Something went wrong. Please try again.');
                      }
                  },
                  error: function(xhr, status, error) {
                      toastr.error('An error occurred during the request.');
                  }
              });
          });
      
      });
      
      // Function to check if room type exists dynamically
      function checkExists(type) {
          var roomTypes = type.value;
          $.ajax({
              url: "{{ route('admin.check-if-exists') }}", 
              type: "GET",
              data: {
                table: 'room_types',
                column: 'type_name',
                value: roomTypes
              },
              success: function(response) {
                  if (response.exists === true) {
                      $('#roomTypeError').text('This room type already exists.').removeClass('success').addClass('error'); 
                      $('#saveBtn').prop('disabled', true); 
                  } else {
                      $('#roomTypeError').text('').removeClass('error').addClass('success'); 
                      $('#saveBtn').prop('disabled', false); 
                  }
              },
              error: function(xhr, status, error) {
                  toastr.error('An error occurred during the request.');
              }
          });
      }
      
      // Function to handle room type edit
      function editRoomType(id) {
          var roomTypeId = id;
          
          $.ajax({
              url: "{{route('admin.get-data-for-edit')}}", 
              type: "GET",
              data: {
                table: 'room_types',
                value: roomTypeId
              },
              success: function(response) {
                console.log(response);
                $('#roomTypeId').val(response.data.id);
                $('#editRoomType').val(response.data.type_name);
                $('#editTotalRooms').val(response.data.total_rooms);
                $('#availableRooms').val(response.data.available_rooms);
                $('#editDescription').summernote('code', response.data.description);
                $('#editRoomTypeModal').modal('show'); 
              },
              error: function(xhr, status, error) {
                  toastr.error('An error occurred during the request.');
              }
          });
      }

      function deleteRoomType(id){
        var roomTypeId = id;
        var url = "{{route('admin.delete-room-type',':id')}}";
        var newUrl = url.replace(':id', roomTypeId )
        Swal.fire({
        title: "Do you want to delete ?",
        // showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Delete",
        denyButtonText: `Don't save`
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
              url: newUrl, 
              type: "DELETE",
              data: {
                    _token: "{{ csrf_token() }}" // Include CSRF token for DELETE requests
                },
              success: function(response) {
                Swal.fire("Deleted!", "", "success");
                $('#add-row').DataTable().ajax.reload(null, false); 
              },
              error: function(xhr, status, error) {
                  toastr.error('An error occurred during the request.');
              }
          });

            
        } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
        }
        });
        
      }
      </script>
      
@endsection