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
                            <th>Status</th>
                            <th>Updated By</th>
                            <th>Role</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Sl.No</th>
                            <th>Room Number</th>
                            <th>Status</th>
                            <th>Updated By</th>
                            <th>Role</th>
                            <th>Date</th>
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

</script>
@endsection