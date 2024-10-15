@extends('layouts.admin_staff_layout')
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
                    <button type="button" class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                        <i class="fa fa-plus"></i> Add Room 
                    </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="add-room" class="table table-striped">
                        <thead>
                          <tr>
                            <th>Sl.No</th>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Price per night</th>
                            <th>Status</th>
                            <th>Max Adult</th>
                            <th>Max Child</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Sl.No</th>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Price per night</th>
                            <th>Status</th>
                            <th>Max Adult</th>
                            <th>Max Child</th>
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
    <!-- Add Room  Modal -->
    <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title" id="addRoomModalLabel"><b>Add New Room</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <form id="addRoom" action="{{route('admin.store-room')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="room-type mb-3">
                  <div class="row">
                    <div class="col-md-4">
                      <label for="roomType" class="form-label">Room Type</label>
                      <select name="roomType" class="form-control select" id="roomType">
                        <option value="" selected disabled>Select room type</option>
                      </select>
                    </div>
                 
                    <div class="col-md-6 mt-2">
                      <label for="" class="text-info">Room Type Info</label>
                      <div id="roomDescription" style="width: 100%;color:black;border:1px;"></div>
                    </div>
                  </div>
                  <hr>
                 
                  <div class="row mt-2" style="color: black">
                    <div class="col-md-4">
                      <label for="totalRooms" class="form-label">Total Rooms</label>
                      <input type="text" class="form-control" value="" name="totalRooms" id="totalRooms" disabled>
                    </div>
                    <div class="col-md-4">
                      <label for="availableRoom" class="form-label">Available Rooms</label>
                      <input type="text" class="form-control" value="" name="availableRoom" id="availableRoom" disabled>
                    </div>
                    <div class="col-md-3" id="roomNumberDiv">
                      <label for="roomNumber" class="form-label">Next Room Number</label>
                      
                      <input type="text" class="form-control" value="" name="roomNumber" id="roomNumber" readonly>
                    </div>
                  </div>
                </div>
                
                <div class="room-details mt-3">
                  <div class="row">
                    <div class="col-md-4">
                      <label for="pricePerNight" class="form-label">Price per night</label>
                      <input type="text" class="form-control" value="" name="pricePerNight" id="pricePerNight" placeholder="₹ 0.00" onchange="currencyFormat(this)">
                    </div>
                    <div class="col-md-4">
                      <label for="maximumAdult" class="form-label">Maximum Adult</label>
                      <input type="text" class="form-control" value="" name="maximumAdult" id="maximumAdult" onkeyup="isNumberAndLimit(this, 4, 1)" required>
                    </div>
                    <div class="col-md-4">
                      <label for="maximumChild" class="form-label">Maximum Child</label>
                      <input type="text" class="form-control" value="" name="maximumChild" id="maximumChild" onkeyup="isNumberAndLimit(this, 3)" required>
                    </div>
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
    <!-- Edit Room Modal -->
    <div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title" id="editRoomModalLabel"><b>Edit Room Details</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <form id="editRoom" action="{{route('admin.update-room-data')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="room-type mb-3">
                  <div class="row">
                    <div class="col-md-4">
                      <label for="roomType" class="form-label">Room Type</label>
                      <select name="roomType" class="form-control select" id="editRoomType" >
                        <option value="" selected disabled>Select room type</option>
                      </select>
                    </div>
                 
                    <div class="col-md-6 mt-2">
                      <label for="" class="text-info">Room Type Info</label>
                      <div id="editRoomDescription" style="width: 100%;color:black;border:1px;"></div>
                    </div>
                  </div>
                  <hr>
                 
                  <div class="row mt-2" style="color: black">
                    <div class="col-md-4">
                      <label for="totalRooms" class="form-label">Total Rooms</label>
                      <input type="text" class="form-control" value="" name="totalRooms" id="editTotalRooms" disabled>
                    </div>
                    <div class="col-md-4">
                      <label for="availableRoom" class="form-label">Available Rooms</label>
                      <input type="text" class="form-control" value="" name="availableRoom" id="editAvailableRooms" disabled>
                    </div>
                    <div class="col-md-3" id="roomNumberDiv">
                      <label for="roomNumber" class="form-label" id="roomNumberLabel">Room Number</label>
                      
                      <input type="text" class="form-control" value="" name="roomNumber" id="editRoomNumber" readonly>
                    </div>
                  </div>
                </div>
                
                <div class="room-details mt-3">
                  <div class="row">
                    <div class="col-md-4">
                      <label for="pricePerNight" class="form-label">Price per night</label>
                      <input type="text" class="form-control" value="" name="pricePerNight" id="editPricePerNight" placeholder="₹ 0.00" onchange="currencyFormat(this)">
                    </div>
                    <div class="col-md-4">
                      <label for="maximumAdult" class="form-label">Maximum Adult</label>
                      <input type="text" class="form-control" value="" name="maximumAdult" id="editMaximumAdult" onkeyup="isNumberAndLimit(this, 4, 1)" required>
                    </div>
                    <div class="col-md-4">
                      <label for="maximumChild" class="form-label">Maximum Child</label>
                      <input type="text" class="form-control" value="" name="maximumChild" id="editMaximumChild" onkeyup="isNumberAndLimit(this, 3)" required>
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <div class="modal-footer">
                <input type="text" name="roomId" id="roomId" hidden>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="saveBtn"  class="btn btn-success">Update</button>
              </div>
    
          </form>
          
          </div>
        </div>
      </div>
  </div>
    <script>
      $(document).ready(function(){
        getRoomType();
        $('#roomNumberDiv').hide();
        $('#add-room').DataTable({
          "ajax": {
                  "url": "{{ route('admin.get-table-data') }}", 
                  "type": "GET",
                  "data": {
                            "table": "rooms" 
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
                  { "data": "room_number" },
                  { 
                      "data": null, 
                      "render": function(data, type, row) {
                        
                        var roomType = row.room_type.type_name; 
                        return roomType;
                         
                      }
                  },
                  {
                      "data": "price_per_night",
                      "render": function(data, type, row) {
                        return '₹' + data;
                      }
                    },
                   { 
                      "data": null, 
                      "render": function(data, type, row) {
                        
                        var roomStatus = row.room_status.status_name;
                        var badgeClass = null; 

                        switch (roomStatus) {
                            case 'Available':
                                badgeClass  = 'badge-success';
                                break;
                            case 'Occupied':
                                badgeClass  = 'badge-danger';
                                break;
                            case 'Reserved':
                                badgeClass  = 'badge-warning';
                                break;
                            case 'Under Maintenance':
                                badgeClass  = 'badge-secondary';
                                break;
                            case 'Cleaning in Progress':
                                badgeClass  = 'badge-info';
                                break;
                            case 'No Show':
                                badgeClass  = 'badge-dark';
                                break;
                            case 'Checked Out':
                                badgeClass  = 'badge-primary';
                                break;
                            case 'Pending Confirmation':
                                badgeClass  = 'badge-warning';
                                break;
                            case 'Blocked':
                                badgeClass  = 'badge-danger';
                                break;
                            case 'Inactive':
                                $badgeClass  = 'badge-secondary';
                                break;
                            default:
                                $badgeClass  = 'badge-secondary';
                                break;
                        }
                        return `<span class="badge badge-pill ${badgeClass}">${roomStatus}</span>`;
                      }
                  },
                  { "data": "max_adults" },
                  { "data": "max_children" },
                  { 
                      "data": null, // Action column
                      "render": function(data, type, row) {
                          return `
                              <button class="btn btn-sm btn-primary" onclick="editRoom(${row.id})">
                                <img src="{{ asset('admin/icons/edit_square.png') }}" alt="Edit" style=" width:20px;height: 20px;"> Edit</button>
                          `;
                      }
                  }
              ]
        });
        
      });

      $('#roomType').on('change', function() {
        console.log('Room type changed');
        
        // You can access the selected value like this:
        var selectedValue = $(this).val();
        console.log('Selected room type ID: ' + selectedValue);
        if (selectedValue) {
            // Fetch the description for the selected room type via AJAX
            $.ajax({
                url: "{{ route('admin.get-room-data') }}",  // Make sure this route exists
                type: "GET",
                data: { table:'room_types',value: selectedValue },
                success: function(response) {
               
                    $('#roomNumber').val(response.roomNumber);
                    $('#availableRoom').val(response.tableData.available_rooms);
                    $('#totalRooms').val(response.tableData.total_rooms);
                    $('#roomDescription').html(response.tableData.description);
                    $('#saveBtn').attr('disabled', false);
                },
                error: function(xhr) {
                  // This handles any non-200 HTTP status codes
                  var response = xhr.responseJSON;
                  if (response && response.message) {
                    toastr.error(response.message);
                    $('#roomNumber').val('');
                    $('#availableRoom').val('');
                    $('#totalRooms').val('');
                    $('#roomDescription').html('');
                    $('#saveBtn').attr('disabled', true);
                  } else {
                    toastr.error('An unexpected error occurred.');
                  }
              }
            });
        } else {
            // Clear the description if no room type is selected
            $('#roomDescription').text('');
        }
    });
    $('#editRoomType').on('change', function() {
        console.log('Room type changed');
        
        // You can access the selected value like this:
        var selectedValue = $(this).val();
        console.log('Selected room type ID: ' + selectedValue);
        if (selectedValue) {
            // Fetch the description for the selected room type via AJAX
            $.ajax({
                url: "{{ route('admin.get-room-data') }}",  // Make sure this route exists
                type: "GET",
                data: { table:'room_types',value: selectedValue },
                success: function(response) {
                  console.log(response.roomNumber);
                  $('#roomNumberLabel').text('Next Room Number')
                    $('#editRoomNumber').val(response.roomNumber);
                    $('#editAvailableRoom').val(response.tableData.available_rooms);
                    $('#editTotalRooms').val(response.tableData.total_rooms);
                    $('#editRoomDescription').html(response.tableData.description);
                },
                error: function(xhr, status, error) {
                    toastr.error('An error occurred while fetching the room type description.');
                }
            });
        } else {
            // Clear the description if no room type is selected
            $('#roomDescription').text('');
        }
    });

   $('#addRoom').on('submit', function(e){
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
                $('#add-room').DataTable().ajax.reload(null, false); 
                $('#addRoom')[0].reset(); 
                $('#saveBtn').attr('disabled', true);
                $('#addRoomModal').modal('hide'); 
            } else {
                toastr.error('Something went wrong. Please try again.');
            }
        },
        error: function(xhr, status, error) {
            toastr.error('An error occurred during the request.');
        }
      });
   });
   $('#editRoom').on('submit', function(e){
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
                $('#add-room').DataTable().ajax.reload(null, false); 
                $('#addRoom')[0].reset(); 
                $('#saveBtn').attr('disabled', true);
                $('#editRoomModal').modal('hide'); 
            } else {
                toastr.error('Something went wrong. Please try again.');
            }
        },
        error: function(xhr, status, error) {
            toastr.error('An error occurred during the request.');
        }
      });
   });
      function getRoomType(){
        $.ajax({
            url: "{{route('admin.get-table-data')}}", 
            type: "GET",
            data: {table: 'room_types',},
            success: function(response) {
              var $itemSelect = $('#roomType'); // Ensure you have the correct select element ID
                // Clear existing options
                $itemSelect.empty().append($('<option></option>').attr('value', '').text('Select a room type'));

                // Assuming response is an array of room types
                $.each(response, function(index, item) {
                  if(item.status == 'active'){
                    $itemSelect.append($('<option></option>').attr('value', item.id).text(item.type_name));
                  }
                });
                $('#roomNumberDiv').show();
            },
            error: function(xhr, status, error) {
                toastr.error('An error occurred during the request.');
            }
        });
      }

      function isNumberAndLimit(input, maxValue, minValue = 0) {
          input.value = input.value.replace(/[^0-9]/g, '');

          // Convert input value to an integer
          let value = parseInt(input.value);

          // If the value is greater than the max limit
          if (value > maxValue) {
              input.value = maxValue;
              toastr.warning("The maximum allowed value is " + maxValue + ".");
          }

          // If the value is less than the min limit (optional)
          if (minValue !== undefined && value < minValue) {
              input.value = minValue;
              toastr.warning("The minimum allowed value is " + minValue + ".");
          }
      }

      function currencyFormat(input){
        let value = input.value.replace(/[^0-9.]/g, '');
        
        if (value) {
        // Convert the value to a float for formatting
            let number = parseFloat(value);

            // Format the number as Indian Rupees
            const formatted = new Intl.NumberFormat('en-IN', {
                style: 'currency',
                currency: 'INR'
            }).format(number);

            // Set the formatted value back to the input field
            input.value = formatted;
        } else {
            // If the input is cleared or invalid, set a default value
            input.value = '₹ 0.00';
        }
      }
      function editRoom(id){
        var roomId = id;
     
      $.ajax({
              url: "{{route('admin.get-data-for-edit-room')}}", 
              type: "GET",
              data: {
                table: 'rooms',
                value: roomId
              },
              success: function(response) {
                $.ajax({
                    url: "{{ route('admin.get-table-data') }}", // Route to get room types
                    type: "GET",
                    data: { table: 'room_types' },
                    success: function(roomTypesResponse) {
                        var $roomTypeSelect = $('#editRoomType');
                        
                        // Clear existing options and add default option
                        $roomTypeSelect.empty().append($('<option></option>').attr('value', '').text('Select room type'));
                        
                        // Populate room types dropdown
                        $.each(roomTypesResponse, function(index, roomType) {
                          if(roomType.status == 'active'){
                            $roomTypeSelect.append($('<option></option>').attr('value', roomType.id).text(roomType.type_name));
                          }
                        });

                        // Set the selected room type based on the room data
                        $roomTypeSelect.val(response.data.room_type_id); // Assuming `room_type_id` is the correct field in your response

                        // Populate other room details
                        $('#roomId').val(response.data.room_id);
                        $('#editRoomDescription').text(response.data.description);
                        $('#editRoomNumber').val(response.data.room_number);
                        $('#editTotalRooms').val(response.data.total_rooms);
                        $('#editAvailableRooms').val(response.data.available_rooms);
                        $('#editPricePerNight').val(response.data.price_per_night);
                        $('#editMaximumAdult').val(response.data.max_adults);
                        $('#editMaximumChild').val(response.data.max_children);
                        
                        // Show the modal after populating the data
                        $('#editRoomModal').modal('show'); 
                    },
                    error: function(xhr, status, error) {
                        toastr.error('An error occurred while fetching room types.');
                    }
                });
              },
              error: function(xhr, status, error) {
                  toastr.error('An error occurred during the request.');
              }
          });
      }
    </script>
@endsection   

    