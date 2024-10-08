<div class="container-fluid bg-dark px-0">
    <div class="row gx-0">
        <div class="col-lg-3 bg-dark d-none d-lg-block">
            <a href="{{route('customer.dashboard')}}" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                <h1 class="m-0 text-primary text-uppercase">StayHub</h1>
            </a>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                <a href="index.html" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 text-primary text-uppercase">Hotelier</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{route('customer.dashboard')}}" class="nav-item nav-link active">Home</a>
                        <a href="#about" class="nav-item nav-link">About</a>
                        <a href="#service" class="nav-item nav-link">Services</a>
                        <a href="" class="nav-item nav-link">Rooms</a>
                        <a href="" class="nav-item nav-link">My Bookings</a>
                        <a href="" class="nav-item nav-link">Notifications</a>
                        <a href="" class="nav-item nav-link">Contact</a>
                    </div>
                    <div>
                        
                        <label for="">welcome back {{$customer->first_name}}</label>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><img src="{{asset('img/icons/profile.png')}}" alt=""></a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="" class="dropdown-item">Profile</a>
                            <a href="#" class="dropdown-item" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                             Logout
                         </a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>
                        </div>
                    </div>
                    
                </div>
            </nav>
        </div>
    </div>
</div>