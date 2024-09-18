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
                        <i class="fa fa-plus"></i> Add Staff
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="add-row" class="table table-hover">
                        <thead>
                          <tr>
                            <th style="width: 20%">Name</th>
                            <th>Role</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Start Date</th>
                            <th>Salary</th>
                            <th style="width: ">Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Start Date</th>
                            <th>Salary</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          @foreach($staffDetails as $staff)
                            <tr>
                              
                              <td style="">
                                <div class="card-list">
                                  <div class="item-list">
                                      <div class="avatar">
                                        @if($staff->image_url != null)
                                          <img src="{{ asset('storage/' . $staff->image_url) }}" alt="..."class="avatar-img rounded-circle"/>
                                        @else
                                          @php
                                            $initials = strtoupper(substr($staff->first_name, 0, 1) . substr($staff->last_name, 0, 1));
                                          @endphp
                                          <span class="avatar-title rounded-circle border border-white">{{ $initials }}</span>  
                                        @endif
                                      </div>
                                      <div class="info-user ms-3">
                                        <div class="username">{{$staff->first_name}} {{$staff->last_name}}</div>
                                        <div class="status">{{$staff->email}}</div>
                                      </div>
                                  </div>
                                </div>
                              </td>
                                @php
                                  $userRole = StaffHelper:: getStaffRoleByRoleId($staff->role);
                                @endphp
                              <td>{{$userRole->role_name}}</td>
                              <td>{{$staff->phone}}</td>
                              <td>{{$staff->address}}</td>
                              <td>{{$staff->start_date}}</td>
                              <td>₹{{ number_format($staff->salary, 2) }}</td>
                              <td>
                                <div class="form-button-action">
                                  <button  type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#editModal" data-original-title="Edit Task" data-id="{{$staff->id}}" onclick="openModal(this)">
                                    <i class="fa fa-edit"></i>
                                  </button>
                                  <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove" data-id="{{$staff->id}}" onclick="deleteStaff(this)">
                                    <i class="fa fa-times"></i>
                                  </button>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <!-- Add Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Add New Staff</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <!-- Modal Body -->
              <div class="modal-body">
                <form action="{{route('admin.add-new-staff')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                      <div class="row mb-3">
                          <!-- First Name -->
                          <div class="col-md-6">
                              <label for="firstName" class="form-label">First Name</label>
                              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter first name" required>
                          </div>
                          <!-- Last Name -->
                          <div class="col-md-6">
                              <label for="lastName" class="form-label">Last Name</label>
                              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter last name">
                          </div>
                      </div>
                      <div class="row mb-3">
                          <!-- Email -->
                          <div class="col-md-6">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                          </div>
                          <!-- Phone -->
                          <div class="col-md-6">
                              <label for="phone" class="form-label">Phone Number</label>
                              <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required>
                          </div>
                      </div>
                      <div class="row mb-3">
                          <!-- Role -->
                          <div class="col-md-6">
                              <label for="role" class="form-label">Role</label>
                              <select name="role" id="role" class="form-control">
                                  <option value="" disabled selected>Select Role</option>
                                  @foreach ($role as $userRole)
                                      <option value="{{$userRole->id}}">{{$userRole->role_name}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <!-- Salary -->
                          <div class="col-md-6">
                              <label for="salary" class="form-label">Salary</label>
                              <div class="input-group">
                                  <span class="input-group-text">₹</span>
                                  <input type="text" class="form-control" id="salary" name="salary" placeholder="Enter salary amount" oninput="formatCurrency(this)" required>
                              </div>
                          </div>
                      </div>
                      <div class="row mb-3">
                          <!-- Start Date -->
                          <div class="col-md-6">
                              <label for="startDate" class="form-label">Start Date</label>
                              <input type="date" class="form-control" name="startDate" id="startDate">
                          </div>
                          <!-- Image -->
                          <div class="col-md-6">
                              <label for="image" class="form-label">Image</label>
                              <input type="file" class="form-control" name="image" id="image">
                          </div>
                      </div>
                      <div class="row mb-3">
                          <!-- Address -->
                          <div class="col-md-12">
                              <label for="address" class="form-label">Address</label>
                              <textarea name="address" id="address" class="form-control" cols="30" rows="5" placeholder="Enter address" required></textarea>
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
        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
             
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

       function formatCurrency(input) {
          let value = input.value;
          value = value.replace(/[^\d.]/g, '');
          if (!isNaN(value) && value !== '') {
              value = parseFloat(value).toLocaleString('en-IN', {
                  maximumFractionDigits: 2
              });
              input.value = value;
          } else {
              input.value = '';
          }
      }

  function openModal(button) {
    var staffId = $(button).data('id'); // Pass the button element as a parameter
    console.log(staffId);
    $.ajax({
            url: '{{ route("admin.get-staff-data-for-edit") }}',
            data: { id: staffId },
            type: 'GET',
            success: function(response) {
              $('#editModal .modal-body').html(response);
            $('#editModal').modal('show');                
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    
  }
function deleteStaff(eve){
  var staffId = $(eve).data('id');
  console.log(staffId);
  Swal.fire({
  title: "Are you sure you want to delete?",
  // showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: "Delete",
  denyButtonText: `Don't save`
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire("Deleted!", "", "success");
  } else if (result.isDenied) {
    Swal.fire("Changes are not saved", "", "info");
  }
});
}
    </script>
@endsection