 <!-- Sidebar -->
 <div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="index.html" class="logo">
          <img
            src=""
            alt="navbar brand"
            class="navbar-brand"
            height="20"
          />
        </a>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
          </button>
          <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
          </button>
        </div>
        <button class="topbar-toggler more">
          <i class="gg-more-vertical-alt"></i>
        </button>
      </div>
      <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
          <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : ''}}">
            <a
              data-bs-toggle="collapse"
              href="#dashboard"
              class="collapsed"
              aria-expanded="false"
            >
              <i class="fas fa-home"></i>
              <p>Dashboard</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="dashboard">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{route('admin.dashboard')}}">
                    <span class="sub-item">Dashboard 1</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#submenu">
              <i class="fas fa-calendar-alt"></i>
              <p>Booking Management</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu">
              <ul class="nav nav-collapse">
                <li>
                    <a href="#"> <span class="sub-item">View Bookings</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Modify Bookings</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Cancel Bookings</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Assign Rooms</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Booking Reports</span></a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item {{ request()->is('admin/room-management/add-room-type') || request()->is('admin/room-management/add-room-amenities') 
                                  || request()->is('admin/room-management/add-room-status') || request()->is('admin/room-management/add-room') 
                                  || request()->is('admin/room-management/room-status-update') || request()->is('admin/room-management/room-status-update-history')? 'active' : ''}}">
            <a data-bs-toggle="collapse" href="#submenu2">
              <i class="fas fa-hotel"></i>
              <p>Room Management</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu2">
              <ul class="nav nav-collapse">
                <li>
                    <a href="{{route('admin.view-room-list')}}"> <span class="sub-item">Room List</span></a>
                </li>
                <li>
                    <a href="{{route('admin.add-room-type')}}"> <span class="sub-item">Room Type</span></a>
                </li>
                <li>
                    <a  data-bs-toggle="collapse" href="#submenu-status"> <span class="sub-item">Room Status</span><span class="caret"></span></a>
                    <div class="collapse" id="submenu-status">
                      <ul style="list-style-type: none;">
                        <li>
                            <a href="{{route('admin.add-room-status')}}"> <span class="sub-item">Room Status</span></a>
                        </li>
                        <li>
                            <a href="{{route('admin.view-room-status')}}"> <span class="sub-item">Room Status Update</span></a>
                        </li>
                        <li>
                            <a href="{{route('admin.room-status-update-history')}}"> <span class="sub-item">Room Status History</span></a>
                        </li>
                      </ul>
                    </div>
                </li>
                <li>
                    <a  href="#"> <span class="sub-item">Room Availability</span></a>
                </li>
                <li>
                    <a  data-bs-toggle="collapse" href="#submenu-amenity"> <span class="sub-item">Room Amenities</span><span class="caret"></span></a>
                      <div class="collapse" id="submenu-amenity">
                        <ul style="list-style-type: none;">
                          <li>
                              <a href="{{route('admin.view-room-amenities')}}"> <span class="sub-item">Amenities List</span></a>
                          </li>
                          <li>
                              <a href=""> <span class="sub-item">Room Amenity Update</span></a>
                          </li>
                        </ul>
                      </div>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Room Images</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Room Type Images</span></a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#submenu3">
              <i class="fas fa-user-cog"></i>
              <p>Customer Management</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu3">
              <ul class="nav nav-collapse">
                <li>
                    <a href="#"> <span class="sub-item">View Profile</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Manage Account</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Loyalty Management</span></a>
                </li>
               
              </ul>
            </div>
          </li>
          <li class="nav-item {{ request()->is('admin/staff-management/staff-list') || request()->is('admin/staff-management/role-list') || request()->is('admin/staff-management/activity-log') ? 'active' : ''}}">
            <a data-bs-toggle="collapse" href="#submenu4">
              <i class="fas fa-user-tie"></i>
              <p>Staff Management</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu4">
              <ul class="nav nav-collapse">
                <li>
                    <a href="{{route('admin.view-staff-list')}}"> <span class="sub-item">Staff List</span></a>
                </li>
                {{-- <li>
                    <a href="{{route('admin.view-role-list')}}"> <span class="sub-item">Roles and Permissions</span></a>
                </li> --}}
                <li>
                    <a href="{{route('admin.view-activity-log')}}"> <span class="sub-item">Activity Log</span></a>
                </li>
               
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#submenu5">
              <i class="fas fa-money-check-alt"></i>
              <p>Financial Management</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu5">
              <ul class="nav nav-collapse">
                <li>
                    <a href="#"> <span class="sub-item">Manage Payment Methods</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">View And Process Payment</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Reports</span></a>
                </li>
               
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#submenu6">
              <i class="fas fa-globe"></i>
              <p>Content Management</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu6">
              <ul class="nav nav-collapse">
                <li>
                    <a href="#"> <span class="sub-item">Website Content</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Terms And Conditions</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">SEO Management</span></a>
                </li>
               
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#submenu7">
              <i class="fas fa-wrench"></i>
              <p>Settings</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu7">
              <ul class="nav nav-collapse">
                <li>
                    <a href="#"> <span class="sub-item">Hotel Settings</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">System Settings</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Security Settings</span></a>
                </li>
               
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#submenu8">
              <i class="fas fa-chart-line"></i>
              <p>Reports And Analytics</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu8">
              <ul class="nav nav-collapse">
                <li>
                    <a href="#"> <span class="sub-item">Analytics Dashboard</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Generate Reports</span></a>
                </li>
               </ul>
            </div>
          </li>
          <li class="nav-item {{ request()->is('admin/access-control/add-role') ? 'active' : ''}}">
            <a data-bs-toggle="collapse" href="#submenu9">
              <i class="fas fa-user-shield"></i>
              <p>Acess And Control</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu9">
              <ul class="nav nav-collapse">
                <li>
                    <a href="{{route('admin.view-role-list')}}"> <span class="sub-item">Roles Management</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Permissions Management</span></a>
                </li>
                <li>
                  <a href="#"> <span class="sub-item">Role-Permission Mapping</span></a>
                </li>
               </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#submenu10">
              <i class="fas fa-bell"></i>
              <p>Notifications</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu10">
              <ul class="nav nav-collapse">
                <li>
                    <a href="#"> <span class="sub-item">Send Notifications</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Customer Communication</span></a>
                </li>
               </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#submenu11">
              <i class="fas fa-comments"></i>
              <p>Feedback and Reviews</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu11">
              <ul class="nav nav-collapse">
                <li>
                    <a href="#"> <span class="sub-item">Monitor Reviews</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Review Management</span></a>
                </li>
               </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#submenu12">
              <i class="fas fa-bullhorn"></i>
              <p>Marketing And Promotions</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu12">
              <ul class="nav nav-collapse">
                <li>
                    <a href="#"> <span class="sub-item">Manage Promotions</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Email Campaigns</span></a>
                </li>
               </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- End Sidebar -->