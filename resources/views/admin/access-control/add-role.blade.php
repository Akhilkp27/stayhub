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
                     
                    
                      <button type="button" class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                        <i class="fa fa-plus"></i> Add Role
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="add-role" class="table table-hover">
                        <thead>
                          <tr>
                            <th>Sl.No</th>
                            <th>Role Name</th>
                            <th>Created At</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Sl.No</th>
                            <th>Role Name</th>
                            <th>Created At</th>
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
 <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="addRoleModalLabel"><b>Add New Role</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <form id="addRole" action="{{route('admin.store-role')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
              <div class="row mb-3">
                  <!-- Role Name -->
                  <div class="col-md-12">
                      <label for="roleName" class="form-label">Role Name</label>
                      <input type="text" class="form-control" id="roleName" name="roleName" placeholder="Enter role name" required onkeyup="checkExists(this)">
                      <span class="error" id="roleError"></span>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="saveBtn" class="btn btn-success">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
 </div>
 <!-- Edit Role Modal -->
 <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title" id="editRoleModalLabel"><b>Edit Role</b></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <form id="editRole" action="{{route('admin.update-role')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row mb-3">
                    <!-- Role Name -->
                    <div class="col-md-12">
                        <label for="roleName" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="editRoleName" name="roleName" placeholder="Enter role name" required onkeyup="checkExists(this)">
                        <span class="error" id="roleError"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="text" name="roleId" id="roleId" hidden>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" id="saveBtn" class="btn btn-success">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
   </div>
<script>
$(document).ready(function() {
    
    
    var table = $('#add-role').DataTable({
              "ajax": {
                  "url": "{{ route('admin.get-table-data') }}", 
                  "type": "GET",
                  "data": {
                            "table": "roles" 
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
                  { "data": "role_name" },
                  { "data": "created_at" },
                  { 
                      "data": null, // Action column
                      "render": function(data, type, row) {
                          return `
                              <button class="btn btn-sm btn-primary" onclick="editRole(${row.id})">
                                <img src="{{ asset('admin/icons/edit_square.png') }}" alt="Edit" style=" width:20px;height: 20px;"> Edit</button>
                          `;
                      }
                  }
              ]
          });

});
$('#addRole').on('submit', function(e) {
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
                $('#add-role').DataTable().ajax.reload(null, false); 
                $('#addRole')[0].reset(); 
                $('#saveBtn').attr('disabled', true);
                $('#addRoleModal').modal('hide'); 
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
    var roleName = type.value;
    $.ajax({
        url: "{{ route('admin.check-if-exists') }}", 
        type: "GET",
        data: {
        table: 'roles',
        column: 'role_name',
        value: roleName
        },
        success: function(response) {
            if (response.exists === true) {
                $('#roleError').text('This role already exists.').removeClass('success').addClass('error'); 
                $('#saveBtn').prop('disabled', true); 
            } else {
                $('#roleError').text('').removeClass('error').addClass('success'); 
                $('#saveBtn').prop('disabled', false); 
            }
        },
        error: function(xhr, status, error) {
            toastr.error('An error occurred during the request.');
        }
    });
}
function editRole(id) {
    var roleId = id;
    
    $.ajax({
        url: "{{route('admin.get-data-for-edit')}}", 
        type: "GET",
        data: {
        table: 'roles',
        value: roleId
        },
        success: function(response) {
        
        $('#roleId').val(response.data.id);
        $('#editRoleName').val(response.data.role_name);
        $('#editRoleModal').modal('show'); 
        },
        error: function(xhr, status, error) {
            toastr.error('An error occurred during the request.');
        }
    });
}
$('#editRole').on('submit', function(e){
      e.preventDefault(); 
      var url = $(this).attr('action');
      var method = $(this).attr('method');
      var formData = $(this).serialize();
      console.log(formData);
      
      $.ajax({
        url: url, 
        type: method,
        data: formData,
        success: function(response) {
            if (response.success === true) {
                toastr.success(response.message);
                $('#add-role').DataTable().ajax.reload(null, false); 
                $('#editRole')[0].reset(); 
                $('#saveBtn').attr('disabled', true);
                $('#editRoleModal').modal('hide'); 
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