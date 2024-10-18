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
      $('#room-status').DataTable({
        "processing": false,
        "serverSide": false, // Change this to true if server-side processing is needed
        "ajax": {
            "url": "{{ route('admin.get-update-history') }}", 
            "type": "GET",
            "dataSrc": "data" // Make sure 'data' key is used as this is the JSON structure.
        },
        "columns": [
            { 
                "data": null, 
                "render": function (data, type, row, meta) {
                    return meta.row + 1; // Display row index
                }
            },
            { "data": "room_number" },
            { 
                        "data": "status", 
                        "render": function (data, type, row) {
                            // Add badge styling based on room status
                            var badgeClass = 'badge-secondary'; // Default class
                            switch (data) {
                                case 'Available':
                                    badgeClass = 'badge-success';
                                    break;
                                case 'Occupied':
                                    badgeClass = 'badge-danger';
                                    break;
                                case 'Reserved':
                                    badgeClass = 'badge-warning';
                                    break;
                                case 'Under Maintenance':
                                    badgeClass = 'badge-secondary';
                                    break;
                                case 'Cleaning in Progress':
                                    badgeClass = 'badge-info';
                                    break;
                                case 'No Show':
                                    badgeClass = 'badge-dark';
                                    break;
                                case 'Checked Out':
                                    badgeClass = 'badge-primary';
                                    break;
                                case 'Pending Confirmation':
                                    badgeClass = 'badge-warning';
                                    break;
                                case 'Blocked':
                                    badgeClass = 'badge-danger';
                                    break;
                                case 'Inactive':
                                    badgeClass = 'badge-secondary';
                                    break;
                                default:
                                    badgeClass = 'badge-secondary';
                                    break;
                            }
                            return `<span class="badge badge-pill ${badgeClass}">${data}</span>`;
                        }
                    },
            { "data": "updated_by_name" }, // Display the name of the person who updated
            { "data": "updated_by_role" }, // Display their role (Admin/Staff)
            { "data": "updated_at" } // Display the update timestamp
        ]
      });
});

</script>
@endsection