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
                    <button type="button" class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addAmenityModal">
                        <i class="fa fa-plus"></i> Add Amenity 
                    </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="add-amenities" class="table table-striped">
                        <thead>
                          <tr>
                            <th>Sl.No</th>
                            <th>Amenity</th>
                            <th>Description</th>
                            <th>Icon</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Sl.No</th>
                            <th>Amenity</th>
                            <th>Description</th>
                            <th>Icon</th>
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
    <!-- Add Amenity Modal -->
    <div class="modal fade" id="addAmenityModal" tabindex="-1" aria-labelledby="addAmenityModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title" id="addAmenityModalLabel"><b>Add New Amenity</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <form id="addAmenity" action="{{route('admin.store-amenity')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                  <div class="row mb-3">
                    <div class="col-md-10">
                      <div class="col-md-12 mb-3">
                        <label for="amenityName" class="form-label">Amenity Name</label>
                        <input type="text" class="form-control" id="amenityName" name="amenityName" placeholder="Enter amenity name" required onkeyup="checkExists(this)">
                        <span class="error" id="amenityNameError"></span>
                      </div>
                      <!-- Icon-->
                      <div class="col-md-12">
                          <label for="icon" class="form-label">Icon</label>
                          <input type="file" class="form-control" id="icon" name="icon" required onchange="previewImageForAdd(this)">
                      </div>
                    </div>
                    <div class="col">
                      <div>
                        <img src="" alt="Amenity image" id="amenityIconPreviewAdd" style="height:150px;width:105px;">
                      </div>
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

     <!-- Edit Amenity Modal -->
     <div class="modal fade" id="editAmenityModal" tabindex="-1" aria-labelledby="editAmenityModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title" id="editAmenityModalLabel"><b>Edit Amenity details</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <form id="editAmenity" action="{{route('admin.update-amenity')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                  <div class="row mb-3">
                    <div class="row">
                      <div class="col-md-10 mb-3">
                          <!-- Amenity Name -->
                          <div class="col-md-10 mb-3">
                            <label for="amenityName" class="form-label">Amenity Name</label>
                            <input type="text" class="form-control" id="editAmenityName" name="amenityName" placeholder="Enter amenity name" required onkeyup="checkExists(this)">
                            <span class="error" id="amenityNameError"></span>
                          </div>
                             <!-- Icon-->
                        <div class="col-md-10">
                          <label for="icon" class="form-label">Icon</label>
                          <input type="file" class="form-control" id="icon" name="icon" onchange="previewImage(this)">
                        </div>
                      </div>
                      <div class="col">
                        <div>
                          <img src="" alt="" id="amenityIconPreview" style="border: 1px; height:150px;width:105px;">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="description" class="form-label">Description</label>
                      <textarea name="description" id="editDescription" class="form-control" cols="30" rows="5" placeholder="Enter description" maxlength="255"></textarea>
                    </div>
                  </div>
              </div>
              </div>
              <div class="modal-footer">
                <input type="text" id="amenityId" name="amenityId"   hidden>
                <input type="hidden" id="existingImage" name="existing_image">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="saveBtn"  class="btn btn-success">Update</button>
              </div>
          </form>
          </div>
        </div>
    </div>
   <script>
      $(document).ready(function() {
        var table = $('#add-amenities').DataTable({
          "ajax": {
                  "url": "{{ route('admin.get-amenity') }}", 
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
                  { "data": "name" },
                  { "data": "description" },
                  { 
                      "data": null, // Action column
                      "render": function(data, type, row) {
                          return `
                               <img src="/storage/${row.image_url}" alt="Amenity Image" class="avatar-img rounded-circle"  style="height:60px; width:65px;"/>
                          `;
                      }
                  },
              
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
        $('#editDescription').summernote({
            height: 200, 
            minHeight: 200, 
            maxHeight: 500 
        });
      });
      
      $('#addAmenity').on('submit', function(e) {
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
                          $('#add-amenities').DataTable().ajax.reload(null, false); 
                          $('#addAmenity')[0].reset(); 
                          $('#addAmenityModal').modal('hide'); 
                      } else {
                          toastr.error('Something went wrong. Please try again.');
                      }
                  },
                  error: function(xhr, status, error) {
                      toastr.error('An error occurred during the request.');
                  }
              });
          });

          function checkExists(type) {
          var amenity = type.value;
          $.ajax({
              url: "{{ route('admin.check-if-exists') }}", 
              type: "GET",
              data: {
                table: 'amenities',
                column: 'name',
                value: amenity
              },
              success: function(response) {
                  if (response.exists === true) {
                      $('#amenityNameError').text('This amenity already exists.').removeClass('success').addClass('error'); 
                      $('#saveBtn').prop('disabled', true); 
                  } else {
                      $('#amenityNameError').text('').removeClass('error').addClass('success'); 
                      $('#saveBtn').prop('disabled', false); 
                  }
              },
              error: function(xhr, status, error) {
                  toastr.error('An error occurred during the request.');
              }
          });
      }
      $('#editAmenity').on('submit', function(e) {
              e.preventDefault(); 
              
              var url = $(this).attr('action');
              var method = $(this).attr('method');
              var formData = new FormData(this);

              if ($('#icon').get(0).files.length === 0) {
                    var previousIcon = $('#existingImage').val(); 
                    formData.append('icon', previousIcon); 
                }

              $.ajax({
                  url: url, 
                  type: method,
                  data: formData,
                  contentType: false, 
                  processData: false, 
                  success: function(response) {
                      if (response.success === true) {
                          toastr.success(response.message);
                          $('#add-amenities').DataTable().ajax.reload(null, false); 
                          $('#editAmenity')[0].reset(); 
                          $('#editAmenityModal').modal('hide'); 
                      } else {
                          toastr.error('Something went wrong. Please try again.');
                      }
                  },
                  error: function(xhr, status, error) {
                      toastr.error('An error occurred during the request.');
                  }
              });
          });

          function checkExists(type) {
          var amenity = type.value;
          $.ajax({
              url: "{{ route('admin.check-if-exists') }}", 
              type: "GET",
              data: {
                table: 'amenities',
                column: 'name',
                value: amenity
              },
              success: function(response) {
                  if (response.exists === true) {
                      $('#amenityNameError').text('This amenity already exists.').removeClass('success').addClass('error'); 
                      $('#saveBtn').prop('disabled', true); 
                  } else {
                      $('#amenityNameError').text('').removeClass('error').addClass('success'); 
                      $('#saveBtn').prop('disabled', false); 
                  }
              },
              error: function(xhr, status, error) {
                  toastr.error('An error occurred during the request.');
              }
          });
      }
      function editAmenity(id){
        var amenityId = id;
        $.ajax({
              url: "{{route('admin.get-data-for-edit')}}", 
              type: "GET",
              data: {
                table: 'amenities',
                value: amenityId
              },
              success: function(response) {
                console.log(response);
                $('#amenityId').val(response.data.id);
                $('#editAmenityName').val(response.data.name);
                $('#editDescription').summernote('code', response.data.description);
                $('#amenityIconPreview').attr({'src':'/storage/' + response.data.image_url,'alt': 'Amenity Icon'});
                $('#existingImage').val(response.data.image_url);
                $('#editAmenityModal').modal('show'); 
              },
              error: function(xhr, status, error) {
                  toastr.error('An error occurred during the request.');
              }
          });
      }
      function previewImage(input) {
        var file = input.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Set the src of the preview image element to the file
                $('#amenityIconPreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
      }
      function previewImageForAdd(input) {
        var file = input.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Set the src of the preview image element to the file
                $('#amenityIconPreviewAdd').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
      }
    </script>
@endsection