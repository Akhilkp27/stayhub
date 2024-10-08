 <!-- Sidebar -->
 <div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="index.html" class="logo">
          <img
            src="{{asset('admin/img/StayHub_transparent.png')}}"
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
          <li class="nav-item active">
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
                  <a href="../demo1/index.html">
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
                    <a href="#"> <span class="sub-item">New Bookings</span></a>
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
                    <a href="#"> <span class="sub-item">View Bookings</span></a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#submenu2">
              <i class="fas fa-hotel"></i>
              <p>Room Management</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu2">
              <ul class="nav nav-collapse">
                <li>
                    <a href="#"> <span class="sub-item">Room Availability</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Assign Room</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Room Status Update</span></a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#submenu3">
              <i class="fas fa-calendar-check"></i>
              <p>Check-In/Check-Out</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu3">
              <ul class="nav nav-collapse">
                <li>
                    <a href="#"> <span class="sub-item">Check-In</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Check-Out</span></a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#submenu4">
              <i class="fas fa-user-cog"></i>
              <p>Customer Management</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu4">
              <ul class="nav nav-collapse">
                <li>
                    <a href="#"> <span class="sub-item">View Profile</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Edit Customer Details</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Customer Inquiries</span></a>
                </li>
               
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#submenu5">
              <i class="fas fa-money-bill-alt"></i>
              <p>Billing & Payments</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu5">
              <ul class="nav nav-collapse">
                <li>
                    <a href="#"> <span class="sub-item">Process Payment</span></a>
                </li>
                <li>
                    <a href="#"> <span class="sub-item">Issue Invoice</span></a>
                </li>
               
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#submenu6">
              <i class="fas fa-bell"></i>
              <p>Notifications</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="submenu6">
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
        </ul>
      </div>
    </div>
  </div>
  <!-- End Sidebar -->