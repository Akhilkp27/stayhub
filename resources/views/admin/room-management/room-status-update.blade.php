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
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="room-status" class="table table-striped">
                        <thead>
                          <tr>
                            <th>Sl.No</th>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Sl.No</th>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Status</th>
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
    <div class="modal fade" id="editRoomStatusModal" tabindex="-1" aria-labelledby="editRoomStatusModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title" id="editRoomStatusModalLabel"><b>Update Room Status</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <form id="editRoomStatus" action="{{route('admin.update-room-status')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                  <div class="row mb-3">
                    <div class="col md-4">
                      <label for="roomNumber" class="form-label">Room Number</label>
                      <input type="text" class="form-control" id="roomNumber" name="roomNumber" readonly>
                    </div>
                    <div class="col-md-8 mb-3">
                      <label for="statusName" class="form-label">Status</label>
                      <select name="statusSelect" class="form-control" id="statusSelect">
                        <option value=""></option>
                      </select>
                    </div>
                    <div class="col-md-12 mt-2">
                      <label for="" class="text-info">Room Staus Info</label>
                      <div id="roomStatusDescription" style="width: 100%;color:black;border:1px;"></div>
                    </div>  
                  </div>
              </div>
              </div>
              <div class="modal-footer">
                <input type="text" id="roomId" name="roomId"   hidden>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="saveBtn"  class="btn btn-success">Update</button>
              </div>
          </form>
          </div>
        </div>
    </div> 
<script>
   $(document).ready(function() {
        var table = $('#room-status').DataTable({
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
                  { 
                      "data": null, // Action column
                      "render": function(data, type, row) {
                          return `
                              <button class="btn btn-sm btn-primary" onclick="editRoom(${row.id})"> 
                               <img src="{{ asset('admin/icons/edit_square.png') }}" alt="Edit" style="width:20px;height: 20px;"> Edit</button>
                          `;
                      }
                  }
              ]
         });
     });  

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
                    data: { table: 'room_statuses' },
                    success: function(roomStatusResponse) {
                        var $roomStatusSelect = $('#statusSelect');
                        $roomStatusSelect.empty().append($('<option></option>').attr('value', '').text('Select room status'));

                        $.each(roomStatusResponse, function(index, roomStatus) {
                            $roomStatusSelect.append($('<option></option>').attr('value', roomStatus.id) .attr('data-description', roomStatus.description).text(roomStatus.status_name));
                            $('#roomStatusDescription').val(roomStatus.description);
                        });
                        $roomStatusSelect.val(response.data.current_status_id);
                        var selectedDescription = $roomStatusSelect.find(':selected').data('description');
                        var tempElement = $('<div>').html(selectedDescription).text();
                        $('#roomStatusDescription').text(tempElement);
                        
                        $roomStatusSelect.on('change', function() {

                          var selectedDescription = $(this).find(':selected').data('description');
                          var tempElement = $('<div>').html(selectedDescription).text();
                          $('#roomStatusDescription').text(tempElement);  // Update the description field
                        });
                        
                        $('#roomId').val(response.data.room_id);
                        $('#roomNumber').val(response.data.room_number);
                        $('#editRoomStatusModal').modal('show');
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
      $('#editRoomStatus').on('submit', function(e) {
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
                          $('#room-status').DataTable().ajax.reload(null, false); 
                          $('#editRoomStatus')[0].reset(); 
                          $('#editRoomStatusModal').modal('hide'); 
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