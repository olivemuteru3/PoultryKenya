

@extends('Admin.app')

@section('content')

    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-secondary navbar-dark">
            <a href="/dashboard" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Poultry System</h3>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="{{asset('Admin/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0">{{auth()->user()->name}}</h6>
                    <span>Farmer</span>
                </div>
            </div>
            <div class="navbar-nav w-100">
                <a href="/dashboard" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="/user/profile" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Profile</a>
                <a href="/RegisterPoultry" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Chickens</a>
                <a href="/eggs" class="nav-item nav-link active"><i class="fa fa-keyboard me-2"></i>Eggs</a>
                <a href="/sales" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Sales</a>
                <a href="/news" class="nav-item nav-link"><i class="fa fa-list-alt"></i>Others</a>

            </div>
        </nav>
    </div>
    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
            <a href="/dashboard" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            <form class="d-none d-md-flex ms-4">
                <input class="form-control bg-dark border-0" type="search" placeholder="Search">
            </form>
            <div class="navbar-nav align-items-center ms-auto">

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-lg-2" src="{{asset('Admin/img/user.jpg')}}" alt="{{auth()->user()->name}}" style="width: 40px; height: 40px;">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                        <a href="/user/profile" class="dropdown-item">My Profile</a>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>

                </div>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Poultry Farming Information Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fas fa-egg fa-3x text-warning"></i>
                        <div class="ms-3">
                            <p class="mb-2">Eggs Laid Today</p>
                            <h6 class="mb-0">{{$todaysEggs}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fas fa-layer-group fa-3x text-warning"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total Chickens Registered</p>
                            <h6 class="mb-0">{{$Count}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fas fa-dollar-sign fa-3x text-success"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total eggs</p>
                            <h6 class="mb-0">{{$eggs}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fas fa-dollar-sign fa-3x text-success"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total Revenue</p>
                            <h6 class="mb-0">Ksh. {{$totalSales}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Poultry Farming Information End -->


        <!-- Eggs Statistics -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Eggs Record</h6>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addEggsModal">Add New</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                        <tr class="text-white">
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Number of eggs</th>
                            <th scope="col">Farmer</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($eggsCount as $chickens)
                            <tr>
                                <td>{{$chickens->id}}</td>
                                <td>{{$chickens->date}}</td>
                                <td>{{$chickens->eggs_number}}</td>
                                <td>{{ $chickens->farmerName }}</td>
                                <td>{{$chickens->farmerPhone}}</td>
                                <td><span class="badge bg-success">{{$chickens->status}}</span></td>
                                <td><a class="btn btn-sm btn-primary" href="/eggsDetails/{{$chickens->id}}">Detail</a></td>
                            </tr>
                        @endforeach
                        <!-- Add your dynamic content here (e.g., loop through eggs) -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->

        <!-- Add Eggs Modal -->
        <div class="modal fade" id="addEggsModal" tabindex="-1" aria-labelledby="addEggsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEggsModalLabel">Add New Eggs</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add your form for adding new eggs here -->
                        <form action="{{route('RegisterEggs')}}" method="post">
                            @csrf
                            <!-- Add your form fields here -->
                            <div class="mb-3">
                                <label for="eggs_number" class="form-label">Number of Eggs</label>
                                <input type="number" class="form-control" id="eggs_number" name="eggs_number" required>
                            </div>
                            <div class="mb-3">
                                <label for="comments" class="form-label">Comments</label>
                                <textarea class="form-control" id="comments" name="comments" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Eggs</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Eggs Modal End -->









@endsection
